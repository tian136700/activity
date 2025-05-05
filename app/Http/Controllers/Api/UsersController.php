<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


/**
 * 前端用户注册
 */
class UsersController extends Controller
{


    /**
     * 用户创建
     * @param UsersRequest $request
     * @param User $user
     * @return UserResource
     * @throws InvalidRequestException
     */
    public function store(UsersRequest $request,User $user)
    {
        if (User::query()->where('username',$request->username)->exists()) {
            throw new InvalidRequestException('用户名已存在');
        }

        $data = $request->only([
            'name',
            'username',
            'email',
            'password',
            'phone',
            'gender',
            'department',
            'major',
            'year',
            'student_id'
        ]);

        $user = User::create($data);

        return new  UserResource($user);
    }


    /**
     * 用户数据更新
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
   public function update(Request $request,User $user):UserResource
   {

        $user->fill($request->all());
        $user->update();
        return new  UserResource($user);

   }

    /**
     * 登录信息
     * @param Request $request
     * @return UsersRequest
     */
    public function me(Request $request):UserResource
    {
        $user = $request->user();
        return new UserResource($user);
    }
}
