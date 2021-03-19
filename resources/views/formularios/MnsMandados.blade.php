@extends('layouts.app')
@section('content')
<section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
								<a class="nav-item nav-link" href="{{route ('recibido_mensaje')}}" role="tab"  aria-selected="false">
								<div class="card-header"><h2>{{ __('Mensajes recibidos') }}</h2></div>
								</a>
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">
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
										<th>Receptor</th>
										<th>Tema</th>
										<th>Descripcion</th>
										<th colspan="2">Accion</th>
									  </tr>
									</thead>
									<tbody>
									@foreach($mensaje as $m)
									
									  <tr>
										<td width="20%"><input type="text" class="form-control" value="{{$m->receptor}}" readonly></td>	
										<td><input type="text" class="form-control" value="{{$m->tema}}" readonly></td>
										<td width="40%"><input type="text" class="form-control" value="{{$m->mensaje}}" readonly></td>
										<td width="6%"><a href="{{route('show_mensaje',$m->id),''}}">Ver</a></td>
										<td width="8%">
											<form action="{{route('eliminar_mensaje',$m->id)}}" method="post">
												<input name="_method" type="hidden" value="DELETE">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="btn btn-danger">Eliminar</button>
											</form>
										</td>
									  </tr>
									@endforeach
									</tbody>
								  </table>
								  {{ $mensaje->links() }}
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

 
