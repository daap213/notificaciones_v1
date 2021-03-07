<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\User;
use App\Notifications\MensajeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class MensajeController extends Controller
{
    public function crear(){
		$usuarios= User::where('id','!=',auth()->id())->get();
		return view('formularios.enviarMensaje',compact('usuarios'));
	}
	public function store(Request $request){
		
		$new = new Mensaje;
		$new->tema = $request->tema;
		$new->mensaje = $request->mensaje;
		$new->receptor = $request->receptor;;
		$new->user_id = Auth::id();
		$new->save();
		//$user->notify(new InvoicePaid($invoice));
		auth()->user()->notify(new MensajeNotification($new));
		return redirect('home')->with('message','Mensaje enviado');
	}
	public function destroy($id){
		$mensaje = Mensaje::find($id);
		$mensaje->delete();
		return redirect('home');
	}
}
