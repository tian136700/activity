<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_sign_in_status_to_activity_user_signups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignInStatusToActivityUserSignupsTable extends Migration
{
    public function up()
    {
        Schema::table('activity_user_signups', function (Blueprint $table) {
            // 添加签到状态字段，默认是 0（未签到）
            $table->tinyInteger('sign_in_status')->default(0);
        });
    }

    public function down()
    {
        Schema::table('activity_user_signups', function (Blueprint $table) {
            // 删除签到状态字段
            $table->dropColumn('sign_in_status');
        });
    }
}
