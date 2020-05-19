<?php

require_once 'model/modelo_usuario.php';
require_once ("library/configuracion.php");

class Controller_usuario {
	private $modelo_usuario;
	private $db;
	private $log_in;
	
	function __construct(){
		
        $this->modelo_usuario = new Modelo_usuario();
		$this->db = new Configuracion();
    }
	function index(){
		//session_start();
		//ob_start();
		// include("html/header.php");
		//echo $_SESSION['count'];
		//if (!isset($_SESSION['count'])){
			//header('Location: http://www.google.com.pa');
		//	header( "refresh:10; url=login.php" );
		//	die("Seccion Finalizada");
		//}
		//echo $_COOKIE['nombre'];
		//$id = $_COOKIE["cedula"];
		//$menu = $this->db->configurar_menus_opciones($id);
		//include("html/body.php");
		//include("html/link.php");
		//include("html/footer.php");

		include("html/view_usuario/header_usuario.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_usuario/body_usuario.php");
		include("html/view_usuario/link_usuario.php");
		include("html/footer.php");
    }

	function ajaxtabla(){
		$tabla= $this->modelo_usuario->mostrar_ajax();
		echo $tabla;
	}
	function get_perfiles()
	{
		$tabla= $this->modelo_usuario->perfiles_ajax();
		echo $tabla;
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		//echo $buscar;
		$data= $this->modelo_usuario->getid($buscar);
		//print_r($data); exit;
		//$data = array(
		//	"cedula"=> $data["cedula"],
		//	"nombre"=> $data["nombre"]
		//);
		//$edit=true;
		//include("form/view_form_country.php");
		header('Content-type: application/json');
		echo json_encode( $data );
		//print_r( $data);
	}
	public function update1()
	{
		$data1 = array(
			"nombre_perfil"=> $_POST['InputPerfilcss_u'],
			"cedula"=> $_POST['InputCedulacss_u']
		);
		//print_r($data); exit;
		$ids = $_POST['InpOPT'];
		$nuevoid = $this->modelo_usuario->insert_perfil($data1);

		$msn= $this->modelo_usuario->insert_perfil_usuario($nuevoid,$ids);
		echo $msn;
	}
	public function update2()
	{
		
		$ids = $_POST['InputCedulacss_u'];
		$perfil= $_POST['InputPerfilcss_u'];
		$idperfil= $_POST['InpOPT'];

		$this->modelo_usuario->update_perfil_nombre($id,$perfil);

		$nuevoid = $this->modelo_usuario->select_perfil_nombre($id);

		$msndelete = $this->modelo_usuario->delete_menu_perfil_usuario($nuevoid);

		$msn = $this->modelo_usuario->insert_perfil_usuario($nuevoid,$idperfil);

		echo $msn;
	}
	public function conectado()
	{
		include("html/view_usuario/header_conectados.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_usuario/body_conectado.php");
		include("html/view_usuario/link_usuario.php");
		include("html/footer.php");
	}
	function ajaxtabla_conectado(){
		$tabla= $this->modelo_usuario->mostrar_ajax_conectado();
		echo $tabla;
	}
	function bloqueo(){
		//session_start();
		//ob_start();
		// include("html/header.php");
		//echo $_SESSION['count'];
		//if (!isset($_SESSION['count'])){
			//header('Location: http://www.google.com.pa');
		//	header( "refresh:10; url=login.php" );
		//	die("Seccion Finalizada");
		//}
		//echo $_COOKIE['nombre'];
		//$id = $_COOKIE["cedula"];
		//$menu = $this->db->configurar_menus_opciones($id);
		//include("html/body.php");
		//include("html/link.php");
		//include("html/footer.php");

		include("html/view_usuario/header_usuario.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_usuario/body_usuario.php");
		include("html/view_usuario/link_usuario.php");
		include("html/footer.php");
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
	
	
}