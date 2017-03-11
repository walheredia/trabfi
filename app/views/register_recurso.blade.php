@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Datos del Recurso</h1>

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
			<form action="{{ URL::asset('register_recurso') }}" method="POST" class="form-vertical" role="form">

				<fieldset class="cool-fieldset">
					<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Nombre Completo: </small></p>
			  				<input type="text" class="form-control" placeholder="Nombre completo..." name="nombre" id="nombre" value="{{ Input::old('nombre') }}">
				  		</div>

						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Ingreso: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha Ingreso..." name="fecha_ingreso" id="fecha_ingreso">
				  		</div>		  			
				  	</div>
				  	<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Edad: </small></p>
			  				<input type="text" class="form-control" placeholder="Edad..." name="edad" id="edad" value="{{ Input::old('edad') }}">
				  		</div>

						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Sexo: </small></p>
			  				<label class="radio-inline"><input type="radio" checked="checked" name="sexo" id="masculino" value="Masculino">Masculino</label>
							<label class="radio-inline"><input type="radio" name="sexo" id="femenino" value="Femenino">Femenino</label>
							<br/><br/>
				  		</div>		  			
				  	</div>

				  	<div class="form-group">
				  		<div class="col-sm-3">
			  				<p class="help-block margin-bottom-cero"><small>Señority:</small></p>
			  				<select class="form-control" name="seniority" id="seniority" data-val="seniority">
			  					<option value="" selected disabled>Por favor, seleccione</option>
			  					@foreach ($seniorities as $s)
		                          <option value="{{ $s->id_seniority }}">{{ $s->seniority }}</option>
		                        @endforeach
			  				</select>
				  		</div>
				  		<div class="col-sm-3">
			  				<p class="help-block margin-bottom-cero"><small>Remuneración:</small></p>
			  				<input type="text" class="form-control" placeholder="Remuneración" name="remuneracion" id="remuneracion" value="{{ Input::old('remuneracion') }}">
				  		</div>
						<div class="col-sm-5">
			  				<p class="help-block margin-bottom-cero"><small>Actividad:</small></p>
			  				<input type="text" class="form-control" placeholder="Actividad" name="actividad" id="actividad" value="{{ Input::old('actividad') }}">
				  		</div>	  			
				  		<div class="col-sm-1">
				  			<p class="help-block margin-bottom-cero"><small>Estado:</small></p>
				  			<div class="checkbox">
						    	<label>
						      		<input type="checkbox" checked="checked" name="estado" id="estado" value="1"> Activo
						    	</label>
					  		</div>
				  		</div>
				  	</div>

					<div class="form-group">
						<div class="col-sm-12">
							<br/>
							<input type="submit" value="Registrar Recurso" class="btn btn-success form-control">
						</div>
					</div>							  	

				</fieldset>					

			</form>

		</div>

	</div>

</div>

@stop