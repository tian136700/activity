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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('主键 ID');
            $table->string('name')->comment('姓名');
            $table->string('student_id')->unique()->comment('学号');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->string('username')->unique()->nullable()->comment('用户名');
            $table->string('phone')->unique()->nullable()->comment('手机号');
            $table->string('password')->comment('密码（加密存储）');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->comment('性别');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('department')->nullable()->comment('院系');
            $table->string('major')->nullable()->comment('专业');
            $table->integer('year')->nullable()->comment('入学年份');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->rememberToken()->comment('记住我 Token');
            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
