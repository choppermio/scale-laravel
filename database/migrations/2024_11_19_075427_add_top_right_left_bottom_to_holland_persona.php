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
        Schema::table('holland_personas', function (Blueprint $table) {
            $table->integer('top')->nullable();
            $table->integer('right')->nullable();
            $table->integer('left')->nullable();
            $table->integer('bottom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('holland_persona', function (Blueprint $table) {
            //
        });
    }
};
