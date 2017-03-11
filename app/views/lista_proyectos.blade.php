@extends ('layout')

@section ('content')
<div class="container">
	<div class="row text-center">
	<h3>Mis proyectos</h3>
		@if(isset($error))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $error }}
              </ul>
            </div>
        @endif
		<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Nombre</th>
			  		<th>Fecha Inicio</th>
			  		<th>Fecha Fin</th>
			  		<th>Cliente</th>
			  		<th>Medio de Pago</th>
			  		<th>Cantidad de etapas</th>
			  		<th>Cantidad de recursos asignados</th>
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
			 		<td><a href=""><span class="glyphicon glyphicon-pencil"></a></span></td>
					<td><a href="" <span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
	</div>
</div>	
@stop
