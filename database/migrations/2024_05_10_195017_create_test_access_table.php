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
        Schema::create('test_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['test_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_access');
    }
};
