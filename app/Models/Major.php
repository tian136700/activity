<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 专业
 */
class Major extends Model
{
    protected $fillable = ['department_id', 'name', 'code'];

    /**
     * 专业属于某个院系
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * 专业下有多个班级
     */
    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'major_id');
    }
}
