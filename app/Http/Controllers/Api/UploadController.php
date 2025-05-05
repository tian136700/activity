<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
class UploadController extends Controller
{
    /**
     * 上传图片（仅限图片格式）
     */
    public function uploadImage(Request $request)
    {
        // 校验上传字段
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 限制最大2MB
        ]);

        $file = $request->file('image');

        // 存储到 storage/app/public/uploads
        $path = $file->store('uploads/images', 'public');

        return response()->json([
            'message' => '上传成功',
            'url' => asset('storage/' . $path),
            'path' => $path,
        ]);
    }
}
