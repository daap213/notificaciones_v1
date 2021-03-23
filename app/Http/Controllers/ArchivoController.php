<?php

namespace App\Http\Controllers;

use App\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
		$archivo = Archivo::find($id);
		
        return redirect('/storage'.'/'.$archivo->mensaje_id.'/'.$archivo->name);
    }

    public function edit(Archivo $archivo)
    {
        //
    }


    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    public function destroy(Archivo $archivo)
    {
        //
    }
}
