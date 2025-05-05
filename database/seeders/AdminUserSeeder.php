<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        logger("管理员数据填充");
        AdminUser::query()->truncate();//清空表的数据
        AdminUser::query()->create([
            "name" => "超级管理员",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "phone" => "0123456789",
        ]);
    }
}
