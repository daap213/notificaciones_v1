@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			<div class="card-header"><h2>Enviar post</h2></div>
			<div class="card-body">
			   <form method="post" action={{route('storePost')}}>
				@csrf
				  <div class="input-group-sm">
				  <div class="form-group">
					  <label for="tema"><h5>Tema del post:</h5></label>
					  <input class="form-control" type="text" id="tema" name="tema" placeholder="Tema">
				  </div>
				  <div class="form-group">
					<label for="contenido"><h5>Descripcion:</h5></label><br>
					<textarea class="form-control" rows="5" id="contenido" name="contenido" placeholder="Mensaje"required></textarea><br>
					<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
				  </div>
				  <button type="submit" value="Enviar" class="btn btn-info"><h5>Enviar</h5></button>
				  <a onclick="history.back()" class="btn btn-info"><h5>Cancelar</h5></a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection