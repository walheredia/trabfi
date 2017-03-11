@extends('layout')

@section('content')
	@if(Session::has('error'))
    		<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>¡Error de acceso!</strong> El usuario "{{ Session::get('error') }}" no tiene suficientes privilegios para realizar realizar la acción que desea.
			</div>
	@endif
    <div class="jumbotron">
    	<div class="container">	
		  <h1 align="Center">TFI 2017 - Tecnología - Byte Transfer</h1>
		</div>
    	
	</div>
<div class="container-fluid">
	<fieldset class="cool-fieldset">
		<div class="form-group">
			<div class="col-md-6">
		    	<h4><strong>Información:</strong></h4>
		    	<h5><strong>Docentes:</strong> Alejando Sartorio - Marcelo Vaquero</h5>
		    	<h5><strong>Facultad:</strong> UAI</h5>
		    	<h5><strong>Sede:</strong> Lagos</h5>
		    	<h5><strong>Carrera:</strong> Ing. En Sistemas</h5>
		    	<h5><strong>Alumnos:</strong> Bechio, Josué Emiliano - Heredia, Walter Darío</h5>
		    	<h5><strong>Proyecto:</strong> Byte Transfer, sistema de Administración de Proyectos.</h5>
			</div>
			<div class="col-md-6">
				<center><img class="img-responsive img-rounded" src="{{asset('images/uai.jpg')}}" ></center>
			</div>
		</div>
	</fieldset>
</div>
@stop