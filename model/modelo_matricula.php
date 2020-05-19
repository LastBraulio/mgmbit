<?php

require_once ("conexion/conexion.php");


Class modelo_matricula extends Conexiones{
	public $tabla = "countries";
	
	public function mostrar_ajax()
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t1.cedula, t1.nombre, t1.email, t2.nombre_perfil from usuarios t1 left join usu_usuario_perfil t2 on t1.cedula = t2.cedula";
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
	public function mostrar_ajax_conectado()
	{
		//$sentencia = "select * from countries";
		$sentencia = "select t1.cedula, t1.nombre, t1.email, t2.nombre_perfil, if(t1.conexion=1,'<a class=\"btn btn-primary btn-sm\">ONLINE</a>','<a class=\"btn btn-danger btn-sm\">OFFLINE</a>') as conexion from usuarios t1 right join usu_usuario_perfil t2 on t1.cedula = t2.cedula";  
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
	public function getid($buscar)
	{
		$sql = "select t1.cedula, t1.nombre, t2.nombre_perfil from usuarios t1 , usu_usuario_perfil t2 where t1.cedula = '".$buscar."' and t1.cedula = t2.cedula ;";
		//echo $sql;
			//var_dump($this->pdo); exit; 
			//print_r($data); exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			$num = $stmt->fetchAll();
			return $num ;	
	}
	public function insert_perfil($data)
	{
		$sql = "INSERT INTO usu_usuario_perfil (nombre_perfil,cedula) VALUES (:nombre_perfil, :cedula )";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			$LAST_ID = $this->pdo->lastInsertId();
			//header('Content-type: application/json');
			//$message = [ 'msn' => 'Se Inserto el Cliente => '.$data["nombre"]." ".$data["apellido_paterno"], 'valor' => 1 ];
			//return json_encode( $message );
			return $LAST_ID;
		}
		catch (Exception $e){
			$this->pdo->rollback();
			//throw $e;
			//header('Content-type: application/json');
			//$message = [ 'msn' => 'Error RollBack => '.$e, 'valor' => 0 ];
			//return json_encode( $message );

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



}


?>