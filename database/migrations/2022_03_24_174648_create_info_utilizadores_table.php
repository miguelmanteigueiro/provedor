<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoUtilizadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_utilizadores', function (Blueprint $table) {
            $table->foreignId('utilizador_id')->constrained('utilizadores')->references('utilizador_id');
            $table->timestamp('data_criacao')->useCurrent();
            $table->boolean('administrador')->default(false);
            $table->boolean('conta_ativa')->default(true);
            $table->timestamp('ultimo_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_utilizadores');
    }
}
