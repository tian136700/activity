<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 班级
 */
class SchoolClass extends Model
{
    protected $table = 'classes'; // 👈 指定表名

    protected $fillable = ['major_id', 'year', 'class_number'];

    /**
     * 班级属于某个专业
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * 获取班级名称（如：2023级软件工程2班）
     */
    public function getNameAttribute(): string
    {
        $majorName = $this->major?->name ?? '未知专业';
        return "{$this->year}级{$majorName}{$this->class_number}班";
    }
}
