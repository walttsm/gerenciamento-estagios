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
        Schema::create('alunos_aviso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aviso_id');
            $table->unsignedBigInteger('aluno_id');
            $table->timestamps();

            $table->foreign('aviso_id')->references('id')->on('aviso')->onDelete('cascade');
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos_aviso');
    }
};
