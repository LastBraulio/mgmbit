<?php

require_once 'model/modelo_matricula.php';
require_once ("library/configuracion.php");
require_once ("library/login.php");

class Controller_matricula {
	private $modelo_matricula;
	private $db;
	
	function __construct(){
		
        $this->modelo_matricula = new Modelo_matricula();
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

		include("html/view_matricula/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_matricula/body.php");
		include("html/view_matricula/link.php");
		include("html/footer.php");
    }
    function pmatricula(){

    	include("html/view_matricula/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_matricula/body.php");
		include("html/view_matricula/link.php");
		include("html/footer.php");

    }
    public function creargrado(){
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

		include("html/view_materia/header_grados.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_materia/body_grados.php");
		include("html/view_materia/link_grados.php");
		include("html/footer.php");
    }


	function ajaxtabla(){
		$tabla= $this->modelo_matricula->mostrar_ajax();
		echo $tabla;
	}
	function ajaxtabla_grado(){
		$tabla= $this->modelo_matricula->mostrar_ajax_grados();
		echo $tabla;
	}
	function get_perfiles()
	{
		$tabla= $this->modelo_matricula->perfiles_ajax();
		echo $tabla;
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		//echo $buscar;
		$data= $this->modelo_matricula->getid($buscar);
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
	function view1_grados()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_matricula->getid_grados($buscar);
		
		$data = array(
			"id"=> $data[0]["id_grado"],
			"nombre"=> $data[0]["nombre_grado"],
			"cant"=> $data[0]["cant_est"]
		);
		//print_r($data); exit;
		include("form/grados/view_form_.php");
	}
	public function update1()
	{
		$data1 = array(
			"nombre_perfil"=> $_POST['InputPerfilcss_u'],
			"cedula"=> $_POST['InputCedulacss_u']
		);
		//print_r($data); exit;
		$ids = $_POST['InpOPT'];
		$nuevoid = $this->modelo_matricula->insert_perfil($data1);

		$msn= $this->modelo_matricula->insert_perfil_usuario($nuevoid,$ids);
		echo $msn;
	}
	public function update2()
	{
		
		$ids = $_POST['InputCedulacss_u'];
		$perfil= $_POST['InputPerfilcss_u'];
		$idperfil= $_POST['InpOPT'];

		$this->modelo_matricula->update_perfil_nombre($id,$perfil);

		$nuevoid = $this->modelo_matricula->select_perfil_nombre($id);

		$msndelete = $this->modelo_matricula->delete_menu_perfil_usuario($nuevoid);

		$msn = $this->modelo_matricula->insert_perfil_usuario($nuevoid,$idperfil);

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
		$tabla= $this->modelo_matricula->mostrar_ajax_conectado();
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

	public function rubrica()
	{

        include("html/view_materia/header_grados.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_materia/body_grados.php");
		include("html/view_materia/link_grados.php");
		include("html/footer.php");

	}
	
	
}