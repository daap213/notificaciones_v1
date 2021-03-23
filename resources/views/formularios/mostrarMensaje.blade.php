@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			
			@if($mensaje->importancia =="Importante")
			<div class="card-header"><h3> <i class="fas fa-exclamation mr-2"></i>Mensaje {{$mensaje->importancia}} de: {{$emisor->name}}</h3></div> 
			@else <div class="card-header"><h3>Mensaje de: {{$emisor->name}}</h3></div> 
			@endif
			<div class="card-body">
			   <form>
				@csrf
				  <div class="row">
					<div class="col-1">
							<label for="receptor"><h3>Para: </h3></label>
					</div>	
					<div class="col-10">
					 <input type="text" class="form-control" value="{{$mensaje->receptor}}" readonly><br>
					</div>		
				  </div>
				  <div class="row">
					<div class="col-1">
							<label for="tema"><h3>Tema: </h3></label><br>
					</div>	
					<div class="col-10">
					 <input type="text" class="form-control" value="{{$mensaje->tema}}" readonly><br>
					</div>		
				  </div>
				  <label for="tema"><h3>Mensaje: </h3></label><br>
					{!!$mensaje->mensaje!!}<br>
				  <div class="row">
						<div class="col-3">
							<label for="adjunto"><h3>Archivos adjuntos: </h3></label><br>
						</div>	
						<div class="col-8 col-sm-8">
						@forelse($archivos as $archivo)
						<a target="_blank" href="{{route ('show_archivo',$archivo->id)}}" class="btn btn-outline-primary">{{$archivo->name}}<i class="fas fa-external-link-alt"></i></a>
						  
						@empty
							<div class="col-6 col-sm-4"><h4>Ninguno</h4></div>
						@endforelse
						</div>
				  </div><br>
				  <a href="{{route ('responder_mensaje',$mensaje->id)}}" class="btn btn-info">Responder</a>
				  <a href="{{route ('recibido_mensaje')}}" class="btn btn-info">Volver</a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection