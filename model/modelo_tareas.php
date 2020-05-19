
<?php

require_once ("conexion/conexion.php");


Class Modelo_tareas extends Conexiones{
	public $tabla = "countries";
	
	public function mostrar_ajax2()
	{
		//$sentencia = "select * from countries";
		$sentencia = "Select t1.id_tareas, t2.nombre_grado, t3.nom_materia, t4.descripcion, t1.nombre_tarea, t1.puntuacion, t1.fecha_entrega from tareas t1, grados t2, materia t3, jornada t4 where t1.id_grado = t2.id_grado and t1.id_materia = t3.id_materia and t1.id_jornada = t4.id_jornada; ";
		//var_dump($this->pdo);
		//exit;
		$resultado = $this->pdo->prepare($sentencia);
		$html="";
		$resultado->execute();
		/*while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$html.="<tr>";
			$html .= "<th>".$fila[0]."</th>"."<th>".$fila[1]."</th>"."<th>".$fila[2]."</th>"."<th>".$fila[3]."</th>"."<th>".$fila[4]."</th>";
			$html .="</tr>";
		}
		$this->pdo=null;
		echo $html; exit;*/
		$num = $resultado->fetchAll();

		$valor = array();
		$valor = array(
		"data"=> $num
		); 
		header('Content-type: application/json');
		echo json_encode($valor);
		//return $datos;
	}
	public function mostrar_ajax_evaluar($cedula)
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t3.id_tareas,t2.nom_materia, t3.nombre_tarea , t3.descripcion, t3.puntuacion, t3.fecha_entrega , t4.nombre , t3.adjuntos from view_asignarprofe_estudiante t1, materia t2 ,tareas t3, usuarios t4 where t1.id_materia = t3.id_materia and t1.id_grado = t3.id_grado and t1.id_jornada = t3.id_jornada and t1.id_materia = t2.id_materia and t1.cedula_stu = t4.cedula and t1.ced_profesor = '$cedula' and t3.cerrar_tarea = 2 ; ";
		//var_dump($this->pdo);
		//exit;
		$resultado = $this->pdo->prepare($sentencia);
		$html="";
		$resultado->execute();
		/*while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$html.="<tr>";
			$html .= "<th>".$fila[0]."</th>"."<th>".$fila[1]."</th>"."<th>".$fila[2]."</th>"."<th>".$fila[3]."</th>"."<th>".$fila[4]."</th>";
			$html .="</tr>";
		}
		$this->pdo=null;
		echo $html; exit;*/
		$num = $resultado->fetchAll();

		$valor = array();
		$valor = array(
		"data"=> $num
		); 
		header('Content-type: application/json');
		echo json_encode($valor);
		//return $datos;
	}
	public function mostrar_ajax($cedula)
	{
		$sentencia = "select t3.id_tareas,t2.nom_materia, t3.nombre_tarea as title, t3.descripcion, t3.puntuacion, t3.fecha_entrega as start, t4.nombre from view_asignarprofe_estudiante t1, materia t2 ,tareas t3, usuarios t4 where t1.id_materia = t3.id_materia and t1.id_grado = t3.id_grado and t1.id_jornada = t3.id_jornada and t1.id_materia = t2.id_materia and t1.ced_profesor = t4.cedula and t1.cedula_stu = '$cedula';";
		//$sentencia = "Select t1.id_tareas, t2.nombre_grado, t3.nom_materia, t4.descripcion, t1.nombre_tarea, t1.puntuacion, t1.fecha_entrega from tareas t1, grados t2, materia t3, jornada t4 where t1.id_grado = t2.id_grado and t1.id_materia = t3.id_materia and t1.id_jornada = t4.id_jornada; ";
		//var_dump($this->pdo);
		//exit;
		$resultado = $this->pdo->prepare($sentencia);
		$html="";
		$resultado->execute();
		/*while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$html.="<tr>";
			$html .= "<th>".$fila[0]."</th>"."<th>".$fila[1]."</th>"."<th>".$fila[2]."</th>"."<th>".$fila[3]."</th>"."<th>".$fila[4]."</th>";
			$html .="</tr>";
		}
		$this->pdo=null;
		echo $html; exit;*/
		$num = $resultado->fetchAll();

		$valor = array();
		$valor = array(
		"data"=> $num
		); 
		header('Content-type: application/json');
		echo json_encode($valor);
		//return $datos;
	}
	public function mostrar_ajax_calendario($cedula)
	{
		$sentencia = "select t3.id_tareas as id, t3.nombre_tarea as title, t3.descripcion as descripcion , '#4e73df' as color , '#FFFFFF' as textColor ,t3.fecha_entrega as start from view_asignarprofe_estudiante t1, materia t2 ,tareas t3, usuarios t4 where t1.id_materia = t3.id_materia and t1.id_grado = t3.id_grado and t1.id_jornada = t3.id_jornada and t1.id_materia = t2.id_materia and t1.ced_profesor = t4.cedula and t1.cedula_stu = '$cedula';";
		//$sentencia = "Select t1.id_tareas, t2.nombre_grado, t3.nom_materia, t4.descripcion, t1.nombre_tarea, t1.puntuacion, t1.fecha_entrega from tareas t1, grados t2, materia t3, jornada t4 where t1.id_grado = t2.id_grado and t1.id_materia = t3.id_materia and t1.id_jornada = t4.id_jornada; ";
		//var_dump($this->pdo);
		//exit;
		$resultado = $this->pdo->prepare($sentencia);
		$html="";
		$resultado->execute();
		/*while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$html.="<tr>";
			$html .= "<th>".$fila[0]."</th>"."<th>".$fila[1]."</th>"."<th>".$fila[2]."</th>"."<th>".$fila[3]."</th>"."<th>".$fila[4]."</th>";
			$html .="</tr>";
		}
		$this->pdo=null;
		echo $html; exit;*/
		$num = $resultado->fetchAll(PDO::FETCH_ASSOC);

		//$valor = array();
		//$valor = array(
		//"data"=> $num
		//); 
		header('Content-type: application/json');
		echo json_encode($num);
		//echo json_encode($valor);
		//return $datos;
	}
	public function tipo_materia($id)
	{
		$sentencia = "select t1.id_materia as id ,t2.nom_materia as nombre from asignar_profesor_materia t1, materia t2 where t1.id_materia= t2.id_materia and t1.cedula = '$id';";
		//$sentencia = "select t1.id_materia as id, t1.nom_materia as nombre from materia t1";

		$resultado = $this->pdo->prepare($sentencia);
		$resultado->execute();

		$num = $resultado->fetchAll();

		/*$valor = array();
		$valor = array(
		"data"=> $num
		); */
		header('Content-type: application/json');
		echo json_encode($num);
		//return $datos;
	}
	public function tipo_grado($id,$id_materia)
	{
		$sentencia = "select t1.id_grado as id ,t2.nombre_grado as nombre from asignar_profesor_materia t1, grados t2 where t1.id_grado= t2.id_grado and t1.id_materia = $id_materia and t1.cedula = '$id'";

		$resultado = $this->pdo->prepare($sentencia);
		$resultado->execute();

		$num = $resultado->fetchAll();

		/*$valor = array();
		$valor = array(
		"data"=> $num
		); */
		header('Content-type: application/json');
		echo json_encode($num);
		//return $datos;
	}
	public function tipo_jornada($id,$id_materia)
	{
		$sentencia = "select t1.id_jornada as id ,t2.descripcion as nombre from asignar_profesor_materia t1, jornada t2 where t1.id_jornada= t2.id_jornada and t1.id_materia = $id_materia and t1.cedula = '$id'";

		$resultado = $this->pdo->prepare($sentencia);
		$resultado->execute();

		$num = $resultado->fetchAll();

		/*$valor = array();
		$valor = array(
		"data"=> $num
		); */
		header('Content-type: application/json');
		echo json_encode($num);
		//return $datos;
	}
	public function getid($buscar,$cedula)
	{
		//$sql = "select t1.country, t1.iso2 , t1.iso3, t1.noc from countries t1 where t1.id = ".$buscar.";";
		$sql = "select t3.id_tareas,t2.nom_materia, t3.nombre_tarea as title, t3.descripcion, t3.puntuacion, t3.fecha_entrega as start, t4.nombre from view_asignarprofe_estudiante t1, materia t2 ,tareas t3, usuarios t4 where t1.id_materia = t3.id_materia and t1.id_grado = t3.id_grado and t1.id_jornada = t3.id_jornada and t1.id_materia = t2.id_materia and t1.ced_profesor = t4.cedula and t1.cedula_stu = '$cedula' and t3.id_tareas = $buscar ;";
		//echo $sql; exit;
			//var_dump($this->pdo); exit; 
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			$num = $stmt->fetchAll();
			return $num ;	
	}
	public function insert($data)
	{
		$sql = "INSERT INTO tareas (id_grado,id_materia,id_jornada,nombre_tarea,descripcion,puntuacion,cerrar_tarea,fecha_entrega) VALUES (:id_grado, :id_materia, :id_jornada, :nombre_tarea, :descripcion, :puntuacion, :cerrar_tarea ,:fecha_entrega)";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto La Tarea => '.$data["nombre_tarea"], 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function insert_notas($data)
	{
		$sql = "INSERT INTO notas (id_tarea,descripcion,observacion,calificacion,porcentaje,fecha_cal) VALUES (:id_tarea, :descripcion, :observacion, :calificacion, :porcentaje, :fecha_cal )";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto La Calificación de la tarea  ', 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function update($id,$data)
	{
		$sql = "UPDATE countries SET country=:country ,iso2=:iso2, iso3=:iso3 ,noc=:noc WHERE id=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Actualizo el Registro => '.$data["country"], 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function update_tareas($id,$data)
	{
		$sql = "UPDATE tareas SET cerrar_tarea=:cerrar_tarea ,adjuntos=:adjuntos WHERE id_tareas=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Actualizo La Tarea => ', 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
	}
	public function delete($id)
	{
		$sql = "DELETE FROM countries WHERE id=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Elimino el Registro => '.$id , 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
	}
	
}


?>