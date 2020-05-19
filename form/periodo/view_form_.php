<div class="container">
  <!-- Content here -->
	<div class="row">
		<div class="col">
		  

		  	<div class="form-group">
				<label for="InputPeriodo">Periodo</label>
				<input type="text" class="form-control" id="InputPeriodocss"  value=<?php echo $data["periodo"] ?> disabled>
		  	</div>

		  	<div class="form-group">
				<label for="InputLectivoAno">Año Lectivo</label>
				<input type="text" class="form-control" id="InputLectivoAnocss" value=<?php echo $data["ano_lectivo"] ?> disabled>
		  	</div>

			 <div class="form-group">
				<label for="InputFechaIni">Fecha Inicio</label>
				<input type="text" class="form-control" id="InputFechaInicss" value=<?php echo $data["fecha_inicio"] ?> disabled>
			 </div>
			 <div class="form-group">
				<label for="InputFechaFinal">Fecha Final</label>
				<input type="text" class="form-control" id="InputFechaFinalcss" value=<?php echo $data["fecha_final"] ?> disabled>
			 </div>
			  
			 <div class="form-group">
				<label for="InputDescripcion">Descripción</label>
				<input type="text" class="form-control" id="InputDescripcioncss" value=<?php echo $data["descripcion"] ?> disabled>
			 </div>
		</div>
	</div>
</div>