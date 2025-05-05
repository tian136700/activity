<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("姓名");
            $table->string("phone")->comment("电话号码");
            $table->string("username")->comment("用户名");
            $table->string("password")->comment("密码");
            $table->rememberToken();
            $table->timestamps();
            $table->comment("管理员表");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
