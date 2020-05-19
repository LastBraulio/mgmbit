<?php

require_once ("conexion/conexion.php");


Class Modelo_materia extends Conexiones{

	
	public function mostrar_ajax()
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t1.id_materia, t1.nom_materia,t1.puntaje,t1.descripcion from materia t1";
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
	public function mostrar_ajax_grados()
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t2.id_grado, t2.nombre_grado, t2.cant_est from grados t2 ";  
		//var_dump($this->pdo);   \"$tagger\"
	
		$resultado = $this->pdo->prepare($sentencia);
		$html="";
		$resultado->execute();

		$num = $resultado->fetchAll();

		$valor = array();
		$valor = array(
		"data"=> $num
		); 
		header('Content-type: application/json');
		echo json_encode($valor);
		//return $datos;
	}
	public function perfiles_ajax()
	{
		$sentencia = "select t1.id_perfiles as id, t1.descripcion from perfiles t1";

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
	public function getid_grados($buscar)
	{
		$sql = "select t2.id_grado, t2.nombre_grado, t2.cant_est from grados t2 where t2.id_grado = ". $buscar .";";
		//echo $sql;
			//var_dump($this->pdo); exit; 
			//print_r($data); exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			$num = $stmt->fetchAll();
			return $num ;	
	}
	public function getid($buscar)
	{
		$sql = "select t1.id_materia,t1.nom_materia, t1.puntaje, t1.descripcion from materia t1 where t1.id_materia =  ". $buscar .";";
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
		$sql = "INSERT INTO materia (nom_materia,puntaje,descripcion) VALUES (:nom_materia, :puntaje, :descripcion )";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			$LAST_ID = $this->pdo->lastInsertId();
			//header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto la Materia  => '.$data["nom_materia"] ." Satisfactoriamente", 'valor' => 1 ];
			return json_encode( $message );
			//return $LAST_ID;
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );

			return 0;
		}
		
	}
	public function insert_grados($data)
	{
		$sql = "INSERT INTO grados (nombre_grado,cant_est) VALUES (:nombre_grado, :cant_est)";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			$LAST_ID = $this->pdo->lastInsertId();
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto el Grado  => '.$data["nombre_grado"] ." Satisfactoriamente", 'valor' => 1 ];
			return json_encode( $message );
			//return $LAST_ID;
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );

			return 0;
		}
		
	}
	public function update_perfil($id,$data)
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
			//echo $e; echo "<br>";
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function update_m($id,$data)
	{
		$sql = "UPDATE materia SET nom_materia=:nom_materia,puntaje=:puntaje,descripcion=:descripcion WHERE id_materia=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			//echo $sql; exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Actualizo la Materia => '.$data["nom_materia"], 'valor' => 1 ];
			return json_encode( $message );
		}
		catch (Exception $e){
			//echo $e; echo "<br>";
			$this->pdo->rollback();
			//throw $e;
			header('Content-type: application/json');
			$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			return json_encode( $message );
		}
		
	}
	public function insert_perfil_usuario($nuevoid,$ids)
	{	
		$sql = "INSERT INTO menu_perfil_usuario (id_menus,id_usuario_perfil,id_perfil) SELECT t1.id_menus, $nuevoid as nuevoid, t1.id_perfil from menu_perfil_usuario t1 where t1.id_perfil = $ids ";
			try{
				//var_dump($this->pdo); exit;
				//print_r($data);
				$stmt= $this->pdo->prepare($sql);
				$stmt->execute();
				//$LAST_ID = $this->pdo->lastInsertId();
				header('Content-type: application/json');
				$message = [ 'msn' => 'Se Establecio el Perfil del Usuario Satisfactoriamente', 'valor' => 1 ];
				return json_encode( $message );
				//return $LAST_ID;
			}
			catch (Exception $e){
				$this->pdo->rollback();
				//throw $e;
				header('Content-type: application/json');
				$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
				return json_encode( $message );

				return 0;
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
	public function delete_grados($id)
	{
		$sql = "DELETE FROM grados WHERE id_grado=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Elimino el Grado => '.$id , 'valor' => 1 ];
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
	// update 2
	public function update_perfil_nombre($id,$perfil)
	{
		$sql = "UPDATE usu_usuario_perfil SET nombre_perfil ". $perfil ." WHERE cedula=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			//echo $sql; exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			//header('Content-type: application/json');
			//$message = [ 'msn' => 'Se Actualizo el Cliente => '.$data["nombre"]." ".$data["apellido_paterno"], 'valor' => 1 ];
			//return json_encode( $message );
		}
		catch (Exception $e){
			//echo $e; echo "<br>";
			$this->pdo->rollback();
			//throw $e;
			//header('Content-type: application/json');
			//$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			//return json_encode( $message );
		}
	}

	public function select_perfil_nombre($id)
	{
		$sql = "SELECT id_usuario_perfil FROM usu_usuario_perfil WHERE cedula=". $id ;
		$stmt= $this->pdo->prepare($sql);
		$stmt->execute();
			
		$num = $stmt->fetchAll();
		return $num ;	
	}
	public function delete_menu_perfil_usuario($nuevoid)
	{
		$sql = "DELETE FROM menu_perfil_usuario WHERE id_usuario_perfil=". $nuevoid ;
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
	public function update_grados($id,$data)
	{
		
		$sql = "UPDATE grados SET nombre_grado=:nombre_grado,cant_est=:cant_est WHERE id_grado=". $id ;
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			//echo $sql; exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Actualizo el Grado => '.$data["nombre_grado"], 'valor' => 1 ];
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



}


?>