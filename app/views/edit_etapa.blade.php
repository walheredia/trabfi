@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Editar etapas del Proyecto: "{{ $proyecto[0]->nombre }}"</h1>

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
			<form action="{{ URL::asset('edit_etapa') }}" method="POST" class="form-vertical" role="form">
				<fieldset class="cool-fieldset">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $proyecto[0]->id_proyecto }}">
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Nombre del Proyecto: </strong>{{ $proyecto[0]->nombre }}</h4>	
				  		</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Cliente: </strong>{{ $proyecto[0]->first_name }} {{ $proyecto[0]->last_name }}</h4>	
				  		</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Cantidad de etapas del proyecto:</strong> {{ $cantetapas }}</h4>	
				  		</div>
					</div>
				</fieldset>
				<fieldset class="cool-fieldset">
				<hr/>
					<div class="form-group">
						<div class="col-sm-12">
							<p>Etapas del Proyecto</p>
							<table class="table table-bordered table-hover" style="font-size: 12px;">
								<thead>
									<tr>
								  		<th>Nombre</th>
								  		<th>Fecha Inicio</th>
								 		<th>Fecha Fin</th>
								 		<th>Estado</th>
								 		<th>Cambiar Estado</th>
								 		<th>Consultar Feedback</th>
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
								 		@if($e->cerrada == '0')
								 			<td><strong>Abierta</strong></td>
								 			<td><center><a href="{{ action('ProyectosController@cambiarEstadoEtapa', $e->id_etapa) }}"><span class="glyphicon glyphicon-remove-circle"></a></span></center></td>
								 		@else
								 			<td><strong>Cerrada</strong></td>
								 			<td><center><a href="{{ action('ProyectosController@cambiarEstadoEtapa', $e->id_etapa) }}"><span class="glyphicon glyphicon-ok-circle"></a></span></center></td>
								 		@endif
								 		<td><center><a href="{{ action('ProyectosController@all_feedbacks', $e->id_etapa) }}"><span class="glyphicon glyphicon-search"></a></span></center></td>
								 		<td><a href=""><span class="glyphicon glyphicon-pencil"></a></span></td>
										<td><a href=""><span class="glyphicon glyphicon-remove"></span></a></td>
									</tr>
									@endforeach
						  		</tbody>	
							</table>							
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
						<hr/>
						<p>Agregar Etapa Nueva</p>
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
						<div class="col-sm-12">
							<br/>
							<input type="submit" value="Agregar" class="btn btn-success form-control">
						</div>
					</div>
					</div>
				</fieldset>					
			</form>		
		</div>
	</div>
</div>
@stop
