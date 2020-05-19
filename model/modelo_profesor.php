<?php

require_once ("conexion/conexion.php");


Class Modelo_profesor extends Conexiones{
	public $tabla = "countries";
	
	public function mostrar_ajax2()
	{
		//$sentencia = "select * from countries";
		$sentencia = "Select t1.cedula, t1.nombre, t1.telefono, t1.email, t2.nombre_perfil from usuarios t1 left join usu_usuario_perfil t2 on t1.cedula = t2.cedula left join perfiles t3 on t3.descripcion = t2.nombre_perfil where t3.descripcion='Profesor' AND t1.cedula NOT IN (select cedula from asignar_profesor_materia);";
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

	public function mostrar_ajax()
	{
		//$sentencia = "select * from countries";
		$sentencia = "Select t1.cedula, t1.nombre, t1.telefono, t1.email, t2.nombre_perfil from usuarios t1 left join usu_usuario_perfil t2 on t1.cedula = t2.cedula left join perfiles t3 on t3.descripcion = t2.nombre_perfil where t3.descripcion='Profesor';";
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

	// 
	public function mostrar_ajax_asignados_materias()
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t2.cedula, t2.nombre, t2.email, t3.nom_materia, t4.nombre_grado , t5.descripcion, t4.cant_est from asignar_profesor_materia t1, usuarios t2, materia t3, grados t4, jornada t5 where t1.cedula = t2.cedula and t1.id_materia = t3.id_materia  and t1.id_grado = t4.id_grado and t1.id_jornada = t5.id_jornada ";
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
		"data2"=> $num
		); 
		header('Content-type: application/json');
		echo json_encode($valor);
		//return $datos;
	}
	public function tipo_cliente_ajax()
	{
		$sentencia = "select id_tipocliente as id , nombre_tipo as nombre from tipo_cliente ";

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
	public function tipo_grado()
	{
		$sentencia = "select t1.id_grado, t1.nombre_grado from grados t1 ";

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
	public function tipo_jornada()
	{
		$sentencia = "select id_jornada, descripcion from jornada ";

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
	public function tipo_materia()
	{
		$sentencia = "select t1.id_materia, t1.nom_materia from materia t1";

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
	public function getid($buscar)
	{
		$sql = "Select t1.cedula,t1.nombre,t1.apellido_paterno,t1.apellido_materno,t1.edad,t1.direccion,t1.ocupacion,t1.telefono_cel as celular ,t1.telefono_oficial as telefono ,t1.email,t1.fecha_actual ,t2.nombre_tipo from clientes t1, tipo_cliente t2 where t1.tipo_cliente= t2.id_tipocliente and t1.id_cliente = ".$buscar.";";
		//echo $sql;
			//var_dump($this->pdo); exit; 
			//print_r($data); exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			$num = $stmt->fetchAll();
			return $num ;	
	}
	public function insert($data)
	{
		$sql = "INSERT INTO clientes (cedula,nombre,apellido_paterno,apellido_materno,edad,direccion,ocupacion,telefono_cel,telefono_oficial,email,fecha_actual,tipo_cliente) VALUES (:cedula, :nombre, :apellido_paterno, :apellido_materno,:edad, :direccion, :ocupacion, :telefono_cel, :telefono_oficial, :email, :fecha_actual, :tipo_cliente )";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto el Cliente => '.$data["nombre"]." ".$data["apellido_paterno"], 'valor' => 1 ];
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
	public function insert_asignados($data)
	{
		$sql = "INSERT INTO asignar_profesor_materia (cedula,id_materia,id_grado,id_jornada) VALUES (:cedula, :id_materia, :id_grado, :id_jornada )";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Asigno el Profesor con cedula => '.$data["cedula"], 'valor' => 1 ];
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
		
		$sql = "UPDATE clientes SET cedula=:cedula,nombre=:nombre,apellido_paterno=:apellido_paterno,apellido_materno=:apellido_materno, edad=:edad,direccion=:direccion,ocupacion=:ocupacion,telefono_cel=:telefono_cel,telefono_oficial=:telefono_oficial,email=:email, fecha_actual=:fecha_actual,tipo_cliente=:tipo_cliente WHERE id_cliente=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			//echo $sql; exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Actualizo el Cliente => '.$data["nombre"]." ".$data["apellido_paterno"], 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			echo $e; echo "<br>";
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function delete($id)
	{
		$sql = "DELETE FROM clientes WHERE id_cliente=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Elimino el Cliente => '.$id , 'valor' => 1 ];
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