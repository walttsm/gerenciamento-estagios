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
        Schema::create('orientacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_orientacao');
            $table->time('horario');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('orientador_id');

            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('orientador_id')->references('id')->on('orientadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orientacao');
    }
};
