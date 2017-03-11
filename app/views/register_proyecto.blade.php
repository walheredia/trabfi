@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Datos del Proyecto</h1>

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
			<form action="{{ URL::asset('register_proyecto') }}" method="POST" class="form-vertical" role="form">

				<fieldset class="cool-fieldset">
					<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Nombre: </small></p>
			  				<input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="nombre" value="{{ Input::old('nombre') }}">
				  		</div>		  			
				  	</div>
				  	<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Inicio: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha Inicio..." name="fecha_inicio" id="fecha_inicio">
				  		</div>
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha Estimada Fin: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha estimada Fin..." name="fecha_fin" id="fecha_fin">
				  		</div>
				  	</div>
				  	<div class="form-group">
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Cliente:</small></p>
			  				<select class="form-control" name="cliente" id="cliente" data-val="cliente">
			  					<option value="" selected disabled>Por favor, seleccione</option>
			  					@foreach ($clientes as $c)
		                          <option value="{{ $c->id }}">{{ $c->first_name }}</option>
		                        @endforeach
			  				</select>
				  		</div>
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Medio de Pago:</small></p>
			  				<select class="form-control" name="mpago" id="mpago" data-val="mpago">
			  					<option value="" selected disabled>Por favor, seleccione</option>
			  					@foreach ($mpagos as $m)
		                          <option value="{{ $m->id_mpago }}">{{ $m->mpago }}</option>
		                        @endforeach
			  				</select>
				  		</div>
				  	</div>
			  		<div class="form-group">					
						<div class="col-sm-12">
							<br/>
							<input type="submit" value="Registrar y continuar" class="btn btn-success form-control">
						</div>
					</div>
				</fieldset>					

			</form>

		</div>

	</div>

</div>

@stop