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
        Schema::create('activity_user_signups', function (Blueprint $table) {
            $table->id()->comment('主键 ID');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->comment('报名的用户');

            $table->foreignId('activity_id')
                ->constrained('activities')
                ->onDelete('cascade')
                ->comment('关联活动');

            $table->timestamp('signed_at')->nullable()->comment('报名时间');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_user_signups');
    }
};
