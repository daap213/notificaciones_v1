<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\User;
use App\Notifications\MensajeNotification;
use App\Events\MensajeEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Receptor;
use App\Emisor;
class ResponderController extends Controller
{
    public function responder($id){
		$usuarios= User::where('id','!=',auth()->id())->get();
		$mensajePre = Mensaje::find($id);
		$respuestaA = User::where('id','=',$mensajePre->user_id)->get();
		return view('formularios.ResponderMensajes',compact('usuarios','respuestaA'),compact('mensajePre'));
	}	
	public function storeR(Request $request , $id){
		//$user->notify(new InvoicePaid($invoice));
		//Para si mismo: auth()->user()->notify(new MensajeNotification($new));
		//Para uno solo where, no except.
		/*User::all()
			->except($new->user_id)
			->each(function(User $user) use ($new){
				$user->notify(new MensajeNotification($new));
			});*/
		//return $request->importancia;
		$new = new Mensaje;
		$new->RespondidoA = $id;
		if(!is_null($request->importancia)){
			 $new->importancia = "Importante";
		}
		else $new->importancia = "normal";
		$new->tema = $request->tema;
		$new->mensaje = $request->mensaje;
		//$new->receptor = Intval($request->receptor);
		$new->user_id = Auth::id();
		$correos = explode(",",$request->receptor);
		$correo =array_values(array_unique($correos));
		//$recep = User::whereIn('email',$correo)->get();
		$recep = User::whereIn('email',$correo)->select('users.id')->get();
		$new->receptor = $request->receptor;
		$new->save();
		$emiso = new Emisor;
		$emiso->mensaje_id = $new->id;
		$emiso->emisor = Auth::id();
		$emiso->save();
		foreach($recep as $rp){
			$nuevo = new Receptor;
			$nuevo->mensaje_id = $new->id;
			$nuevo->receptor = $rp->id;
			$nuevo->save();
		};

		//$recept = Receptor::where('mensaje_id','=',$new->id)->select('receptor')->get()->toArray();
		
		event(new MensajeEvent($new));
		return redirect('home')->with('message','Mensaje enviado');
	}
}
