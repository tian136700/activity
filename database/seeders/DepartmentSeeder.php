<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name'       => '计算机学院',
                'code'       => 'CS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '电子信息工程学院',
                'code'       => 'EIE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '外国语学院',
                'code'       => 'FL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '经济管理学院',
                'code'       => 'EM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '艺术学院',
                'code'       => 'ART',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '法学院',
                'code'       => 'LAW',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '建筑与规划学院',
                'code'       => 'ARCH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '医学院',
                'code'       => 'MED',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '文学院',
                'code'       => 'LIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '数学与统计学院',
                'code'       => 'MATH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '物理与信息工程学院',
                'code'       => 'PHY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '化学与化工学院',
                'code'       => 'CHEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '生物科学学院',
                'code'       => 'BIO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '新闻传播学院',
                'code'       => 'COMM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '环境科学与工程学院',
                'code'       => 'ENV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '历史学院',
                'code'       => 'HIST',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '哲学学院',
                'code'       => 'PHIL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => '音乐学院',
                'code'       => 'MUSIC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
