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
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Analitica::where('analitica_id', $key);

        if ($obj->count() == 0)
            return null;

        $analitica = $obj->first();
        return $analitica;
    }

    /**
     * Define uma relação entre Analitica e Solicitação.
     * Uma tabela com analítica pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id', 'solicitacao_id');
    }

    /**
     * Define uma relação entre Analitica e AssuntoAnalitica.
     * Uma analítica pode ter vários assuntos.
     */
    public function assunto_analitica(){
        return $this->hasMany(AssuntoAnalitica::class, 'analitica_id', 'analitica_id');
    }

}