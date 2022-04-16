<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'solicitacoes';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Solicitacao::where('solicitacao_id', $key);

        if ($obj->count() == 0)
            return null;

        $solicitacao = $obj->first();
        return $solicitacao;
    }
    
    /**
     * Define os Enums necessários para a DB
     */
    public const SITUACAO_ACADEMICA = ['nenhum', 'estudante', 'ex_estudante', 'candidato', 'outro'];

    /**
    * Devolve a situação académica numa string legível
    *
    * @return string
    */
    public function getSituacaoAcademicaAttribute()
    {
        if($this->attributes['situacao_academica'] === "ex_estudante"){
            return "Ex-Estudante";
        }
        if($this->attributes['situacao_academica'] === "nenhum"){
            return "Não se aplica";
        }
        return ucwords($this->attributes['situacao_academica']);
    }

    /**
     * Define uma relação entre Solicitação e Utilizador 
     * Uma solicitação apenas pertence a um utilizador
     */
    public function user(){
        return $this->belongsTo(User::class, 'utilizador_id', 'id');
    }

    /**
     * Define uma relação entre Solicitação e Comentário 
     * Uma solicitação pode ter vários comentários
     */
    public function comentario(){
        return $this->hasMany(Comentario::class);
    }

    /**
     * Define uma relação entre Solicitação e AnexoSolicitação.
     * Uma solicitação pode ter vários anexos.
     */
    public function anexo_solicitacao(){
        return $this->hasMany(AnexosSolicitacao::class);
    }

    /**
     * Define uma relação entre Solicitação e AnexoSolicitação.
     * Uma solicitação pode ter vários anexos.
     */
    public function analitica(){
        return $this->hasOne(Analitica::class);
    }

    /**
     * Define uma relação entre Solicitação e EstadoSolicitação.
     * Uma solicitação tem apenas um estado.
     */
    public function estado_solicitacao(){
        return $this->hasOne(EstadoSolicitacao::class);
    }

    /**
     * Define uma relação entre Solicitação e Log.
     * Uma solicitação pode ter vários logs.
     */
    public function log(){
        return $this->hasMany(Log::class);
    }

    /**
     * Define uma relação entre Solicitacao e SolicitacaoAssunto 
     * Uma solicitação pode ter vários assuntos.
     */
    public function solicitacao_assunto(){
        return $this->hasMany(SolicitacaoAssunto::class);
    }

}
