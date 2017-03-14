@extends ('layout')

@section ('content')
<div class="container">
	<div class="row text-center">
	<h3>Mis Solicitudes</h3>
		@if(isset($error))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $error }}
              </ul>
            </div>
        @endif
        <form action="{{ URL::asset('solicitudes_proyectos') }}" method="POST" class="form-vertical" role="form">
 		<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Nombre</th>
			  		<th>Fecha Inicio</th>
			  		<th>Fecha Fin</th>
			  		<th>Cliente</th>
			  		<th>Medio de Pago</th>
			  		<th>C/ de etapas</th>
			  		<th>C/recursos asignados</th>
			  		<th>Costo calculado</th>
			  		<th>Costo definido</th>
			 		<th>Editar</th>
			  		<th>Eliminar</th>
				</tr>
			</thead>
	  		<tbody>
	  			@foreach($proyectos as $p)
				<tr>
					<td>{{ $p->nombre }}</td>
					<td>{{ $p->fecha_inicio }}</td>
					<td>{{ $p->fecha_fin }}</td>
					<td>{{ $p->first_name }} {{ $p->last_name }}</td>
					<td>{{ $p->mpago }}</td>
					<td>{{ $p->cantetapas }} {{ " - " }}<a href="{{ action('ProyectosController@getEditEtapa', $p->id_proyecto) }}"><span class="glyphicon glyphicon-search"></a></span></td>
					<td>{{ $p->cantrecasignados }}</td>
					<td>{{ $p->costo_tot }}</td>
					<td style="color: green;"><strong>{{ $p->costo }}</strong></td>
			 		<td><a href="{{ action('ProyectosController@getEditSolicitud', $p->id_proyecto) }}"><span class="glyphicon glyphicon-pencil"></a></span></td>
					<td><a href="{{ action('ProyectosController@RemoveSolicitud', $p->id_proyecto) }}" <span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
		<?php if(Auth::user()->tipo_usuario == 3) : ?>
			<div class="col-sm-2 pull-right">
				<br/>
				<input type="submit" value="Registrar Solicitud" class="btn btn-success form-control">
			</div>
		<?php endif; ?>        	
        </form>

		
	</div>
</div>


@stop
