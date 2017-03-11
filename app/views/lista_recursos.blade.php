@extends ('layout')

@section ('content')
<div class="container">
	<div class="row text-center">
	<h3>Mis recursos</h3>
		@if(Session::has('error'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('error') }}
              </ul>
            </div>
        @endif
		<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Nombre</th>
			  		<th>Fecha Ingreso</th>
			  		<th>Edad</th>
			  		<th>Sexo</th>
			  		<th>Seniority</th>
			  		<th>Remuneración</th>
			  		<th>Actividad</th>
			  		<th>Estado</th>
			 		<th>Editar</th>
			  		<th>Eliminar</th>
				</tr>
			</thead>
	  		<tbody>
	  			@foreach($recursos as $r)
				<tr>
					<td>{{ $r->nombre }}</td>
					<td>{{ $r->fecha_ingreso }}</td>
					<td>{{ $r->edad }}</td>
					<td>{{ $r->sexo }}</td>
					<td>{{ $r->seniority }}</td>
					<td>{{ $r->remuneracion }}</td>
					<td>{{ $r->actividad }}</td>
					<td>{{ $r->estado }}</td>
			 		<td><a href=""><span class="glyphicon glyphicon-pencil"></a></span></td>
					<td><a href="" <span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
	</div>
</div>	
@stop
