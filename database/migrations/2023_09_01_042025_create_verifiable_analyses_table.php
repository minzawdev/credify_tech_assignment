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
        Schema::create('verifiable_analysis', function (Blueprint $table) {
            $table->id();
            $table->string('file_id')->nullable();
            $table->integer('user_id');
            $table->string('file_type')->default('json');
            $table->json('verification_result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifiable_analysis');
    }
};
