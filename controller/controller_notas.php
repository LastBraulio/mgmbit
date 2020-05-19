<?php

require_once ("model/modelo_notas.php");
require_once ("library/configuracion.php");
require_once ("conexion/configdb.php");

class Controller_notas {
	private $modelo_notas;
	private $db;
	
	function __construct(){
		
        $this->modelo_notas= new Modelo_notas();
		$this->db = new Configuracion();
		
    }
	function index(){
		//$query =$this->model_e->get();
		include("html/view_notas/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_notas/body.php");
		include("html/view_notas/link.php");
		include("html/footer.php");
    }
	function ajaxtabla(){

		$id = $_COOKIE["cedula"];
		$tabla= $this->modelo_notas->mostrar_ajax($id);
		echo $tabla;
	}
	function get_tipo_cliente()
	{
		$tabla= $this->modelo_notas->tipo_cliente_ajax();
		echo $tabla;
	}
	function insert(){
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
		$msn= $this->modelo_notas->insert($data);
		echo $msn;
	}
	function view1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_notas->getid($buscar);
		
		$data = array(
			"cedula"=> $data[0]["cedula"],
			"nombre"=> $data[0]["nombre"],
			"apellido_paterno"=> $data[0]["apellido_paterno"],
			"apellido_materno"=> $data[0]["apellido_materno"],
			"edad"=> $data[0]["edad"],
			"direccion"=> str_replace(" ","",str_replace(","," ",$data[0]["direccion"])),
			"ocupacion"=> $data[0]["ocupacion"],
			"celular"=> $data[0]["celular"],
			"telefono"=> $data[0]["telefono"],
			"email"=> $data[0]["email"],
			"fecha_actual"=>$data[0]["fecha_actual"],
			"nombre_tipo"=> $data[0]["nombre_tipo"]
		);
		//print_r($data); exit;
		include("form/clientes/view_form_country.php");
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_notas->getid($buscar);
		//print_r($data); exit;
		$data = array(
			"cedula"=> $data[0]["cedula"],
			"nombre"=> $data[0]["nombre"],
			"apellido_paterno"=> $data[0]["apellido_paterno"],
			"apellido_materno"=> $data[0]["apellido_materno"],
			"edad"=> $data[0]["edad"],
			"direccion"=> str_replace(" ","",str_replace(","," ",$data[0]["direccion"])),
			"ocupacion"=> $data[0]["ocupacion"],
			"celular"=> $data[0]["celular"],
			"telefono"=> $data[0]["telefono"],
			"email"=> $data[0]["email"],
			"fecha_actual"=>$data[0]["fecha_actual"],
			"nombre_tipo"=> $data[0]["nombre_tipo"]
		);
		//$edit=true;
		//include("form/view_form_country.php");
		header('Content-type: application/json');
		echo json_encode( $data );
		//print_r( $data);
	}
	function update1()
	{
		$id=$_POST['InputID'];
		
		$data = array(
			"cedula"=> $_POST['InputCedulacss_u'],
			"nombre"=> $_POST['InputNombrecss_u'],
			"apellido_paterno"=> $_POST['InputAPcss_u'],
			"apellido_materno"=> $_POST['InputAMcss_u'],
			"edad"=> $_POST['InputEdadcss_u'],
			"direccion"=> $_POST['InputDircss_u'],
			"ocupacion"=> $_POST['InputOcccss_u'],
			"telefono_cel"=> $_POST['InputCelcss_u'],
			"telefono_oficial"=> $_POST['InputTelcss_u'],
			"email"=> $_POST['InputEmailcss_u'],
			"fecha_actual"=>$_POST['InputFechacss_u'],
			"tipo_cliente"=> $_POST['InputTipClientcss_u']
		);
		//print_r($data); exit;
		$msn= $this->modelo_notas->update($id,$data);
		echo $msn;
	}
	function delete1()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_notas->delete($id);
		echo $msn;
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
	public function tablacalif()
	{
		include("html/view_notas/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_notas/body.php");
		include("html/view_notas/link.php");
		include("html/footer.php");
	}
	
}