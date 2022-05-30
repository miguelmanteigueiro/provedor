<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuntoAnaliticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assunto_analitica', function (Blueprint $table) {
            $table->id('assunto_analitica_id');
            $table->foreignId('assunto_id')->constrained('assunto')->references('assunto_id')->cascadeOnDelete();
            $table->foreignId('analitica_id')->constrained('analitica')->references('analitica_id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assunto_analitica');
    }
}
