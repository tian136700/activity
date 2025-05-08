<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 用户报名表
 */
class ActivityUserSignup extends Model
{
    //黑名单设置为空
    protected $guarded = [];

    // 关联关系...
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

}

