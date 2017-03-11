@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Datos de la solicitud del proyecto</h1>

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
			<form action="{{ URL::asset('edit_solicitud') }}" method="POST" class="form-vertical" role="form">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $proyecto[0]->id_proyecto }}">
				<fieldset class="cool-fieldset">
					<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Nombre del proyecto: </small></p>
			  				<input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="nombre" value="{{ $proyecto[0]->nombre }}">
				  		</div>		  			
				  	</div>
				  	<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Inicio: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha Inicio..." name="fecha_inicio" id="fecha_inicio" value="{{ $proyecto[0]->fecha_inicio }}">
				  		</div>
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Estimada Fin: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha estimada Fin..." name="fecha_fin" id="fecha_fin" value="{{ $proyecto[0]->fecha_fin }}">
				  		</div>
				  	</div>
				  	<div class="form-group">
				  		<div class="col-sm-6">
			  				
				  		</div>
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Medio de Pago:</small></p>
			  				<select class="form-control" name="mpago" id="mpago" data-val="mpago">
			  					<option value="" selected disabled>Por favor, seleccione</option>
			  					@foreach ($mpagos as $m)
			  						@if ($proyecto[0]->id_mpago == $m->id_mpago)
		                          		<option value="{{ $m->id_mpago }}" selected>{{ $m->mpago }}</option>
		                          	@else
		                          		<option value="{{ $m->id_mpago }}">{{ $m->mpago }}</option>
		                          	@endif
		                        @endforeach
			  				</select>
				  		</div>
				  	</div>
			  		<div class="form-group">					
						<div class="col-sm-12">
							<br/>
							<input type="submit" value="Actualizar y continuar" class="btn btn-success form-control">
						</div>
					</div>
				</fieldset>					

			</form>

		</div>

	</div>

</div>

@stop