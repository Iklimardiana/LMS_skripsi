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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['pretest', 'postest', 'quiz']);
            $table->integer('duration');
            $table->enum('status', [1, 0])->default(0);
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
        Schema::dropIfExists('exam');
    }
};
