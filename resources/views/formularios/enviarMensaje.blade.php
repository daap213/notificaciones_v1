@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			<div class="card-header"><h2>Enviar mensaje</h2></div>
			<div class="card-body">
			   <form method="post" action={{route('store_mensaje')}}>
				@csrf
				  <div class="input-group-sm">
					  <label for="receptor"><h5>¿A quién deseas enviar un mensaje?</h5></label>
						<input type="email" multiple name="receptor" id="receptor" list="drawfemails" required size="60">
						<datalist id="drawfemails">
							@foreach ($usuarios as $rt)
								<option  value="{{$rt->email}}"></option>
							@endforeach
						</datalist>
				  </div><br>
				  <div class="form-group">
					  <label for="tema"><h5>Tema del mensaje:</h5></label>
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