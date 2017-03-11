@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Editar Feedback del Proyecto: "{{ $proyecto[0]->nombre }}"</h1>

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
							<h4><strong>Proveedor: </strong>{{ $proyecto[0]->first_name }} {{ $proyecto[0]->last_name }}</h4>	
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
								 		<th>Dar Feedback</th>
								 		<th>Consultar Feedback</th>
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
								 			<td><center><span class="glyphicon glyphicon-ban-circle"> </span></center></td>
								 		@else
								 			<td><strong>Cerrada</strong></td>
								 			<td><center><strong><a href="{{ action('ProyectosController@getDarFeedback', $e->id_etapa) }}"><span class="glyphicon glyphicon-star-empty"></a></span></strong></center></td>
								 		@endif
								 		<td><center><a href="{{ action('ProyectosController@all_feedbacks', $e->id_etapa) }}"><span class="glyphicon glyphicon-search"></a></span></center></td>
									</tr>
									@endforeach
						  		</tbody>	
							</table>							
						</div>
					</div>
				</fieldset>					
			</form>		
		</div>
	</div>
</div>
@stop
