<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'assunto';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Assunto::where('assunto_id', $key);

        if ($obj->count() == 0)
            return null;

        $assunto = $obj->first();
        return $assunto;
    }

    /**
     * Define uma relação entre Assunto e Natureza.
     * Um assunto pertence apenas a uma natureza.
     */
    public function natureza(){
        return $this->belongsTo(Natureza::class, 'natureza_id', 'natureza_id');
    }

    /**
     * Define uma relação entre Assunto e AssuntoAnalitica.
     * Um assunto pode pertencer a várias analíticas.
     */
    public function assunto_analitica(){
        return $this->hasMany(AssuntoAnalitica::class, 'assunto_id', 'assunto_id');
    }

}
