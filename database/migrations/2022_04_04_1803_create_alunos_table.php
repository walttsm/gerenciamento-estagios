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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_aluno');
            $table->string('curso');
            $table->string('matricula')->unique();
            $table->string('email')->unique();
            $table->string('nome_trabalho')->nullable();
            $table->unsignedBigInteger('turma_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('orientador_id')->nullable();
            $table->unsignedBigInteger('banca1_id')->nullable();
            $table->unsignedBigInteger('banca2_id')->nullable();

            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('orientadores')->onDelete('SET NULL');
            $table->foreign('banca1_id')->references('id')->on('orientadores')->onDelete('SET NULL');
            $table->foreign('banca2_id')->references('id')->on('orientadores')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
};
