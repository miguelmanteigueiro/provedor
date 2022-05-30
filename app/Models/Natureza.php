<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natureza extends Model
{
    //use HasFactory;

    /**
     * Define a tabela associada à classe.
     *
     * @var string
     */
    protected $table = 'natureza';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Override ao método find()
     * 
     * @var string
     */
    public static function find($key){
        $obj = Natureza::where('natureza_id', $key);

        if ($obj->count() == 0)
            return null;

        $natureza = $obj->first();
        return $natureza;
    }

    /**
     * Define uma relação entre Natureza e Assunto 
     * Uma natureza pertence a vários assuntos.
     */
    public function assunto(){
        return $this->hasMany(Assunto::class, 'natureza_id', 'natureza_id');
    }
}
