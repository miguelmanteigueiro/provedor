<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'comentarios';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Define uma relação entre Comentário e Solicitação.
     * Um comentário pertence a apenas uma solicitação.
     */
    public function solicitacao(){
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id', 'solicitacao_id');
    }

    /**
     * Define uma relação entre Comentário e AnexosComentário.
     * Um comentário pode ter vários anexos.
     */
    public function anexo(){
        return $this->hasMany(AnexosComentario::class);
    }

    /**
     * Define uma relação entre Comentário e Utilizador.
     * Um comentário pertence a apenas um utilizador.
     */
    public function utilizador(){
        return $this->belongsTo(User::class, 'utilizador_id', 'id');
    }
}

