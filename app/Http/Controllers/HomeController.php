<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
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
		$id = Auth::id();
		$mensaje = DB::table('mensajes')->where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('home',compact('mensaje'));
    }
}
