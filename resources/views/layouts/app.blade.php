<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="https://cdn.tiny.cloud/1/t201vdo700re5kofroz4z7gn4xljo747k94jzpbk9a6n4cqy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<style>
		.row {
			margin-left: 0px;
			margin-right: 0px;
		}

		#wrapper {
			padding-left: 100px;
			transition: all .4s ease 0s;
			height: 100%
		}

		#sidebar-wrapper {
			margin-left: 0xp;
			left: 0px;
			width: 175px;
			background: #white;
			position: fixed;
			height: 100%;
			z-index: 10000;
			transition: all .4s ease 0s;
		}

		.sidebar-nav {
			display: block;
			float: left;
			width: 175px;
			list-style: none;
			margin: 0;
			padding: 0;
		}

		#page-content-wrapper {
			padding-left: 0;
			margin-left: 0;
			width: 100%;
			height: auto;
		}

		#wrapper.active {
			padding-left: 175px;
		}

		#wrapper.active #sidebar-wrapper {
			left: 175px;
		}

		#page-content-wrapper {
			width: 100%;
		}

		#sidebar_menu li a,
		.sidebar-nav li a {
			color: #white;
			display: block;
			float: left;
			text-decoration: none;
			width: 200px;
			background: #white;
			border-top: 1px solid #ffffff;
			border-bottom: 1px solid #1A1A1A;
			-webkit-transition: background .5s;
			-moz-transition: background .5s;
			-o-transition: background .5s;
			-ms-transition: background .5s;
			transition: background .5s;
		}

		.sidebar_name {
			padding-top: 100px;
			color: #black;
			opacity: .7;
		}

		.sidebar-nav li {
			line-height: 46px;
			text-indent: 5px;
		}

		.sidebar-nav li a {
			color: #black;
			display: block;
			text-decoration: none;
		}

		.sidebar-nav li a:hover {
			color: #black;
			background-color: #4CAF50 text-decoration: none;
		}

		.sidebar-nav li a:active,
		.sidebar-nav li a:focus {
			background-color: #4CAF50;
			color: white;
		}

		.sidebar-nav>.sidebar-brand {
			height: 65px;
			line-height: 60px;
			font-size: 18px;
		}

		.sidebar-nav>.sidebar-brand a {
			color: #black;
			background-color: #4CAF50
		}

		.sidebar-nav>.sidebar-brand a:hover {
			color: #black;
			background-color: #4CAF50;
		}


		@media (max-width:767px) {
			#wrapper {
				padding-left: 70px;
				transition: all .4s ease 0s;
			}

			#sidebar-wrapper {
				left: 70px;
			}

			#wrapper.active {
				padding-left: 150px;
				background-color: #4CAF50;
				color: white;
			}

			#wrapper.active #sidebar-wrapper {
				left: 150px;
				width: 150px;
				transition: all .4s ease 0s;
			}
		}
	</style>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>


	<div id="app">

		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">

				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->

						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
						@endif
						@else
						<div class="" id="sidebar-wrapper">
							<ul id="sidebar_menu" class="sidebar-nav">
								<h2>
									<li class="sidebar-brand"><a id="menu-toggle" align="center" style="color:Black;">Menu<i class="fas fa-comments mr-1"></i></a></li>
								</h2>
							</ul>
							<ul class="sidebar-nav" id="sidebar">
								<h5>
									<li><a href="{{route ('home')}}" style="color:Black;"><i class="fas fa-home"></i> Home</a></li>
								</h5>
								<h5>
									<li><a href="#" style="color:Black;"><i class="fas fa-portrait"></i></i> Mi perfil</a></li>
								</h5>
								<h5>
									<li><a href="{{route ('recibidoPost')}}" style="color:Black;"><i class="fas fa-mail-bulk"></i> Post</a></li>
								</h5>
								@role('admin')
								<h5>
									<li><a href="{{route ('all_mensaje')}}" style="color:Black;"><i class="fas fa-envelope-square"></i> Mensajes DB</a></li>
								</h5>
								@endrole
								<h5>
									<li><a href="{{route ('recibido_mensaje')}}" style="color:Black;"><i class="fas fa-bell"></i> Notificaciones
											@if(count(auth()->user()->unreadNotifications))
											<span class="badge badge-warning">{{count(auth()->user()->unreadNotifications)}}</span>
											@endif</a></li>
								</h5>

							</ul>
						</div>
						<li class="nav-item dropdown">
							<a class="nav-link" data-toggle="dropdown" href="#">
								<span class="text-muted text-sm">Notificaciones</span>
								<i class="fas fa-bell"></i>
								@if(count(auth()->user()->unreadNotifications))
								<span class="badge badge-warning">{{count(auth()->user()->unreadNotifications)}}</span>
								@endif
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
								<span class="dropdown-header">
									<h4 style="color:Black;">Mensajes no leidos:</h4>
								</span>
								@forelse (auth()->user()->unreadNotifications as $noti)
								<a href="{{route('leido',$noti->id)}}" class="mark-as-read dropdown-item">
									De: {{$noti->data["emisor"]}} <i class="fas fa-envelope mr-2"></i>
									@if($noti->data["importancia"]=="Importante")
									{{$noti->data["importancia"]}} <i class="fas fa-exclamation mr-2"></i>
									@endif
									<br><span class="float-right text-muted text-sm">{{$noti->created_at->diffForHumans()}}</span>
								</a>
								@empty
								<span class="ml-5 pull-right text-muted text-sm">Sin mensajes por leer</span>
								@endforelse
								<hr class="solid">
								<a href="{{route('markAsRead')}}" class="dropdown-item dropdown-footer">Marcar mensajes como leidos</a>
							</div>
						</li>

						<!--<li><a class="nav-link" href="#">Mensajes recibidos <span class="badge badge-primary">1</span></a></li>-->
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }}
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('home') }}">
									{{ __('Home') }}
								</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="py-4">

			<div class="container ">
				@if(session('message'))
				<div class="row mb-2">
					<div class="col-lg-12">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>{{session('message')}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				@endif
			</div>
			@yield('content')
			@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
		</main>
	</div>

</body>

<body>


</body>

</html>