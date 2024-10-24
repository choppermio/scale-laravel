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
        Schema::create('thakaat_results', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('score');
            $table->decimal('percentage', 5, 2); // e.g. 100.00%
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thakaat_results');
    }
};
