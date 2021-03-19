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
							<textarea class="form-control"  rows="3" id="receptor" name="receptor" readonly>
							@foreach ($recep as $rec){{$rec}}
							@endforeach
							</textarea><br>
					</div>		
				  </div>
				  <label for="tema"><h4>Tema: {{$mensaje->tema}}</h4></label><br>
				  <div class="form-group">
					<label for="mensaje"><h4>Mensaje:</h4></label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" placeholder="{{$mensaje->mensaje}}" readonly></textarea><br>
				  </div>
				  <a href="{{route ('responder_mensaje',$mensaje->id)}}" class="btn btn-info">Responder</a>
				  <a href="{{route ('recibido_mensaje')}}" class="btn btn-info">Volver</a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection