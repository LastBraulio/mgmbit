<?php

require_once ("conexion/conexion.php");


Class Modelo_cliente extends Conexiones{
	public $tabla = "countries";
	
	public function mostrar_ajax()
	{
		//$sentencia = "select * from countries";
		$sentencia = "Select t1.id_cliente,t1.cedula,t1.nombre,t1.apellido_paterno,t1.apellido_materno,t1.edad,t1.direccion,t1.ocupacion,t1.telefono_cel as celular ,t1.telefono_oficial as telefono ,t1.email,t2.nombre_tipo from clientes t1, tipo_cliente t2 where t1.tipo_cliente= t2.id_tipocliente";
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