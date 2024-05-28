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
        Schema::create('interactive_simulators', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer');
            $table->json('options')->nullable();
            $table->unsignedBigInteger('test_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactive_simulators');
    }
};
