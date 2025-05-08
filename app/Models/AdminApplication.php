<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * 管理员申请
 */
class AdminApplication extends Model
{
    use HasFactory;

    //黑名单设置为空
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(AdminUser::class, 'reviewer_id');
    }
}
