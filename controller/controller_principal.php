<?php

require_once 'model/modelo_principal.php';
require_once ("library/configuracion.php");
require_once ("library/login.php");

class Controller_principal {
	private $modelo_principal;
	private $db;
	private $log_in;
	
	function __construct(){
		
        $this->modelo_principal= new Modelo_principal();
		$this->db = new Configuracion();
		$this->log_in = new Login();
    }
	function index(){
		//session_start();
		//ob_start();
		include("html/header.php");
		//echo $_SESSION['count'];
		//if (!isset($_SESSION['count'])){
			//header('Location: http://www.google.com.pa');
		//	header( "refresh:10; url=login.php" );
		//	die("Seccion Finalizada");
		//}
		//echo $_COOKIE['nombre'];
		$id = $_COOKIE["cedula"];
		//$data= $this->modelo_principal->getid($id);
		$menu = $this->db->configurar_menus_opciones($id);
		if ($_COOKIE["id_perfiles"]==1){
			include("html/body_admin.php");
		}
		if ($_COOKIE["id_perfiles"]==2){
			include("html/body_admin.php");
		}
		if ($_COOKIE["id_perfiles"]==3){
			include("html/body_admin.php");
		}
		//include("html/body.php");
		include("html/link.php");
		include("html/footer.php");
    }
	function ejemplo1(){
		
		$arra = array(
			"titulo"=> "Esto es Un titulo",
			"cuerpo"=>"Esto es un cuerpo....."
		);
		include("html/view_cliente/view_cliente.php");
	}
	function ajaxtabla(){
		$tabla= $this->modelo_principal->mostrar_ajax();
		echo $tabla;
	}
	public function error404()
	{
		include("html/header.php");
		$id = $_COOKIE["cedula"];
        $menu = $this->db->configurar_menus_opciones($id);
		include("html/error404.php");
		include("html/link.php");
		include("html/footer.php");
	}
	public function login_check()
	{
		$cedula =$_POST['cedula'];
		$pass =$_POST['pass'];
		
		$valores = $this->log_in->login_check($cedula,$pass);

		
		if($valores["names"]!=""){

			$this->log_in->updatestatus($cedula,$pass,1);
			//print_r($valores); exit;
		}
		
		setcookie("cedula",$cedula,time() + (86400 * 30),"/");
		setcookie("nombre",$valores['names'],time() + (86400 * 30),"/");

		$data= $this->modelo_principal->getid($cedula);

		setcookie("id_perfiles",$data[0]["id_perfiles"],time() + (86400 * 30),"/");
		setcookie("descripcion",$data[0]["descripcion"],time() + (86400 * 30),"/");
		

			//echo $_COOKIE['cedula']."  ".$_COOKIE['nombre']; exit;
		header('Content-type: application/json');
			//echo $valores;
		echo json_encode($valores);
		
	}
	public function login_down(){
		
		error_reporting(0);
		
		//$message = [ 'msn' => 'Ha Cerrado Sección..... Espere 10 min', 'valor' => 1 ];
		//echo json_encode( $message['msn'] );
		$this->log_in->updatestatus2($_COOKIE['cedula'],0);
		
		//header( "refresh:10; url=login.php" );
		header("Location:login.php");
	}
	public function registrese()
	{
		$cedula = $_POST["cedula"];
		$nombre = $_POST["nombre"];
		$pass = $_POST["pass"];

		$data = $this->log_in->usuario_exist($cedula);

		if ($data==0)
		{
			echo "cero";
			
			$msn = $this->log_in->insert_usuario($cedula,$nombre,$pass);
			header('Content-type: application/json');
			echo json_encode($msn);
		}
		else
		{
			//echo $data;
			$msn = [ 'msn' => 'La Cedula '.$cedula." Ya Existe dentro del sistema....  ", 'valor' => 0];
			header('Content-type: application/json');
			echo json_encode($msn);
		}
		
	}
	public  function profile_user()
	{
		include("html/header.php");
		$id = $_COOKIE["cedula"];
        $menu = $this->db->configurar_menus_opciones($id);
		include("html/view_usuario/profile_users.php");
		include("html/link.php");
		include("html/footer.php");
	}
	
}