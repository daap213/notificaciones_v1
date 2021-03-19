@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			<div class="card-header"><h2>Respondiendo mensaje de: {{$respuestaA[0]->name}}</h2></div>
			<div class="card-body">
			   <form method="post" action={{route('store_responder',$mensajePre->id)}}>
				@csrf
				  <div class="row">
					<div class="col-4">
					  <label for="receptor"><h5>Respuesta enviada al correo:</h5></label>
					  <input class="form-control" type="text" id="receptor" name="receptor" value="{{$respuestaA[0]->email}}" readonly>
					</div> 
					<div class="col-4">
					  <label for=""><h5>Tema previo:</h5></label>
					  <input class="form-control" type="text" id="" name="" placeholder="{{$mensajePre->tema}}" readonly>
				    </div>
					<div class="col-4">
					  <label for=""><h5>Importancia previa:</h5></label>
					  <input class="form-control" type="text" id="" name="" placeholder="{{$mensajePre->importancia}}" readonly>
				    </div>
				  </div><br>
				   <div class="form-group">
					<label for=""><h5>Mensaje previo:</h5></label><br>
					<textarea class="form-control" rows="3" id="" name="" value="" placeholder="{{$mensajePre->mensaje}}"readonly></textarea><br>
					<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
				  </div>
				  <div class="form-group">
					  <label for="tema"><h5>Tema de la respuesta:</h5></label>
					  <input class="form-control" type="text" id="tema" name="tema" placeholder="Tema">
				  </div>
				  <div class="form-group">
					<label for="mensaje"><h5>Descripcion:</h5></label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="mensaje" placeholder="Mensaje"required></textarea><br>
					<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
				  </div>
				  <div class="form-group">
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" id="importancia" name="importancia">
					  <label class="form-check-label" for="importancia">
						<h5>¿Desea marcar el mensaje como importante?</h5>
					  </label>
					</div>
				  </div>
				  <button type="submit" value="Enviar" class="btn btn-info"><h5>Enviar</h5></button>
				  <a onclick="history.back()" class="btn btn-info"><h5>Cancelar</h5></a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection