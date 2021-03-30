@extends('layouts.app')

@section('content')
<section id="tabs" class="project-tab">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">
							<div class="card-header">
								<h2>{{ __('Mensajes recibidos') }}</h2>
							</div>
						</a>
						@can('create message')
						<a class="nav-item nav-link" href="{{route ('mandado_mensaje')}}">
							<div class="card-header">
								<h2>{{ __('Mensajes enviados') }}</h2>
							</div>
						</a>
						<a class="nav-item nav-link" href="{{route ('crear_mensaje')}}">
							<div class="card-header">
								<h2>{{ __('Enviar nuevo mensaje') }}</h2>
							</div>
						</a>
						@endcan
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<table class="table" cellspacing="0">
							<thead class="thead-light">
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
				</div>
			</div>
		</div>
	</div>
</section>
@endsection