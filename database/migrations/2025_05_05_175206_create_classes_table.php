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
        Schema::create('classes', function (Blueprint $table) {
            $table->id()->comment('主键 ID');

            $table->foreignId('major_id')
                ->constrained('majors')
                ->onDelete('cascade')
                ->comment('所属专业');

            $table->year('year')->comment('入学年份');

            $table->unsignedTinyInteger('class_number')->comment('班级编号，1~4 表示第几班');

            $table->timestamps();

            $table->unique(['major_id', 'year', 'class_number'], 'unique_class_per_major_per_year');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
