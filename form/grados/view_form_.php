<div class="container">
  <!-- Content here -->
	<div class="row">
		<div class="col">
		  <div class="form-group">
			<label for="InputNombre">ID</label>
			<input type="text" class="form-control" id="InputNombrecss" value=<?php echo $data["id"] ?> disabled>
		  </div>
		  <div class="form-group">
			<label for="InputPuntaje">GRADO</label>
			<input type="text" class="form-control" id="InputPuntajecss" value=<?php echo $data["nombre"] ?> disabled>
		  </div>
		  <div class="form-group">
			<label for="InputDescripcion">Cantidad X Grado</label>
			<input type="text" class="form-control" id="InputDescripcioncss" value=<?php echo $data["cant"] ?> disabled>
		  </div>
		</div>
		</div>
	</div>
</div>