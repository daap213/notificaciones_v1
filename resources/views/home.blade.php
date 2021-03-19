@extends('layouts.app')

@section('content')
		
<!--
<div class="container">
   <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><a href="{{route ('recibido_mensaje')}}">Mensajes recibidos</a></h3></div><br>

                <div class="card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <h3><a href="{{route ('mandado_mensaje')}}">Mensajes enviados</a></h3>
                </div><br>
				<div class="card-header">
				  <h3><a href="{{route ('crear_mensaje')}}">Envia un nuevo mensaje</a></h3>
				</div>
            </div>
        </div>
    </div>
</div>-->

@endsection
