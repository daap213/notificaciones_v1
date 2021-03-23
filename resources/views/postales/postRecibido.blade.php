@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card-header"><h2>{{ __('Todos los Posts') }}</h2></div><br>
	<div class="container">
	  <h3><a href="{{route ('enviarPost')}}">Redactar un Post</a></h3>
	</div><br>

	@foreach($post as $m)
		@foreach($emisor->where('id','=',$m->user_id) as $use)
		<div class="container">
			<div class="row justify-content-center">
				 <div class="card col-11">
					
					<div class="card-header"><h3>Post de: {{$use->name}}</h3></div> 
					<div class="card-body">

						  <label for="tema"><h4>Tema: {{$m->tema}}</h4></label><br>
						  <div class="form-group">
							<label for="mensaje"><h4>Contenido del Post:</h4></label><br>
							<div  class="py-2 px-lg-2 border bg-light">
										{!!$m->contenido!!}
							</div>		
						  </div>
						  <a href="{{route('showPost',$m->id)}}" class="btn btn-info">Ver</a>
					</div>
				</div>
			</div>
		</div><br>
	  @endforeach
	@endforeach
  {{ $post->links() }}
</div>

@endsection