<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //
    //黑名单设置为空
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'admin_user_id');
    }

}
