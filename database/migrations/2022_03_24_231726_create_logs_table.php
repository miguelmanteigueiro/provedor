<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->references('solicitacao_id');
            $table->foreignId('utilizador_id')->constrained('users')->references('id');
            $table->timestamp('data_edicao');
            $table->string('motivo_edicao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
