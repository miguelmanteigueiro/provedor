<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssuntoAnalitica extends Model
{
    //use HasFactory;

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

}
