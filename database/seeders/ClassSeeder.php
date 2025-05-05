<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $year = 2023; // 可改为动态年份，比如 now()->year
        $now = now();

        // 遍历所有专业
        $majors = DB::table('majors')->get();

        foreach ($majors as $major) {
            // 固定为 4 个班
            foreach (range(1, 4) as $classNumber) {
                DB::table('classes')->insert([
                    'major_id'     => $major->id,
                    'year'         => $year,
                    'class_number' => $classNumber,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ]);
            }
        }
    }
}
