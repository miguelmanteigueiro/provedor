<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUtilizador extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'info_utilizadores';
    public $timestamps = false;

    /**
     * Define uma relação entre InfoUtilizador e Utilizador.
     * Uma informação apenas pertence a um utilizador.
     */
    public function utilizador(){
        return $this->belongsTo(Utilizador::class);
    }
}
