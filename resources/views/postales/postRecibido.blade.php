@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card-header"><h2>{{ __('Todos los Posts') }}</h2></div><br>
	<div class="container">
	  <h3><a href="{{route ('enviarPost')}}">Redactar un Post</a></h3>
	</div><br>
  <table class="table">
    <thead class = "thead-light">
      <tr>
        <th>Emisor</th>
        <th>Tema</th>
        <th>Contenido</th>
		<th colspan="1">Accion</th>
      </tr>
    </thead>
    <tbody>
	@foreach($post as $m)
		@foreach($emisor->where('id','=',$m->user_id) as $use)
      <tr>
        <td width="20%"><input type="text" class="form-control" value="{{$use->name}}" readonly></td>
        <td><input type="text" class="form-control" value="{{$m->tema}}" readonly></td>
        <td width="50%"><input type="text" class="form-control" value="{{$m->contenido}}" readonly></td>
		<td width="6%"><a href="{{route('showPost',$m->id)}}">Ver</a></td>
      </tr>
	  @endforeach
	@endforeach
    </tbody>
  </table>
  {{ $post->links() }}
</div>

@endsection