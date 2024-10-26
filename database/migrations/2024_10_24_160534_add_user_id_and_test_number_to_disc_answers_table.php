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
        Schema::table('disc_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id'); // Add user_id column
            $table->string('test_number')->after('user_id'); // Add test_number column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            //
        });
    }
};
