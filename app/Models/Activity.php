<?php

namespace App\Models;

use App\Observers\ActivityObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ActivityObserver::class])]//观察器导入
class Activity extends Model
{
    //黑名单设置为空
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * 查找活动发起人信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }

}
