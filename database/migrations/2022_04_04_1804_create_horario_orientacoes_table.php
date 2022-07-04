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
        Schema::create('horario_orientacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('dia');
            $table->time('hora');
            $table->unsignedBigInteger('orientador_id');
            // $table->unsignedBigInteger('aluno_id')->nullable();
            $table->timestamps();

            $table->foreign('orientador_id')->references('id')->on('orientadores');
            // $table->foreign('aluno_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_orientacoes');
    }
};
