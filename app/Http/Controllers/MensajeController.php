<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\User;
use App\Notifications\MensajeNotification;
use App\Events\MensajeEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use App\Receptor;
use App\Emisor;
use App\Archivo;
use RealRashid\SweetAlert\Facades\Alert;

class MensajeController extends Controller
{

	public function todo()
	{
		$usuarios = User::all();
		$mensajes = DB::table('mensajes')
			->orderBy('id', 'desc')->paginate(10);

		return view('formularios.mensajesAll', compact('usuarios'), compact('mensajes'));
	}

	public function mandado()
	{
		$id = Auth::id();
		$usuarios = User::usuariosAsignar();
		$mensaje = DB::table('mensajes')
			->leftJoin('emisors', "mensajes.id", "=", "emisors.mensaje_id")
			->select("mensajes.*")
			->where('emisors.emisor', '=', $id)
			->orderBy('id', 'desc')->paginate(10);

		return view('formularios.MnsMandados', compact('usuarios'), compact('mensaje'));
	}
	public function recibido()
	{
		$id = Auth::id();
		$usuarios = User::usuariosAsignar();
		$mensajes = DB::table('mensajes')
			->leftJoin('receptors', "mensajes.id", "=", "receptors.mensaje_id")
			->select("mensajes.*")
			->where('receptors.receptor', '=', $id)
			->orderBy('id', 'desc')->paginate(10, ['*'], 'recibido');
		return view('formularios.MnsRecibidos', compact('usuarios'), compact('mensajes'));
	}
	public function show($noti_id)
	{

		$id = Auth::id();
		$mensaje = Mensaje::find($noti_id);
		$emisor = User::find($mensaje->user_id);
		$archivos = Archivo::where('mensaje_id', $noti_id)->get();
		$correos = explode(",", $mensaje->receptor);
		$recep = array_values(array_unique($correos));

		if ($id == $mensaje->user_id) {
			return view('formularios.mostrarMsjEnviado', compact('mensaje'), compact('emisor', 'archivos'));
		};

		return view('formularios.mostrarMensaje', compact('mensaje'), compact('emisor', 'archivos'));
	}
	public function crear()
	{
		$usuarios = User::usuariosAsignar();
		return view('formularios.enviarMensaje', compact('usuarios'));
	}
	public function store(Request $request)
	{

		$request->validate(
			[
				"file" => "array|max:3",
				"file.*" => "file|mimes:jpeg,jpg,gif,png,pdf,doc,docx,ppt,ppxt,pdf,xlsx,rar,zip|max:10000",
			],
			[
				'max' => [
					'file' => 'El :attribute no debe pesar mas de :max kilobytes.',
					'array' => 'El :attribute no debe tener mas de :max archivos.'
				],
				'mimes' => 'El :attribute no tiene una extension permitida.'
			]
		);

		$new = new Mensaje;

		if (!is_null($request->importancia)) {
			$new->importancia = "Importante";
		} else $new->importancia = "normal";

		$new->tema = $request->tema;
		$new->mensaje = $request->mensaje;
		$new->user_id = Auth::id();
		$correos = explode(",", $request->receptor);
		$correo = array_values(array_unique($correos));
		$recep = User::whereIn('email', $correo)->select('users.id')->get();
		$new->receptor = $request->receptor;
		$new->save();
		$emiso = new Emisor;
		$emiso->mensaje_id = $new->id;
		$emiso->emisor = Auth::id();
		$emiso->save();
		foreach ($recep as $rp) {
			$nuevo = new Receptor;
			$nuevo->mensaje_id = $new->id;
			$nuevo->receptor = $rp->id;
			$nuevo->save();
		}

		$max_size = (int)ini_get('upload_max_filesize') * 10240;
		$files = $request->file;

		if (!is_null($files)) {
			$filesNames = [];
			foreach ($files as $file) {
				$filesNames[] = $file->getClientOriginalName();
				$fileName = Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

				if (Storage::putFileAs('/public/' . $new->id . '/', $file, $fileName)) {
					Archivo::create([
						'mensaje_id' => $new->id,
						'name' => $fileName
					]);
				}
			}
			$new->archivos = implode(" | ", $filesNames);
			$new->save();
		}

		event(new MensajeEvent($new));
		Alert::success('Exito!!', 'Mensaje enviado');
		return redirect('/mensaje/recibidos');
		//return redirect('/mensaje/recibidos')->with('message','Mensaje enviado');
	}

	public function delete($id)
	{
		$mensaje = Mensaje::find($id);
		$yoid = Auth::id();

		if ($yoid == $mensaje->user_id) {
			$emisor = DB::table('emisors')->where('mensaje_id', $id);
			$emisor->delete();

			return back();
		};

		$recept = DB::table('receptors')->where('mensaje_id', $id)->where('receptor', $yoid);
		$recept->delete();

		return back();
	}

	public function destroy($id)
	{
		$mensaje = Mensaje::find($id);
		$mensaje->delete();
		Alert::success('Exito!', 'Ha eliminado un mensaje');
		return redirect('/mensaje/todo');
	}

	public function markMensaje(Request $request)
	{
		auth()->user()->unreadNotifications
			->when($request->input('id'), function ($query) use ($request) {

				return $query->where('id', $request->input('id'));
			})->markAsRead();

		return response()->noContent();
	}
}
