<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // 黑名单设置为空
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 关联到部门表
     * 修改为外键 department_id
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id'); // 显式指定外键
    }

    /**
     * 关联到专业表
     * 修改为外键 major_id
     */
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id'); // 显式指定外键
    }

    /**
     * 关联到班级表
     */
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id'); // 使用 class_id 作为外键
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
