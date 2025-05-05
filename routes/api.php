<?php

use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\ClassController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/test-api', function (Request $request) {
    echo 'ceshiapi';
});

#用户注册
Route::post('users',[UsersController::class,'store'])
    ->name('users.store');
#登录
Route::post('authorizations',[\App\Http\Controllers\Api\AuthorizationsController::class,'store'])
    ->name('authorizations.store');



Route::middleware('auth:sanctum')->group(function () {
    #用户登录信息
    Route::get('me',[UsersController::class,'me'])
        ->name('users.me');
});

//用户编辑
Route::put('users/{user}',[UsersController::class,'update'])
   ->name('users.update');


//图片上传
Route::post('/upload/image', [UploadController::class, 'uploadImage']);

//获取院系专业班级的api接口
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{id}/majors', [DepartmentController::class, 'majors']);
Route::get('/majors/{id}/classes', [MajorController::class, 'classes']);

