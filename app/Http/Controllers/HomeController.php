<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $rol = $user->roles->implode('name', ', ');
        switch ($rol) {

            case 'admin':
                $inicio = "Bienvenido administrador";

                return view('home', compact('inicio'));
                break;

            case 'lector':
                $inicio = "Bienvenido lector";

                return view('home', compact('inicio'));
                break;

            case 'escritor':
                $inicio = "Bienvenido escritor";

                return view('home', compact('inicio'));
                break;
        }
    }
}
