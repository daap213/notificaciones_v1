@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			<div class="card-header"><h2>Enviar nuevo mensaje</h2></div>
			<div class="card-body">
			   <form method="post" action={{route('store_mensaje')}}>
				@csrf
				  <label for="receptor">Receptor:</label><br>
				  <div  class="form-group">
					  <select name="receptor" class="form-group" required>
						<option value="" >Seleccione al usuario</option>
						@foreach ($usuarios as $rt)
							<option value="{{$rt->name}}">{{$rt->name}}</option>
						@endforeach
					  </select>
				  </div>
				 <!-- <input class="form-control" type="text" id="receptor" name="receptor" value="">-->
				  <label for="tema">Tema:</label><br>
				  <input class="form-control" type="text" id="tema" name="tema" placeholder="tema"><br>
				  <div class="form-group">
					<label for="mensaje">Descripcion:</label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="mensaje" placeholder="mensaje"></textarea><br>
					<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
				  </div>
				  <button type="submit" value="Enviar" class="btn btn-info">Guardar</button>
				  <a href="{{route ('home')}}" class="btn btn-info">Volver/Cancelar</a>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection