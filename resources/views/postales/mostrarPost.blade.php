@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			
			<div class="card-header"><h3>Post de: {{$emisor->name}}</h3></div> 
			<div class="card-body">
			   <form>
				@csrf

				  <label for="tema"><h4>Tema: {{$post->tema}}</h4></label><br>
				  <div class="form-group">
					<label for="mensaje"><h4>Contenido del Post:</h4></label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" placeholder="{{$post->contenido}}" readonly></textarea><br>
				  </div>
				  <a onclick="history.back()" class="btn btn-info">Volver</a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection