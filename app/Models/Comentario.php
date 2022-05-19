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
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Comentario::where('comentario_id', $key);

        if ($obj->count() == 0)
            return null;

        $comentario = $obj->first();
        return $comentario;
    }

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
        return $this->hasMany(AnexosComentario::class, null, "comentario_id");
    }

    /**
     * Define uma relação entre Comentário e Utilizador.
     * Um comentário pertence a apenas um utilizador.
     */
    public function utilizador(){
        return $this->belongsTo(User::class, 'utilizador_id', 'id');
    }
}

