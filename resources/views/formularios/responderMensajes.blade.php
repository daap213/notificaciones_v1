@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	     <div class="card col-11">
			<div class="card-header"><h2>Respondiendo mensaje de: {{$respuestaA[0]->name}}</h2></div>
			<div class="card-body">
			   <form method="post" onsubmit="return validacion()" enctype="multipart/form-data" action={{route('store_responder',$mensajePre->id)}}>
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
					<label for=""><h5>Mensaje previo:</h5></label>
					<div class="form-group py-2 px-lg-2 border bg-light">
					{!!$mensajePre->mensaje!!}
				   </div>
				   <div class="row">
						<div class="col-3">
							<label for=""><h3>Archivos adjuntos: </h3></label><br>
						</div>	
						<div class="col-8 col-sm-8">
						@forelse($archivos as $archivo)
						<a target="_blank" href="{{route ('show_archivo',$archivo->id)}}" class="btn btn-outline-primary">{{$archivo->name}}<i class="fas fa-external-link-alt"></i></a>
						  
						@empty
							<div class="col-6 col-sm-4"><h4>Ninguno</h4></div>
						@endforelse
						</div>
				  </div><br><hr>
				  </div>
				 @if(!empty($errors->all()))
					<div class="notification is-danger">
						<div class="card-header"><h3>Por favor, valida los siguientes errores:</h3></div>
							<ul>
								@foreach ($errors->all() as $mensaje)
									<li>
										<p style="color:red">{{$mensaje}}</p>
									</li>
								@endforeach
							</ul>
					</div>
				@endif
				  <div class="form-group">
					  <label for="tema"><h5>Tema de la respuesta:</h5></label>
					  <input class="form-control" type="text" id="tema" name="tema" placeholder="Tema">
				  </div>
				  <div class="form-group">
					<label for="mensaje"><h5>Descripcion:</h5></label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="mensaje" placeholder="Mensaje"></textarea><br>
				  </div>
				  <div class="form-group">
					<label for="file"><h5>Adjuntar archivos [PDF,DOC,DOCX,JPG,GIF,PNG,EXE,RAR,ZIP]:</h5></label>
					<input class="form-control" type="file" accept=".png,.jpg,.jpeg,.gif,.doc,.docx,.pdf,.xlsx,.rar,.zip" id="file" name="file[]" multiple>
				  </div><br>
				  <div class="form-group">
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" id="importancia" name="importancia">
					  <label class="form-check-label" for="importancia">
						<h5>¿Desea marcar el mensaje como importante?</h5>
					  </label>
					</div>
				  </div>
				  <button type="submit" name="submitbtn" value="Enviar" class="btn btn-info"><h5>Enviar</h5></button>
				  <a onclick="history.back()" class="btn btn-info"><h5>Cancelar</h5></a>
				</form>
		     <script>
													tinymce.init({
													  selector: '#mensaje',
													   plugins: [
																  'tinymcespellchecker','advlist autolink lists charmap print preview hr anchor pagebreak',
																  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
																  'table emoticons template paste help'
																],
														toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
														  'bullist numlist outdent indent | print preview | ' +
														  'forecolor backcolor emoticons',
														menu: {
														  favs: {title: 'Mi Favoritas', items: 'searchreplace | emoticons'}
														},
														menubar: 'favs file edit view insert format tools table help',
														content_css: 'css/content.css',
													  spellchecker_select_languages: 'en,es',
													  language: 'es'
													});
													function validacion() {
														    valor = tinymce.get('mensaje').getContent({format: 'text'});
															
															if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
															  alert('[ERROR] No ha escrito ningun mensaje');
															  return false;
															}

													}
		      </script>										
			</div>
		</div>
	</div>
</div>

@endsection