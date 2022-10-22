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
        Schema::create('documentos_estagio', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('local_arquivo');
            $table->string('arquivo_title');
            $table->string('doc_nome');
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
        Schema::dropIfExists('documentos_estagio');
    }
};
