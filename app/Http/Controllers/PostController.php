<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\MensajeNotification;
use App\Events\MensajeEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Post;

class PostController extends Controller
{
    public function show( $id ){
		$post = Post::find($id);
		$emisor = User::find($post->user_id);
		return view('postales.mostrarPost',compact('post'),compact('emisor'));
	}
	public function crear(){
		$usuarios= User::where('id','!=',auth()->id())->get();
		return view('postales.enviarPost',compact('usuarios'));
	}	
	public function store(Request $request){
		$post = new Post;
		$post->tema = $request->tema;
		$post->contenido = $request->contenido;
		$post->user_id = Auth::id();
		$post->save();		
		//event(new MensajeEvent($new));
		return redirect('post/recibidos')->with('message','Post enviado');
	}
	 public function recibido(){
		$emisor = User::all();
		$post = DB::table('posts')->orderBy('id', 'desc')->paginate(10);;
		return view('postales.postRecibido',compact('post'),compact('emisor'));
	}
}
