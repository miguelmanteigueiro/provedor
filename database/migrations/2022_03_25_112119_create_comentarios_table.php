<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('comentario_id');
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->references('solicitacao_id')->cascadeOnDelete();
            $table->foreignId('utilizador_id')->constrained('users')->references('id')->cascadeOnDelete();
            $table->timestamp('data_comentario');
            $table->text('comentario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
