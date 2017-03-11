@extends ('layout')

@section ('content')
<div class="container">
	<div class="row text-center">
	<h3>Feedbacks</h3>
		@if(isset($error))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $error }}
              </ul>
            </div>
        @endif
        @if(empty($feedbacks))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                "¡No existen registros de Feedback cargados!"
              </ul>
            </div>
        @endif
		<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Puntaje del Feedback</th>
			  		<th>Fecha</th>
			  		<th>Descripcion</th>
				</tr>
			</thead>
	  		<tbody>
	  			@foreach($feedbacks as $f)
				<tr>
					<td>{{ $f->feedback }}</td>
					<td>{{ $f->fecha }}</td>
					<td>{{ $f->descripcion }}</td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
	</div>
</div>	
@stop
