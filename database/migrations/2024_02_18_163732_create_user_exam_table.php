<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam', function (Blueprint $table) {
            $table->id();
            $table->dateTime('begin');
            $table->dateTime('finish');
            $table->decimal('score')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('idExam');
            $table->unsignedBigInteger('idStudent');
            $table->foreign('idExam')->references('id')->on('exam')->onDelete('cascade');
            $table->foreign('idStudent')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_exam');
    }
};
