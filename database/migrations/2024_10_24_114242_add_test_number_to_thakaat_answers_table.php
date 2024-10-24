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
        Schema::table('thakaat_answers', function (Blueprint $table) {
            $table->integer('test_number')->nullable()->after('id'); // or specify a different location
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thakaat_answers', function (Blueprint $table) {
            //
        });
    }
};
