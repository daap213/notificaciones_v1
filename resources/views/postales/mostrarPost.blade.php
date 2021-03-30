@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="card col-11">

			<div class="card-header">
				<h3>Post de: {{$emisor->name}}</h3>
			</div>
			<div class="card-body">
				<form>
					@csrf
					<label for="tema">
						<h4>Tema: {{$post->tema}}</h4>
					</label><br>
					<div class="form-group">
						<label for="mensaje">
							<h4>Contenido del Post:</h4>
						</label><br>
						<div class="py-2 px-lg-2 border bg-light">
							{!!$post->contenido!!}
						</div>
					</div>
					<a href="{{route ('recibidoPost')}}" class="btn btn-info">Volver</a>
					@can('delete post')
					<a href="{{route ('destroyPost',$post->id)}}" class="btn btn-danger">Eliminar post</a>
					@endcan
				</form>
			</div>
		</div>
	</div>
</div>

@endsection