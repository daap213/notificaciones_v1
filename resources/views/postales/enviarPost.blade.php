@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="card col-11">
			<div class="card-header">
				<h2>Enviar post</h2>
			</div>
			<div class="card-body">
				<form method="post" onsubmit="return validacion()" action={{route('storePost')}}>
					@csrf
					<div class="input-group-sm">
						<div class="form-group">
							<label for="tema">
								<h5>Tema del post:</h5>
							</label>
							<input class="form-control" type="text" id="tema" name="tema" placeholder="Tema">
						</div>
						<div class="form-group">
							<label for="contenido">
								<h5>Descripcion:</h5>
							</label><br>
							<textarea class="form-control" rows="5" id="contenido" name="contenido" placeholder="Mensaje"></textarea><br>
							<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
						</div>
						<button type="submit" name="submitbtn" value="Enviar" class="btn btn-info">
							<h5>Subir</h5>
						</button>
						<a onclick="history.back()" class="btn btn-info">
							<h5>Cancelar</h5>
						</a>
				</form>
				<script>
					tinymce.init({
						selector: '#contenido',
						plugins: [
							'tinymcespellchecker', 'advlist autolink lists charmap print preview hr anchor pagebreak',
							'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
							'table emoticons template paste help'
						],
						toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
							'bullist numlist outdent indent | print preview | ' +
							'forecolor backcolor emoticons',
						menu: {
							favs: {
								title: 'Mi Favoritas',
								items: 'searchreplace | emoticons'
							}
						},
						menubar: 'favs file edit view insert format tools table help',
						content_css: 'css/content.css',
						spellchecker_select_languages: 'en,es',
						language: 'es'
					});

					function validacion() {
						valor = tinymce.get('contenido').getContent({
							format: 'text'
						});
						if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
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