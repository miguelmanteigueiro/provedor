<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssuntoAnalitica extends Model
{
    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'assunto_analitica';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Override ao método find()
     *
     * @var string
     */
    public static function find($key){
        $obj = AssuntoAnalitica::where('assunto_analitica_id', $key);

        if ($obj->count() == 0)
            return null;

        $assunto_analitica = $obj->first();
        return $assunto_analitica;
    }

    /**
     * Define uma relação entre AssuntoAnalitica e Assunto.
     * Um assunto_analitica pertence apenas a um assunto.
     */
    public function assunto(){
        return $this->belongsTo(Assunto::class, 'assunto_id', 'assunto_id');
    }

    /**
     * Define uma relação entre AssuntoAnalitica e Analitica.
     * Um assunto_analitica pertence apenas a uma analítica.
     */
    public function analitica(){
        return $this->belongsTo(Analitica::class, 'analitica_id', 'analitica_id');
    }
}
