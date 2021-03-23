@extends('layouts.app')

@section('content')
<section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">
								<div class="card-header"><h2>{{ __('Mensajes recibidos') }}</h2></div>
								</a>
								<a class="nav-item nav-link" href="{{route ('mandado_mensaje')}}" role="tab"  aria-selected="false">
								<div class="card-header"><h2>{{ __('Mensajes enviados') }}</h2></div>
								</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
								<div class="card-header"><h2>{{ __('Enviar nuevo mensaje') }}</h2></div>
								</a>
                            </div>

                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
									<thead class = "thead-light">
									  <tr>
										<th>Emisor</th>
										<th>Tema</th>
										<th>Importancia</th>
										<th>Adjuntos</th>
										<th colspan="2">Accion</th>
									  </tr>
									</thead>
									<tbody>
									@foreach($mensajes as $m)
										@foreach($usuarios->where('id','=',$m->user_id) as $use)
									  <tr>
										<td width="20%">
										<input type="text" class="form-control" value="{{$use->name}}" readonly></input>
										</td>
										<td width="25%">
										<input type="text" class="form-control" value="{{$m->tema}}" readonly></input>
										</td>
										<td width="15%">
										<input type="text" class="form-control" value="{{$m->importancia}}" readonly></input>										
										</td>
										<td width="20%">
										@if($m->archivos == NULL)
										<input type="text" class="form-control" value="Mensaje sin adjunto" readonly></input>	
										@else
										<input type="text" class="form-control" value="{{$m->archivos}}" readonly></input>	
										@endif																			
										</td>										
										<td width="12%"><a href="{{route('leido',$m->id)}}" class="btn btn-info">Ver mensaje</a></td>
										<td width="8%">
											<form action="{{route('eliminar_mensaje',$m->id)}}" method="post">
												<input name="_method" type="hidden" value="DELETE">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="btn btn-danger">Eliminar</button>
											</form>
										</td>
									  </tr>
									  @endforeach
									@endforeach
									</tbody>
								  </table>
								{{$mensajes->links()}}
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
								<div class="container">
									<div class="row justify-content-center">
										 <div class="card col-11">									
										 @if(!empty($errors->all()))
												<div class="notification is-danger">
													<div class="card-header"><h2>Por favor, valida los siguientes errores:</h2></div>
													<ul>
														@foreach ($errors->all() as $mensaje)
															<li>
															 <p style="color:red">{{$mensaje}}</p>
															 </li>
														@endforeach
													</ul>
												</div>
											@endif
											<div class="card-header"><h2>Enviar mensaje</h2></div>
											<div class="card-body">
											   <form method="post" onsubmit="return validacion()" action={{route('store_mensaje')}} enctype="multipart/form-data">
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
													<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="mensaje" placeholder="Mensaje"></textarea>
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
												</form>

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
