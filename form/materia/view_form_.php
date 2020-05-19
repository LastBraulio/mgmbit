<div class="container">
  <!-- Content here -->
	<div class="row">
		<div class="col">
		  <div class="form-group">
			<label for="InputNombre">Nombre Materia</label>
			<input type="text" class="form-control" id="InputNombrecss" value=<?php echo $data["nom_materia"] ?> disabled>
		  </div>
		  <div class="form-group">
			<label for="InputPuntaje">Puntuación</label>
			<input type="text" class="form-control" id="InputPuntajecss" value=<?php echo $data["puntaje"] ?> disabled>
		  </div>
		  <div class="form-group">
			  <label for="InputDescripcion">Descripcion</label>
			  <textarea class="form-control rounded-0" id="InputDescripcioncss" rows="3" disable> <?php echo $data["descripcion"] ?> </textarea>
			</div>
		</div>
		</div>
	</div>
</div>