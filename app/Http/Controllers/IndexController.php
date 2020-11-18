<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    function index() {
        return view('index', ['cadena' => '<script>alert(1);</script><a href="https://google.es">enlace</a>', 'nombre' => 'pepe']);
    }
    
    function ejemplo(Request $request) {
        return view('middleware', ['user' => $request->user, 'original' => $request->original]);
    }
    
    function sesion(Request $request) {
        // Facades
        // Request, laravel los inyecta
        // request() -> $request
        //muchos caminos
        $incrementar =  $request->get('incrementar');
        $suma = 0;
        if($request->session()->exists('sumacontinua')) {
            $suma = $request->session()->get('sumacontinua');
        }
        $leer = Session::get('flash');
        $leer2 = request()->session()->get('flash');
        $suma = $suma + $incrementar;
        if($incrementar == 11) {
            $request->session()->flash('flash', $incrementar);
        }
        
        if($incrementar == 11) {
            $request->session()->reflash();
        }
        $request->session()->put('sumacontinua', $suma);
        return view('sesion', ['incrementar' => $incrementar, 'suma' => $suma]);
    }
    
    function logo($id) {
        $file = '/var/www/logo/' . $id;
        if(!file_exists($file)) {
            $file = '/var/www/logo/logo.png';
        }
        return response()->file($file);
    }
    
    function privada($id) {
        $file = '/var/www/privada/' . $id;
        if(!file_exists($file)) {
            $file = '/var/www/privada/no.png';
        }
        return response()->file($file);
    }
}
