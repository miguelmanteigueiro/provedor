<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analitica extends Model
{
    //use HasFactory;
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'analitica';
    public $timestamps = false;

    /**
     * Define uma relação entre Analitica e Solicitação.
     * Uma tabela com analítica pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class);
    }
}