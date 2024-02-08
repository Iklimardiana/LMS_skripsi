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
        Schema::create('question_discussion', function (Blueprint $table) {
            $table->id();
            $table->longText('question');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('idMaterial');
            $table->foreign('idMaterial')->references('id')->on('material')->onDelete('cascade');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('idSubject');
            $table->foreign('idSubject')->references('id')->on('subject')->onDelete('cascade');
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
        Schema::dropIfExists('question_discussion');
    }
};
