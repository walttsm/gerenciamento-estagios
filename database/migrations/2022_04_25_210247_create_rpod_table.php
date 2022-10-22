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
        Schema::create('rpod', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('horas_mes');
            $table->string('local_arquivo');
            $table->string('rpod_title');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('orientador_id');

            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('orientadores')->onDelete('cascade');
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
        Schema::dropIfExists('rpod');
    }
};
