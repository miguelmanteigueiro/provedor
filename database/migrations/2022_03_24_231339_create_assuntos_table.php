<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assuntos', function (Blueprint $table) {
            $NATUREZA_ASSUNTO = ['academico_administrativa', 'acao_social', 'pedagogica', 'diversos', 'outra'];

            $table->id('assunto_id');
            $table->enum('natureza_assunto', $NATUREZA_ASSUNTO);
            $table->text('descricao_assunto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assuntos');
    }
}
