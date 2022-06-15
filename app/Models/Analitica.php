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

    protected $guarded = [];

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
     * Devolve o tipo de solicitação numa string legível
     *
     * @return string
     */
    public function getTipoSolicitacaoAttribute()
    {
        if($this->attributes['tipo_solicitacao'] === "orientacao"){
            return "Orientação";
        }

        if($this->attributes['tipo_solicitacao'] === "orientacao"){
            return "Orientação";
        }

        if($this->attributes['tipo_solicitacao'] === "informacao"){
            return "Informação";
        }

        if($this->attributes['tipo_solicitacao'] === "mediacao"){
            return "Mediação";
        }

        return ucwords($this->attributes['tipo_solicitacao']);
    }


    /**
     * Devolve o tipo de apresentação numa string legível
     *
     * @return string
     */
    public function getApresentacaoAttribute()
    {
        return ucwords($this->attributes['apresentacao']);
    }


    /**
     * Devolve a forma de contacto numa string legível
     *
     * @return string
     */
    public function getFormaContactoAttribute()
    {
        if($this->attributes['forma_contacto'] === "email"){
            return "Correio Eletrónico";
        }

        if($this->attributes['forma_contacto'] === "correio_postal"){
            return "Correio Postal";
        }

        if($this->attributes['forma_contacto'] === "formulario"){
            return "Formulário";
        }

        return ucwords($this->attributes['forma_contacto']);
    }


    /**
     * Devolve o ciclo de estudos numa string legível
     *
     * @return string
     */
    public function getCicloEstudosAttribute()
    {
        if($this->attributes['ciclo_estudos'] === "1_ciclo"){
            return "1º Ciclo";
        }

        if($this->attributes['ciclo_estudos'] === "2_ciclo"){
            return "2º Ciclo";
        }

        if($this->attributes['ciclo_estudos'] === "3_ciclo"){
            return "3º Ciclo";
        }

        if($this->attributes['ciclo_estudos'] === "mestrado_integrado"){
            return "Mestrado Integrado";
        }
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
