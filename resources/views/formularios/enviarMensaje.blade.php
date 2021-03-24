@extends('layouts.app')
@section('content')
<section id="tabs" class="project-tab">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link" href="{{route ('recibido_mensaje')}}">
							<div class="card-header">
								<h2>{{ __('Mensajes recibidos') }}</h2>
							</div>
						</a>
						<a class="nav-item nav-link" href="{{route ('mandado_mensaje')}}">
							<div class="card-header">
								<h2>{{ __('Mensajes enviados') }}</h2>
							</div>
						</a>
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">
							<div class="card-header">
								<h2>{{ __('Enviar nuevo mensaje') }}</h2>
							</div>
						</a>
					</div>

				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<div class="container">
							<div class="row justify-content-center">
								<div class="card col-11">
									@if(!empty($errors->all()))
									<div class="notification is-danger">
										<div class="card-header">
											<h3>Por favor, valida los siguientes errores:</h3>
										</div>
										<ul>
											@foreach ($errors->all() as $mensaje)
											<li>
												<p style="color:red">{{$mensaje}}</p>
											</li>
											@endforeach
										</ul>
									</div>
									@endif
									<p style="color:red" id="demo"></p>
									<div class="card-header">
										<h2>Enviar mensaje</h2>
									</div>
									<div class="card-body">
										<form method="post" onsubmit="return validacion()" action={{route('store_mensaje')}} enctype="multipart/form-data">
											@csrf
											<div class="input-group-sm">
												<label for="receptor">
													<h5>¿A quién deseas enviar un mensaje?</h5>
												</label>
												<input type="email" multiple name="receptor" id="receptor" list="drawfemails" required size="60" value="{{old('receptor')}}">
												<datalist id="drawfemails">
													@foreach ($usuarios as $rt)
													<option value="{{$rt->email}}"></option>
													@endforeach
												</datalist>
											</div><br>
											<div class="form-group">
												<label for="tema">
													<h5>Tema del mensaje:</h5>
												</label>
												<input class="form-control" type="text" id="tema" name="tema" value="{{old('tema')}}" placeholder="Tema">
											</div>
											<div class="form-group">
												<label for="mensaje">
													<h5>Descripcion:</h5>
												</label><br>
												<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="{{old('mensaje')}}" placeholder="Mensaje"></textarea><br>
											</div>
											<div class="form-group">
												<label for="file">
													<h5>Adjuntar archivos [PDF,DOC,DOCX,XLSX.PPT,PPXT,JPG,JPEG,PNG,RAR,ZIP]:</h5>
												</label>
												<input class="form-control" accept=".png,.jpg,.jpeg,.gif,.doc,.docx,.ppt,.ppxt,.pdf,.xlsx,.rar,.zip" type="file" id="file" name="file[]" multiple>
											</div><br>
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="importancia" name="importancia">
													<label class="form-check-label" for="importancia">
														<h5>¿Desea marcar el mensaje como importante?</h5>
													</label>
												</div>
											</div>
											<button type="submit" name="submitbtn" value="Enviar" class="btn btn-info">
												<h5>Enviar</h5>
											</button>
										</form>
										<script>
											tinymce.init({
												selector: '#mensaje',
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
												valor = tinymce.get('mensaje').getContent({
													format: 'text'
												});

												if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
													document.getElementById("demo").innerHTML = "Manda un mensaje";

													return false;
												}


											}
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection