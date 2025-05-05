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
        Schema::create('majors', function (Blueprint $table) {
            $table->id()->comment('主键 ID');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade')->comment('所属院系');
            $table->string('name')->comment('专业名称');
            $table->string('code')->nullable()->comment('专业代码');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
