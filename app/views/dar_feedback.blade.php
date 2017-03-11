@extends ('layout')

@section ('content')

<div class="container">

	<div class="row text-center">

		<h1>Datos del Feedback</h1>

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
			<form action="{{ URL::asset('dar_feedback') }}" method="POST" class="form-vertical" role="form">

				<fieldset class="cool-fieldset">
				<input type="hidden" name="id_proyecto" id="id_proyecto" value="{{ $etapa->id_proyecto }}">
				<input type="hidden" name="id_etapa" id="id_etapa" value="{{ $etapa->id_etapa }}">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="panel panel-default">
							  <div class="panel-heading">
							    <center><h3 class="panel-title">Valor del Feedback (Apreciación personal de los logros obtenidos):</h3></center>
							  </div>
							  <center>
							  	<div class="panel-body">
							    <label class="radio-inline"><input type="radio" name="feedback" id="1" value="1">1 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="2" value="2">2 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="3" value="3">3 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="4" value="4">4 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="5" value="5">5 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="6" value="6">6 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="7" value="7">7 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="8" value="8">8 | </label>
								<label class="radio-inline"><input type="radio" name="feedback" id="9" value="9">9 | </label>
								<label class="radio-inline"><input type="radio" checked="checked" name="feedback" id="10" value="10">10 |</label>
							  </div>
							  </center>
							  <p>*Nota: Los valores expresan conformidad del "<strong>1</strong>" (Nada conforme) a "<strong>10</strong>" (Muy conforme)</p>
							</div>
				  		</div>
		  			</div>
		  			<div class="form-group">
						<div class="col-sm-12">
			  				<p class="help-block margin-bottom-cero"><small>Descripción (Detalle): </small></p>
			  				<textarea class="input form-control" rows="4" cols="12" id="descripcion" name="descripcion" placeholder="Descripción (Detalle)" required></textarea>
				  		</div>		  			
				  	</div>
				  	<div class="form-group">						
				  		<div class="col-sm-6">
			  				<p class="help-block margin-bottom-cero"><small>Fecha: </small></p>
			  				<input type="date" class="form-control" placeholder="Fecha..." name="fecha" id="fecha" required>
				  		</div>
				  	</div>

					<div class="form-group">
						<div class="col-sm-12">
							<br/>
							<input type="submit" value="Registrar Feedback" class="btn btn-success form-control">
						</div>
					</div>							  	

				</fieldset>					

			</form>

		</div>

	</div>

</div>

@stop