<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Solicitacao;

class CreateSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id('solicitacao_id');
            $table->foreignId('utilizador_id')->constrained('users')->references('id')->cascadeOnDelete();
            $table->string('referencia_interna')->nullable();
            $table->enum('situacao_academica', Solicitacao::SITUACAO_ACADEMICA);
            $table->integer('estudante_id')->nullable();
            $table->string('estudante_nome');
            $table->string('estudante_email');
            $table->string('estudante_telefone')->nullable();
            $table->text('descricao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacoes');
    }
}
