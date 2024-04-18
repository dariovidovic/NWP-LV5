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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('naziv_rada');
            $table->string('naziv_rada_en');
            $table->string('zadatak_rada');
            $table->string('tip_studija');
            $table->unsignedBigInteger('nastavnik_id');
            $table->unsignedBigInteger('assignee')->nullable()->default(null);
            $table->foreign('nastavnik_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assignee')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
