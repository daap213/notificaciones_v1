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

class MensajeController extends Controller
{

	 public function mandado(){
		$id = Auth::id();
		$usuarios= User::where('id','!=',$id)->get();
		$mensaje = DB::table('mensajes')
					->leftJoin('emisors',"mensajes.id","=","emisors.mensaje_id")
					->select("mensajes.*")
					->where('emisors.emisor','=',$id)
					->orderBy('id', 'desc')->paginate(10);
		//$mensaje = DB::table('mensajes')->whereIn('user_id', $id)->orderBy('id', 'desc')->paginate(10);
		return view('formularios.MnsMandados',compact('usuarios'),compact('mensaje'));
	}
	 public function recibido(){
		$id = Auth::id();
		$usuarios= User::where('id','!=',$id)->get();
		$mensajes = DB::table('mensajes')
					->leftJoin('receptors',"mensajes.id","=","receptors.mensaje_id")
					->select("mensajes.*")
					->where('receptors.receptor','=',$id)
					->orderBy('id', 'desc')->paginate(10,['*'],'recibido');	
		return view('formularios.MnsRecibidos',compact('usuarios'),compact('mensajes'));

	}
	public function show( $noti_id ){
		/*if($recep == auth()->user())[
			$notificacion= auth()->user()->unreadNotifications->where('id',$noti_id)
			$mensaje = Mensaje::find($notificacion->data['mensaje'])]; 
		else $mensaje = Mensaje::find($noti_id);*/
		/*if($recep == auth()->user())[
			$notificacion= auth()->user()->unreadNotifications->where('id',$noti_id)
		]; */
		/*
		if(is_numeric($noti_id)){
			$mensaje = Mensaje::find($noti_id);
			$notificacion = "";
		}
		elseif (!empty(auth()->user()->unreadNotifications->where('id',$noti_id)[0]))
			{$notificacion= auth()->user()->unreadNotifications->where('id',$noti_id)[0];
			$mensaje = Mensaje::find($notificacion->data['mensaje']);}
		else {$notificacion= auth()->user()->readNotifications->where('id',$noti_id);
			$mensaje = Mensaje::find($notificacion->data['mensaje']);}
		
		$recep = User::leftJoin("mensajes","users.id","In","mensajes.receptor")
				->select("users.email","users.name")
				->where('mensajes.id','=',$noti_id)->get();
		*/
		$id = Auth::id();
		$mensaje = Mensaje::find($noti_id);
		$emisor = User::find($mensaje->user_id);
		$correos = explode(",",$mensaje->receptor);
		$recep=array_values(array_unique($correos));
		if($id==$mensaje->user_id){
					return view('formularios.mostrarMsjEnviado',compact('mensaje'),compact('emisor','recep'));
		};
		return view('formularios.mostrarMensaje',compact('mensaje'),compact('emisor','recep'));
	}
	public function crear(){
		$usuarios= User::where('id','!=',auth()->id())->get();
		return view('formularios.enviarMensaje',compact('usuarios'));
	}	
	public function store(Request $request){
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
		if(!is_null($request->importancia)){
			 $new->importancia = "Importante";
		}
		else $new->importancia = "normal";
		$new->tema = $request->tema;
		$new->mensaje = $request->mensaje;
		$new->user_id = Auth::id();
		$correos = explode(",",$request->receptor);
		$correo =array_values(array_unique($correos));
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
		event(new MensajeEvent($new));
		return redirect('/mensaje/recibidos')->with('message','Mensaje enviado');
	}
	
	public function destroy($id){
		$mensaje = Mensaje::find($id);
		$yoid = Auth::id();
		if($yoid == $mensaje->user_id){
				$emisor = DB::table('emisors')->where('mensaje_id',$id);
				$emisor->delete();
				return back();
		};
		$recept = DB::table('receptors')->where('mensaje_id',$id)->where('receptor',$yoid);
		$recept->delete();
		return back();
	}
	public function markMensaje(Request $request){
		 auth()->user()->unreadNotifications
			->when($request->input('id'),function($query) use ($request){
				return $query->where('id',$request->input('id'));
			})->markAsRead();
		return response()->noContent();
	}
}
