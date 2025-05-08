<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidRequestException;

class AdminApplicationController extends Controller
{
    /**
     * 提交管理员申请
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        // 检查是否已存在未审核的申请
        $existing = AdminApplication::where('user_id', $userId)
            ->where('status', 0) // 未审核
            ->first();

        if ($existing) {
            throw new InvalidRequestException('您已有一条正在审核的申请，请勿重复提交。');
        }

        $application = AdminApplication::create([
            'user_id' => $userId,
            'reason' => $request->input('reason'),
            'status' => 0,
        ]);

        return response()->json([
            'message' => '申请提交成功，请等待管理员审核。',
            'data' => $application,
        ]);
    }
}
