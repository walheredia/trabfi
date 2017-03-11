<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SAP 2016 - Tecnología</title>
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/vendor/jquery-ui-1.10.3.custom.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/escuela.css') }}">
	<style>
		table tr {
			text-align: left;
			margin: 10px;
		}
	</style>	

</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	      		<span class="sr-only">Toggle navigation</span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	    	</button>
	    	<a class="navbar-brand" href="{{ URL::asset('') }}">Inicio</a>
	  	</div>
	  	@if (!Auth::check())
	  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  			<ul class="nav navbar-nav navbar-right">
		  		 	<li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Opciones</strong> <b class="caret"></b></a>
				        <ul class="dropdown-menu">
					        <li><a href="{{ URL::asset('login') }}">Ingresar</a></li>
				        </ul>
			      	</li>
			    </ul>
	  		</div>
	  	@else
	  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  		 <ul class="nav navbar-nav">
		      	@if (Auth::user()->tipo_usuario == '2' or Auth::user()->tipo_usuario == '3')
		      	<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Proyectos <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			  		 	@if (Auth::user()->tipo_usuario == '2')
			  		 	<li><a href="{{ URL::asset('register_proyecto') }}">Registrar un nuevo Proyecto</a></li>
			  		 	@endif
			  		 	<li><a href="{{ URL::asset('lista_proyectos') }}">Listado de Proyectos</a></li>
			  		 	<li><a href="{{ URL::asset('solicitudes_proyectos') }}">Solicitudes de Proyectos</a></li>
			        </ul>
		      	</li>
		      	@endif
		      	@if (Auth::user()->tipo_usuario == '2')
		      	<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Recursos <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			  		 	@if (Auth::user()->tipo_usuario == '2')
			  		 	<li><a href="{{ URL::asset('register_recurso') }}">Registrar un nuevo Recurso</a></li>
			  		 	<li><a href="{{ URL::asset('lista_recursos') }}">Listado de Recursos</a></li>
			  		 	@endif
			        </ul>
		      	</li>
		      	@endif
	  		 	<!--<li><a href="{{ URL::asset('') }}">Inicio</a></li>-->
	  		 	<!--<li><a href="{{ URL::asset('login') }}">Ingresar</a></li>
	  		 	<li><a href="{{ URL::asset('register') }}">Registrar un nuevo usuario</a></li>
	  		 	<li><a href="{{ URL::asset('lista_usuarios') }}">Listado de usuarios</a></li>-->
	  		 </ul>
	  		 <ul class="nav navbar-nav navbar-right">
	  		 	<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Opciones de Usuario <strong>{{ Auth::user()->username; }}</strong> <b class="caret"></b></a>
			        <ul class="dropdown-menu">
				        <li><a href="{{ URL::asset('login') }}">Ingresar</a></li>
			  		 	@if (Auth::user()->tipo_usuario == '1' or Auth::user()->tipo_usuario == '2')
			  		 	<li><a href="{{ URL::asset('register') }}">Registrar un nuevo usuario</a></li>
			  		 	<li><a href="{{ URL::asset('lista_usuarios') }}">Listado de usuarios</a></li>
			  		 	@endif
			  		 	<li role="separator" class="divider"></li>
			        	<li><a href="{{ action('AuthController@logOut') }}">Cerrar Sesión</a></li>
			        </ul>
		      	</li>
		    </ul>
	  	</div>
	  	@endif
	  	
	</nav>

	@yield('content')
	
	<script src="{{ URL::asset('js/jquery-2.0.3.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
	<script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>