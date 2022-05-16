<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosSolicitacao extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'anexos_solicitacao';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = AnexosSolicitacao::where('anexo_solicitacao_id', $key);

        if ($obj->count() == 0)
            return null;

        $anexo = $obj->first();
        return $anexo;
    }

    /**
     * Define uma relação entre AnexoSolicitação e Solicitação.
     * Um anexo pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id', 'solicitacao_id');
    }

}
