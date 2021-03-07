@extends('layouts.app')

@section('content')
<div class="container">
  <!--<h3><a href="{{route ('crear_mensaje')}}" data-toggle="modal" data-target="#agregar_mensaje">Envia un nuevo mensaje</a></h3>-->
  <h3><a href="{{route ('crear_mensaje')}}">Envia un nuevo mensaje</a></h3>
   <br><div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Manda y mira tus mensajes') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Revisa los mensajes enviados:') }}
                </div>
            </div>
        </div>
    </div><br>
  <table class="table">
    <thead class = "thead-light">
      <tr>
        <th>Receptor</th>
        <th>Tema</th>
        <th>Descripcion</th>
		<th colspan="2">Accion</th>
      </tr>
    </thead>
    <tbody>
	@foreach($mensaje as $m)
      <tr>
        <td width="20%"><input type="text" class="form-control" value="{{$m->receptor}}" readonly></td>
        <td><input type="text" class="form-control" value="{{$m->tema}}" readonly></td>
        <td width="40%"><input type="text" class="form-control" value="{{$m->mensaje}}" readonly></td>
		<td width="6%"><a href="">Ver</a></td>
		<td width="8%">
			<form action="{{route('eliminar_mensaje',$m->id)}}" method="post">
				<input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-danger">Eliminar</button>
			</form>
		</td>
      </tr>
	@endforeach
    </tbody>
  </table>
  {{ $mensaje->links() }}
</div>
@endsection
<!--@include('modals.enviar_mensaje')
