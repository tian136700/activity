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
        Schema::create('activity_images', function (Blueprint $table) {
            $table->id()->comment('主键 ID');

            $table->foreignId('activity_id')
                ->constrained('activities')
                ->onDelete('cascade')
                ->comment('所属活动 ID');

            $table->string('image_path')->comment('图片地址');
            $table->integer('sort_order')->default(0)->comment('排序（越小越靠前）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_images');
    }
};

