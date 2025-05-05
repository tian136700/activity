<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 院系
 */
class Department extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    /**
     * 院系拥有多个专业
     */
    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}
