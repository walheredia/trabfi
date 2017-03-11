@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Vista del Proyecto: "{{ $proyecto[0]->nombre }}"</h1>

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
			<form action="{{ URL::asset('confirma_proyecto') }}" method="POST" class="form-vertical" role="form">
				<fieldset class="cool-fieldset">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $id }}">
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
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Cantidad de recursos asignados:</strong> {{ $cantrecasignados }}</h4>	
				  		</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Costo:</strong></h4>	
				  		</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<h4><strong>Método de pago: </strong>{{ $proyecto[0]->mpago }}</h4>	
				  		</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3 pull-right">
							<input type="submit" value="Notificar Cliente" class="btn btn-success form-control">
						</div>
					</div>
				</fieldset>
				<fieldset class="cool-fieldset">
				<hr/>
					<div class="form-group">
						<div class="col-sm-6">
							<p>Etapas del Proyecto</p>
							<table class="table table-bordered table-hover" style="font-size: 12px;">
								<thead>
									<tr>
								  		<th>Nombre</th>
								  		<th>Fecha Inicio</th>
								 		<th>Fecha Fin</th>
									</tr>
								</thead>
						  		<tbody>
						  			@foreach($etapas as $e)
									<tr>
										<td>{{ $e->nombre }}</td>
										<td>{{ $e->fecha_ini }}</td>
								 		<td>{{ $e->fecha_fin }}</td>
									</tr>
									@endforeach
						  		</tbody>	
							</table>							
						</div>
						<div class="col-sm-6">
							<p>Recursos asignados</p>
							<table class="table table-bordered table-hover" style="font-size: 12px;">
								<thead>
									<tr>
								  		<th>Nombre</th>
								  		<th>Remuneración</th>
								 		<th>Edad</th>
								 		<th>Actividad</th>
									</tr>
								</thead>
						  		<tbody>
						  			@foreach($recasignados as $ra)
									<tr>
										<td>{{ $ra->nombre }}</td>
										<td>{{ $ra->remuneracion }}</td>
								 		<td>{{ $ra->edad }}</td>
										<td>{{ $ra->actividad }}</td>
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
