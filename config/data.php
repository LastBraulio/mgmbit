<?php
$data = array(
        "data"=>array(
            array(
                "name"=>"Peter",
                "lastname"=>"Griffin",
                "city"=>"Quahog",
                "gender"=>"male"
            ),
            array(
                "name"=>"Homer",
                "lastname"=>"Simpson",
                "city"=>"Springfield",
                "gender"=>"male"
            ),
            array(
                "name"=>"Turanga",
                "lastname"=>"Leela",
                "city"=>"New New York",
                "gender"=>"female"
            )
        )
);
require_once ("conexion.php");
//require_once ("conexion/configdb.php");
$db = new Conexiones();

//print_r($db->pdo); 
$pdo = new PDO("mysql:host=localhost;dbname=bd2","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//print_r($pdo); exit;
//$cedula =$_POST['cedula'];
//$pass =$_POST['pass'];

//$cedula ='4-752-2225';
//$pass ='123456';

$sentencia = "select * from countries";
$resultado = $pdo->prepare($sentencia);
$resultado->execute();
$num = $resultado->fetchAll();
//print_r($num); exit;
//while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  //    $datos = $fila[0];
    //}
//echo $datos;
//$pdo=null;
$valor = array();
$valor = array(
"data"=> $num
); 
header('Content-type: application/json');
echo json_encode($valor);

//echo json_encode($num);
//echo json_encode($data);
?>