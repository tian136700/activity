<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use  App\Models\User;
use  Illuminate\Support\Facades\Hash;

/**
 * 令牌生成
 */
class AuthorizationsController extends Controller
{


    /**
     * 登录
     * @param AuthorizationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws InvalidRequestException
     */
    public function store(AuthorizationRequest $request)
    {
        $credentials = $request->only(['username', 'password']);

        // 查找用户
        $user = User::where('username', $credentials['username'])->first();

        // 验证用户是否存在且密码正确
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw  new InvalidRequestException('用户名或密码错误');
        }
        //登录成功-发放令牌
         $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => 'Bearer '.$token]);
    }


}
