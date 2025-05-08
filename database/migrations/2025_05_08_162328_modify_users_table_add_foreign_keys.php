<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTableAddForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 添加外键字段
            $table->unsignedBigInteger('department_id')->nullable()->after('department');
            $table->unsignedBigInteger('major_id')->nullable()->after('major');

            // 添加外键约束
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');

            // 可选：如果不再需要原有的 department 和 major 字段，可以删除它们
            $table->dropColumn('department');
            $table->dropColumn('major');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 删除外键约束
            $table->dropForeign(['department_id']);
            $table->dropForeign(['major_id']);

            // 删除外键字段
            $table->dropColumn('department_id');
            $table->dropColumn('major_id');

            // 恢复原始的 department 和 major 字段
            $table->string('department')->after('phone');
            $table->string('major')->after('department');
        });
    }
}
