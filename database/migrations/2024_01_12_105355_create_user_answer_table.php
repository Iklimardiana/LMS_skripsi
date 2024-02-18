<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer', function (Blueprint $table) {
            $table->id();
            $table->string('user_answer');
            $table->enum('is_correct', [0, 1]);
            $table->unsignedBigInteger('idUserExam');
            $table->unsignedBigInteger('idQuestion');
            $table->foreign('idUserExam')->references('id')->on('user_exam')->onDelete('cascade');
            $table->foreign('idQuestion')->references('id')->on('question')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_answer');
    }
};
