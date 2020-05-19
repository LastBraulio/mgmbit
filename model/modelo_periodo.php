<?php

require_once ("conexion/conexion.php");


Class Modelo_periodo extends Conexiones{
	public $tabla = "countries";
	
	public function mostrar_ajax()
	{
		//$sentencia = "select * from countries";
		$sentencia = "Select t1.id_periodo, t1.periodo, t1.ano_lectivo ,t1.fecha_inicio, t1.fecha_final, t1.descripcion FROM periodo t1";
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
		$sql = "Select t1.id_periodo, t1.periodo, t1.ano_lectivo ,t1.fecha_inicio, t1.fecha_final, t1.descripcion FROM periodo t1 where id_periodo = ".$buscar.";";
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
		$sql = "INSERT INTO periodo (periodo,ano_lectivo,fecha_inicio,fecha_final,descripcion) VALUES (:periodo, :ano_lectivo, :fecha_inicio, :fecha_final,:descripcion)";
		try{
			//var_dump($this->pdo); exit;
			//print_r($data);
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute($data);
			
			header('Content-type: application/json');
			$message = [ 'msn' => 'Se Inserto el Periodo => '.$data["periodo"], 'valor' => 1 ];
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
		
		$sql = "UPDATE periodo SET periodo=:periodo,ano_lectivo=:ano_lectivo,fecha_inicio=:fecha_inicio,fecha_final=:fecha_final, descripcion=:descripcion WHERE id_periodo=". $id ;
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
		$sql = "DELETE FROM periodo WHERE id_periodo=". $id ;
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