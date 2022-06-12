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
    protected $primaryKey = 'natureza_id';
    public $timestamps = false;

    protected $guarded = [];

    /**
     * Define uma relação entre Natureza e Assunto
     * Uma natureza pertence a vários assuntos.
     */
    public function assunto(){
        return $this->hasMany(Assunto::class, 'natureza_id', 'natureza_id');
    }
}
