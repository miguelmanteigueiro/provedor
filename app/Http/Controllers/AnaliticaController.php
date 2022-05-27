<?php

namespace App\Http\Controllers;

class AnaliticaController extends Controller
{
    public function view(){
        return view('admin.analitica');
    }

    public function showAssuntos(){
        return view('admin.assuntos');
    }
}
