@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Asignando Recursos al Proyecto</h1>

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
			<form action="{{ URL::asset('continuar_recurso') }}" method="POST" class="form-vertical" role="form">
				<fieldset class="cool-fieldset">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $id }}">
					<div class="form-group">
						<div class="col-sm-12">
							<p class="help-block margin-bottom-cero"><small>Recurso:</small></p>
							<select class="form-control" name="recurso" id="recurso" data-val="recurso">
								<option value="" selected disabled>Por favor, seleccione</option>
								@foreach ($recursos as $r)
				              		<option value="{{ $r->id_recurso }}">{{ $r->nombre }}</option>
				            	@endforeach
							</select>
				  		</div>
					</div>
					<div class="form-group">					
						<div class="col-sm-3 pull-right">
							<input type="button" value="Continuar ->>" class="btn btn-success form-control" onclick="confirmar();">
						</div>
						<div class="col-sm-3 pull-right">
							<input type="submit" value="Asignar" class="btn btn-success form-control">
						</div>
					</div>
				</fieldset>					
			</form>

			<p>_</p><p>Recursos asignados</p>
			<table class="table table-bordered table-hover" style="font-size: 12px;">
			<thead>
				<tr>
			  		<th>Nombre</th>
			  		<th>Remuneración</th>
			 		<th>Edad</th>
			  		<th>Eliminar</th>
				</tr>
			</thead>
	  		<tbody>
	  			@foreach($recasignados as $ra)
				<tr>
					<td>{{ $ra->nombre }}</td>
					<td>{{ $ra->remuneracion }}</td>
			 		<td>{{ $ra->edad }}</td>
					<td><a href="" <span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				@endforeach
	  		</tbody>	
		</table>
		</div>
	</div>
</div>
<script type="text/javascript">
    function confirmar() {
        var id = document.getElementById("id_proyecto");        
        window.location = ("confirma_proyecto" + (id.value));
        
    }
</script>
@stop
