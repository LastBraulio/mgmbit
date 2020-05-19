<div class="container">
  <!-- Content here -->
	<div class="row">
		<div class="col">
		  <div class="form-group">
			<label for="InputCedula">Cédula</label>
			<input type="text" class="form-control" id="InputCedulacss" value=<?php echo $data["cedula"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputNombre">Nombre</label>
			<input type="text" class="form-control" id="InputNombrecss" value=<?php echo $data["nombre"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputAP">Apellido Paterno</label>
			<input type="text" class="form-control" id="InputAPcss" value=<?php echo $data["apellido_paterno"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputAM">Apellido Materno</label>
			<input type="text" class="form-control" id="InputAMcss" value=<?php echo $data["apellido_materno"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputEdad">Edad</label>
			<input type="text" class="form-control" id="InputEdadcss" value=<?php echo $data["edad"] ?> disabled >
		  </div>
		  
		  <div class="form-group">
			<label for="InputDir">Dirección</label>
			<input type="text" class="form-control" id="InputDircss" value=<?php echo $data["direccion"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputOcc">Ocupación</label>
			<input type="text" class="form-control" id="InputOcccss" value=<?php echo $data["ocupacion"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputCel">Celular</label>
			<input type="text" class="form-control" id="InputCelcss" value=<?php echo $data["celular"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputTel">Teléfono Personal</label>
			<input type="text" class="form-control" id="InputTelcss" value=<?php echo $data["telefono"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputEmail">Email</label>
			<input type="email" class="form-control" id="InputEmailcss" value=<?php echo $data["email"] ?>>
		  </div>

		

		  <div class="form-group">
			<label for="InputFecha">Fecha R</label>
			<input type="text" class="form-control" id="InputFechacss" value=<?php echo $data["fecha_actual"] ?> disabled >
		  </div>
		  <div class="form-group">
			<label for="InputTipClient">Tipo de Cliente</label>
			<select class="form-control" id="InputTipClientcss" disabled>
				<option value='0'><?php echo $data["nombre_tipo"] ?></option>
			</select> 
		  </div>
		</div>
	</div>
</div>