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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('orientador_id');

            $table->unsignedBigInteger('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('orientadores')->onDelete('cascade');
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
