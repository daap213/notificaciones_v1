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

class ResponderController extends Controller
{
	public function responder($id)
	{
		$usuarios = User::usuariosAsignar();
		$mensajePre = Mensaje::find($id);
		$archivos = Archivo::where('mensaje_id', $id)->get();
		$respuestaA = User::where('id', '=', $mensajePre->user_id)->get();

		return view('formularios.ResponderMensajes', compact('usuarios', 'respuestaA'), compact('mensajePre', 'archivos'));
	}

	public function storeR(Request $request, $id)
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
		$new->RespondidoA = $id;

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
		};

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
	}
}
