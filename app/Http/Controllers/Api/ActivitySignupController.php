<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Models\ActivityUserSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ActivitySignupController extends Controller
{
    /**
     * 用户报名活动
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
        ]);

        $user = auth()->user();

        // 检查是否已报名
        $exists = ActivityUserSignup::where('user_id', $user->id)
            ->where('activity_id', $request->activity_id)
            ->exists();

        if ($exists) {
            throw new InvalidRequestException('您已报名该活动');
        }

        // 报名活动
        $signup = ActivityUserSignup::create([
            'user_id' => $user->id,
            'activity_id' => $request->activity_id,
            'signed_at' => now(),
        ]);

        // 生成二维码，包含用户的签到URL
        $qrCodeUrl = route('activities.signin', ['user_id' => $user->id, 'activity_id' => $request->activity_id]);

        // 生成二维码并保存为图片
        $qrCodeImage = QrCode::format('png')->size(200)->generate($qrCodeUrl);
        $fileName = 'qr_codes/' . 'user_' . $user->id . '_activity_' . $request->activity_id . '.png';
        Storage::put($fileName, $qrCodeImage);  // 将二维码保存到本地存储

        // 更新数据库，保存二维码文件路径
        $signup->update([
            'qr_code' => $fileName,
        ]);

        return response()->json([
            'message' => '报名成功',
            'data' => $signup,
            'qr_code_url' => Storage::url($fileName),  // 返回二维码的可访问URL
        ]);
    }

    /**
     * 用户取消报名活动
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
        ]);

        $user = auth()->user();

        // 查找用户的报名记录
        $signup = ActivityUserSignup::where('user_id', $user->id)
            ->where('activity_id', $request->activity_id)
            ->first();

        // 如果没有找到报名记录，抛出异常
        if (!$signup) {
            throw new InvalidRequestException('您没有报名该活动');
        }

        // 删除报名记录
        $signup->delete();

        return response()->json([
            'message' => '取消报名成功',
        ]);
    }


    /**
     * 用户扫码签到
     */
    public function signin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activities,id',
        ]);

        $user = auth()->user();
        $signup = ActivityUserSignup::where('user_id', $request->user_id)
            ->where('activity_id', $request->activity_id)
            ->first();

        // 判断用户是否报名了活动
        if (!$signup) {
            throw new InvalidRequestException('您未报名该活动');
        }

        // 判断用户是否已经签到
        if ($signup->signed_in_at) {
            throw new InvalidRequestException('您已经签到');
        }

        // 更新签到时间
        $signup->update([
            'signed_in_at' => now(),
        ]);

        return response()->json([
            'message' => '签到成功',
        ]);
    }
}
