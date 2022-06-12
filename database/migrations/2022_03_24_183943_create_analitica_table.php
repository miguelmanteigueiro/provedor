<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnaliticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analitica', function (Blueprint $table) {
            $TIPO_SOLICITACAO = ['nenhum', 'aconselhamento', 'orientacao', 'informacao', 'mediacao', 'outro'];
            $TIPO_APRESENTACAO = ['nenhum', 'individual', 'coletiva'];
            $FORMA_CONTACTO = ['nenhum', 'email', 'correio_postal', 'formulario', 'presencial', 'telefone', 'outra'];
            $CICLO_ESTUDOS = ['nenhum', '1_ciclo', '2_ciclo', 'mestrado_integrado', '3_ciclo'];

            $table->id('analitica_id');
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->references('solicitacao_id')->cascadeOnDelete();
            $table->enum('tipo_solicitacao', $TIPO_SOLICITACAO);
            $table->enum('apresentacao', $TIPO_APRESENTACAO);
            $table->enum('forma_contacto', $FORMA_CONTACTO);
            $table->enum('ciclo_estudos', $CICLO_ESTUDOS);
            $table->string('curso')->nullable();
            $table->boolean('follow_up')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analitica');
    }
}
