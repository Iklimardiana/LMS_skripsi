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
        Schema::create('assignment', function (Blueprint $table) {
            $table->id();
            $table->string('attachment');
            $table->enum('type', ['file', 'link']);
            $table->enum('category', ['fromteacher', 'fromstudent']);
            $table->float('score')->nullable();
            $table->unsignedBigInteger('idSubject');
            $table->unsignedBigInteger('idMaterial');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idSubject')->references('id')->on('subject')->onDelete('cascade');
            $table->foreign('idMaterial')->references('id')->on('material')->onDelete('cascade');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('assignment');
    }
};
