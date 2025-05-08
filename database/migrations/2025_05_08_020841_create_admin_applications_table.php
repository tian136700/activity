<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_applications', function (Blueprint $table) {
            $table->id()->comment('主键 ID');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('申请人（用户 ID）');
            $table->text('reason')->comment('申请理由');
            $table->tinyInteger('status')->default(0)->comment('审核状态：0未审核 1通过 2拒绝');
            $table->timestamp('reviewed_at')->nullable()->comment('审核时间');
            $table->foreignId('reviewer_id')->nullable()->constrained('admin_users')->nullOnDelete()->comment('审核管理员');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_applications');
    }
};
