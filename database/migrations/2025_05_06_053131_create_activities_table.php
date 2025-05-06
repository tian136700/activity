<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id()->comment('主键 ID');
            $table->string('title')->comment('活动标题');
            $table->text('description')->nullable()->comment('活动简介');
            $table->dateTime('start_time')->comment('开始时间');
            $table->dateTime('end_time')->comment('结束时间');
            $table->dateTime('register_deadline')->nullable()->comment('报名截止时间');
            $table->string('location')->nullable()->comment('活动地点');
            $table->unsignedBigInteger('admin_user_id')->comment('发起人（管理员ID）');
            $table->integer('participant_limit')->nullable()->comment('报名人数限制');
            $table->unsignedTinyInteger('status')->default(0)->comment('活动状态：0未开始 1进行中 2已结束');
            $table->timestamps();

            // 外键指向 admin_users 表
            $table->foreign('admin_user_id')
                ->references('id')
                ->on('admin_users') // ✅ 复数形式
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
