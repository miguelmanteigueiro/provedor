<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosComentario extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'anexos_comentario';
    public $timestamps = false;

    /**
     * Define uma relação entre AnexosComentário e Comentário.
     * Um anexo pertence a apenas um comentário.
     */
    public function comentario(){
        return $this->belongsTo(Comentario::class);
    }
}
