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
			<form action="{{ URL::asset('register_solicitud') }}" method="POST" class="form-vertical" role="form">
			<input type="hidden" name="id_cliente" id="id_cliente" value="{{ $cliente_id }}">
			<input type="hidden" name="id_proveedor" id="id_proveedor" value="{{ $proveedor_id }}">
			<input type="hidden" name="solicitado" id="solicitado" value="1">
				<fieldset class="cool-fieldset">
					<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Nombre del proyecto: </small></p>
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
			  				<h3>Cliente: "{{ $cliente_usern }}"</h3>
			  				<h3>Proveedor: "{{ $proveedor->username }}"</h3>
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