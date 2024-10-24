<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('thakaat_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Assuming you have users table
            $table->unsignedBigInteger('question_id');  // Assuming you have users table
            $table->text('answer');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
