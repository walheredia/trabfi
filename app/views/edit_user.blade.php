@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Actualizar datos del usuario</h1>

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
			<form action="{{ URL::asset('edit_user') }}" method="post" class="form-vertical" role="form">

				<fieldset class="cool-fieldset">

					<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Nombre:</small></p>
			  				<input type="text" class="form-control" placeholder="Nombre..." name="first_name" id="nombre" value=<?php echo $user->first_name;?>>
				  		</div>

						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Apellido:</small></p>
			  				<input type="text" class="form-control" placeholder="Apellido..." name="last_name" id="apellido" value=<?php echo $user->last_name;?>>
				  		</div>		  			
				  	</div>

				  	<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>E-mail:</small></p>
			  				<input type="email" class="form-control" placeholder="E-mail..." name="email" id="email" value=<?php echo $user->email;?>>
				  		</div>	  			
				  	</div>

				  	<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Nombre de usuario:</small></p>
			  				<input type="text" class="form-control" placeholder="Nombre de usuario..." name="username" id="username" value=<?php echo $user->username;?>>
				  		</div>	  			
				  	</div>

				  	<div class="form-group">
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Contraseña:</small></p>
			  				<input type="password" class="form-control" placeholder="Contraseña..." name="password" id="password">
				  		</div>
						<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Confirmar Contraseña:</small></p>
	  						<input type="password" class="form-control" placeholder="Confirmar Contraseña..." name="confirmar_clave" id="confirmar_clave">
				  		</div>		  			
				  	</div>

				  	<div class="form-group">
						<div class="col-sm-10">
			  				<p class="help-block margin-bottom-cero"><small>Tipo de Usuario:</small></p>
			  				<select class="form-control" name="tipo_usuario" id="tipo_usuario" data-val="tipo_usuario">
			  					<option value="" selected disabled>Por favor, seleccione</option>
			  					@foreach ($tiposusuario as $t)
		                          <option value="{{ $t->id_tipousuario }}">{{ $t->tipousuario }}</option>
		                        @endforeach
			  				</select>
				  		</div>
				  		<div class="col-sm-2">
			  				<p class="help-block margin-bottom-cero"><small>ID:</small></p>
	  						<input type="text" class="form-control" name="id" id="id" value=<?php echo $user->id;?>>
				  		</div>					  			
				  	</div>
					<div class="form-group">					
							<div class="col-sm-12">
								<input type="submit" value="Actualizar Usuario" class="btn btn-success form-control">
							</div>
					</div>							  	

				</fieldset>					

			</form>

		</div>

	</div>

</div>

@stop


<!-- 
<form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('register') }}">	
		<fieldset class="cool-fieldset">
				<div class="form-group">
					<div class="col-sm-6">
		  				<h5><strong>Ingrese sus datos personales</strong></h5>
			  		</div>	
				</div>
				<div class="form-group">
					<div class="col-sm-3">
		  				<p class="help-block margin-bottom-cero"><small>Nombre:</small></p>
		  				<input type="text" class="form-control" placeholder="Nombre..." name="servicio-modalidad-sae" id="servicio-modalidad-sae">
			  		</div>
					<div class="col-sm-3">
		  				<p class="help-block margin-bottom-cero"><small>Apellido:</small></p>
		  				<input type="text" class="form-control" placeholder="Apellido..." name="servicio-modalidad-sae" id="servicio-modalidad-sae">
			  		</div>		  			
			  	</div>
			  	<div class="form-group">
					<div class="col-sm-3">
		  				<p class="help-block margin-bottom-cero"><small>E-mail:</small></p>
		  				<input type="text" class="form-control" placeholder="E-mail..." name="servicio-modalidad-sae" id="servicio-modalidad-sae">
			  		</div>
					<div class="col-sm-3">
		  				<p class="help-block margin-bottom-cero"><small>Contraseña:</small></p>
		  				<input type="text" class="form-control" placeholder="Contraseña..." name="servicio-modalidad-sae" id="servicio-modalidad-sae">
			  		</div>		  			
			  	</div>
			  	<div class="form-group">
					<div class="col-sm-6">
		  				<p class="help-block margin-bottom-cero"><small>Confirmar Contraseña:</small></p>
		  				<input type="text" class="form-control" placeholder="Confirmar Contraseña..." name="servicio-modalidad-sae" id="servicio-modalidad-sae">
			  		</div>		  			
			  	</div>

			  	<div class="form-group">
			  			<div class="col-sm-6">
		  				<input type="submit" value="Registrarme" class="btn btn-success form-control">
			  		</div>
			  	</div>		
		</fieldset>	
</form>
-->