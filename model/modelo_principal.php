<?php

require_once "conexion/conexion.php";


Class Modelo_principal extends Conexiones{
	
	
	public function mostrar_ajax()
	{
		$sentencia = "select * from countries";
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
	public function getid($buscar)
	{
		$sql = "select t1.nombre,t3.id_perfiles, t3.descripcion from usuarios t1, usu_usuario_perfil t2, perfiles t3 where t1.cedula = t2.cedula and t1.cedula = '$buscar' and t2.nombre_perfil = t3.descripcion;";
		//echo $sql;
			//var_dump($this->pdo); exit; 
			//print_r($data); exit;
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute();
			
			$num = $stmt->fetchAll();
			return $num ;	
	}
}
/*$sentencia = "select * from countries";
$resultado = $pdo->prepare($sentencia);
$resultado->execute();
$num = $resultado->fetchAll();

$valor = array();
$valor = array(
"data"=> $num
); 
header('Content-type: application/json');
echo json_encode($valor);*/

?>