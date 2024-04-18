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
        Schema::create('user_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
			$table->unsignedBigInteger('task_id');
            $table->timestamps();
			$table->primary(['student_id', 'task_id']);
			$table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_applications');
    }
};
