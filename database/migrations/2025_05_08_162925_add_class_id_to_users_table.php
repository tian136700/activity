<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 添加 class_id 外键字段
            $table->unsignedBigInteger('class_id')->nullable()->after('major_id');

            // 修改外键约束，指向正确的 classes 表
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 删除外键约束
            $table->dropForeign(['class_id']);

            // 删除 class_id 字段
            $table->dropColumn('class_id');
        });
    }
}
