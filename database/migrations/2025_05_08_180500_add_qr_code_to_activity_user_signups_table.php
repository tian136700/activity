<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_qr_code_to_activity_user_signups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodeToActivityUserSignupsTable extends Migration
{
    public function up()
    {
        Schema::table('activity_user_signups', function (Blueprint $table) {
            // 添加存储二维码的字段
            $table->string('qr_code')->nullable();  // 存储二维码路径或文件名
        });
    }

    public function down()
    {
        Schema::table('activity_user_signups', function (Blueprint $table) {
            // 回滚时删除该字段
            $table->dropColumn('qr_code');
        });
    }
}
