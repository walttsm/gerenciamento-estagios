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
        Schema::create('registro', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('assunto');
            $table->string('prox_assunto');
            $table->string('observacao');
            $table->boolean('presenca');

            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('orientador_id');
            $table->unsignedBigInteger('orientacao_id');

            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('orientadores')->onDelete('cascade');
            $table->foreign('orientacao_id')->references('id')->on('orientacao')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro');
    }
};
