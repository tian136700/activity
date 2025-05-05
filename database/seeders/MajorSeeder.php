<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        // 院系名称 => 专业列表
        $majorsByDepartment = [
            '计算机学院' => ['软件工程', '计算机科学与技术', '人工智能', '数据科学与大数据技术'],
            '电子信息工程学院' => ['电子信息工程', '通信工程', '集成电路设计'],
            '外国语学院' => ['英语', '日语', '翻译'],
            '经济管理学院' => ['工商管理', '市场营销', '会计学', '金融学'],
            '艺术学院' => ['视觉传达设计', '环境设计', '数字媒体艺术'],
            '法学院' => ['法学', '知识产权'],
            '建筑与规划学院' => ['建筑学', '城乡规划', '风景园林'],
            '医学院' => ['临床医学', '护理学', '口腔医学'],
            '文学院' => ['汉语言文学', '对外汉语'],
            '数学与统计学院' => ['数学与应用数学', '信息与计算科学', '统计学'],
            '物理与信息工程学院' => ['物理学', '电子信息科学与技术'],
            '化学与化工学院' => ['化学', '应用化学'],
            '生物科学学院' => ['生物科学', '生物技术'],
            '新闻传播学院' => ['新闻学', '广告学', '广播电视学'],
            '环境科学与工程学院' => ['环境科学', '环境工程'],
            '历史学院' => ['历史学', '世界历史'],
            '哲学学院' => ['哲学', '伦理学'],
            '音乐学院' => ['音乐学', '音乐表演'],
        ];

        $now = now();

        foreach ($majorsByDepartment as $departmentName => $majors) {
            $department = DB::table('departments')->where('name', $departmentName)->first();

            if (!$department) {
                continue;
            }

            foreach ($majors as $majorName) {
                DB::table('majors')->insert([
                    'department_id' => $department->id,
                    'name' => $majorName,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
