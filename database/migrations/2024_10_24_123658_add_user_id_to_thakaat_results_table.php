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
        Schema::table('thakaat_results', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->after('id'); // or specify a different location
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thakaat_results', function (Blueprint $table) {
            //
        });
    }
};
