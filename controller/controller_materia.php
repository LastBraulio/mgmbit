<?php

require_once 'model/modelo_materia.php';
require_once ("library/configuracion.php");

class Controller_materia {
	private $modelo_materia;
	private $db;
	
	function __construct(){
		
        $this->modelo_materia = new Modelo_materia();
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

		include("html/view_materia/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_materia/body.php");
		include("html/view_materia/link.php");
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
		$tabla= $this->modelo_materia->mostrar_ajax();
		echo $tabla;
	}
	function ajaxtabla_grado(){
		$tabla= $this->modelo_materia->mostrar_ajax_grados();
		echo $tabla;
	}
	function get_perfiles()
	{
		$tabla= $this->modelo_materia->perfiles_ajax();
		echo $tabla;
	}
	function insert_m(){
		$data = array(
			"nom_materia"=>$_POST['InputNombrecss'],
			"puntaje"=>$_POST['InputPuntajecss'],
			"descripcion"=>$_POST['InputDescripcioncss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_materia->insert($data);
		echo $msn;
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		//echo $buscar;
		$data= $this->modelo_materia->getid($buscar);
		//
		$data1 = array(
			"nom_materia"=> $data[0]["nom_materia"],
			"puntaje"=> $data[0]["puntaje"],
			"descripcion"=> $data[0]["descripcion"]
		);
		//$edit=true;
		//include("form/materia/u_view_form_.php");
		//print_r($data1); exit;
		header('Content-type: application/json');
		echo json_encode( $data1 );
		//print_r( $data);
	}
	function edit1_grados()
	{
		$buscar = $_GET["id"];
		//echo $buscar;
		$data= $this->modelo_materia->getid_grados($buscar);
		//
		$data1 = array(
			"id_grado"=> $data[0]["id_grado"],
			"nombre_grado"=> $data[0]["nombre_grado"],
			"cant_est"=> $data[0]["cant_est"]
		);
		//$edit=true;
		//include("form/materia/u_view_form_.php");
		//print_r($data1); exit;
		header('Content-type: application/json');
		echo json_encode( $data1 );
		//print_r( $data);
	}
	function view1_grados()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_materia->getid_grados($buscar);
		
		$data = array(
			"id"=> $data[0]["id_grado"],
			"nombre"=> $data[0]["nombre_grado"],
			"cant"=> $data[0]["cant_est"]
		);
		//print_r($data); exit;
		include("form/grados/view_form_.php");
	}
	function view1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_materia->getid($buscar);
		
		$data = array(
			"nom_materia"=> $data[0]["nom_materia"],
			"puntaje"=> $data[0]["puntaje"],
			"descripcion"=> $data[0]["descripcion"]
		);
		//print_r($data); exit;
		include("form/materia/view_form_.php");
	}
	function update1_m()
	{
		$id=$_POST['InputID'];
		
		$data = array(
			"nom_materia"=> $_POST['InputNombrecss_u'],
			"puntaje"=> $_POST['InputPuntajecss_u'],
			"descripcion"=> $_POST['InputDescripcioncss_u']
		);
		//print_r($data); exit;
		$msn= $this->modelo_materia->update_m($id,$data);
		echo $msn;
	}
	public function update1()
	{
		$data1 = array(
			"nombre_perfil"=> $_POST['InputPerfilcss_u'],
			"cedula"=> $_POST['InputCedulacss_u']
		);
		//print_r($data); exit;
		$ids = $_POST['InpOPT'];
		$nuevoid = $this->modelo_materia->insert_perfil($data1);

		$msn= $this->modelo_materia->insert_perfil_usuario($nuevoid,$ids);
		echo $msn;
	}
	public function update2()
	{
		
		$ids = $_POST['InputCedulacss_u'];
		$perfil= $_POST['InputPerfilcss_u'];
		$idperfil= $_POST['InpOPT'];

		$this->modelo_materia->update_perfil_nombre($id,$perfil);

		$nuevoid = $this->modelo_materia->select_perfil_nombre($id);

		$msndelete = $this->modelo_materia->delete_menu_perfil_usuario($nuevoid);

		$msn = $this->modelo_materia->insert_perfil_usuario($nuevoid,$idperfil);

		echo $msn;
	}
	function update1_grados()
	{
		$id=$_POST['InputID'];
		$data = array(
			"nombre_grado"=>$_POST['InputPuntajecss_u'],
			"cant_est"=>$_POST['InputDescripcioncss_u']
		);
		//print_r($data); exit;
		$msn= $this->modelo_materia->update_grados($id,$data);
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
		$tabla= $this->modelo_materia->mostrar_ajax_conectado();
		echo $tabla;
	}
	public function error404()
	{
		include("html/header.php");
		include("html/error404.php");
		include("html/link.php");
		include("html/footer.php");
	}
	function delete1()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_materia->delete($id);
		echo $msn;
	}
	function delete1_grados()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_materia->delete_grados($id);
		echo $msn;
	}
	function insert1(){
		$data = array(
			"cedula"=>$_POST['InputCedulacss'],
			"nombre"=>$_POST['InputNombrecss'],
			"apellido_paterno"=>$_POST['InputAPcss'],
			"apellido_materno"=>$_POST['InputAMcss'],
			"edad"=>$_POST['InputEdadcss'],
			"direccion"=>$_POST['InputDircss'],
			"ocupacion"=>$_POST['InputOcccss'],
			"telefono_cel"=>$_POST['InputCelcss'],
			"telefono_oficial"=>$_POST['InputTelcss'],
			"email"=>$_POST['InputEmailcss'],
			"fecha_actual"=>$_POST['InputFechacss'],
			"tipo_cliente"=>$_POST['InputTipClientcss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_materia->insert($data);
		echo $msn;
	}
	function insert1_grados(){
		$data = array(
			"nombre_grado"=>$_POST['InputGradocss'],
			"cant_est"=>$_POST['InputCantidadncss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_materia->insert_grados($data);
		echo $msn;
	}

	
	
}