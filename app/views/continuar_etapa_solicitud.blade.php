@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Creando etapas del Proyecto</h1>

		<div class="col-md-10 col-md-offset-1 text-left">
			@if ($errors->any())
			    <div class="alert alert-danger">
			      <button type="button" class="close" data-dismiss="alert">&times;</button>
			      <strong>Por favor corrige los siguentes errores:</strong>
			      <ul>
			      @foreach ($errors->all() as $error)
			        <li>{{ $error }}</li>
			      @endforeach
			      </ul>
			    </div>
			@endif
			<form action="{{ URL::asset('continuar_etapa_solicitud') }}" method="POST" class="form-vertical" role="form">
				<fieldset class="cool-fieldset">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $id }}">
					<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Nombre etapa: </small></p>
			  				<input type="text" class="form-control" placeholder="Nombre etapa..." name="nombre" id="nombre" value="{{ Input::old('nombre') }}">
				  		</div>
				  	</div>
				  	<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Inicio: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha Inicio..." name="fecha_inicio" id="fecha_inicio">
				  		</div>
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha estimada de finalización: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha estimada Fin..." name="fecha_fin" id="fecha_fin">
				  		</div>
				  	</div>
			  		<div class="form-group">					
						<div class="col-sm-3 pull-right">
							<input type="button" value="Continuar ->>" class="btn btn-success form-control" onclick="guardar();">
						</div>
						<div class="col-sm-3 pull-right">
							<input type="submit" value="Guardar" class="btn btn-success form-control">
						</div>
					</div>
				</fieldset>					
			</form>
			<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Nombre Etapa</th>
			  		<th>Fecha Inicio</th>
			 		<th>Fecha fin</th>
			  		<th>Editar</th>
			  		<th>Eliminar</th>
				</tr>
			</thead>
	  		<tbody>
	  			@foreach($etapas as $e)
				<tr>
					<td>{{ $e->nombre }}</td>
					<td>{{ $e->fecha_ini }}</td>
			 		<td>{{ $e->fecha_fin }}</td>
			 		<td><a href=""><span class="glyphicon glyphicon-pencil"></a></span></td>
					<td><a href="" <span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
		</div>
	</div>
</div>
<script type="text/javascript">
    function guardar() {
        var id = document.getElementById("id_proyecto");        
        window.location = ("continuar_recurso_solicitud" + (id.value));
        
    }
</script>
@stop