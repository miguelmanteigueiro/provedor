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
    
    protected $guarded = [];

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = AnexosComentario::where('anexo_comentario_id', $key);

        if ($obj->count() == 0)
            return null;

        $anexo = $obj->first();
        return $anexo;
    }

    /**
     * Define uma relação entre AnexosComentário e Comentário.
     * Um anexo pertence a apenas um comentário.
     */
    public function comentario(){
        return $this->belongsTo(Comentario::class, "comentario_id", "comentario_id");
    }
}
