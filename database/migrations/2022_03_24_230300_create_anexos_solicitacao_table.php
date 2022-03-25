<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosSolicitacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_solicitacao', function (Blueprint $table) {
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->references('solicitacao_id');
            $table->id('anexo_solicitacao_id');
            $table->binary('anexo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexos_solicitacao');
    }
}
