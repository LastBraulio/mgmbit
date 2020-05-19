<?php

require_once ("model/modelo_periodo.php");
require_once ("library/configuracion.php");
require_once ("conexion/configdb.php");

class Controller_periodo {
	private $modelo_periodo;
	private $db;
	
	function __construct(){
		
        $this->modelo_periodo= new Modelo_periodo();
		$this->db = new Configuracion();
		
    }
	function index(){
		//$query =$this->model_e->get();
		include("html/view_periodo/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_periodo/body.php");
		include("html/view_periodo/link.php");
		include("html/footer.php");
    }
	function ajaxtabla(){
		$tabla= $this->modelo_periodo->mostrar_ajax();
		echo $tabla;
	}
	function get_tipo_cliente()
	{
		$tabla= $this->modelo_periodo->tipo_cliente_ajax();
		echo $tabla;
	}
	function insert(){
		$data = array(
			"periodo"=>$_POST['InputPeriodocss'],
			"ano_lectivo"=>$_POST['InputLectivoAnocss'],
			"fecha_inicio"=>$_POST['InputFechaInicss'],
			"fecha_final"=>$_POST['InputFechaFinalcss'],
			"descripcion"=>$_POST['InputDescripcioncss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_periodo->insert($data);
		echo $msn;
	}
	function view1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_periodo->getid($buscar);
		//print_r($data[0][1]); exit;
		$data = array(
			"periodo"=> str_replace(" ","",str_replace(","," ",$data[0]["periodo"])) ,
			"ano_lectivo"=> $data[0]["ano_lectivo"],
			"fecha_inicio"=> $data[0]["fecha_inicio"],
			"fecha_final"=> $data[0]["fecha_final"],
			"descripcion"=>  str_replace(" ","",str_replace(","," ",$data[0]["descripcion"])) 
		);
		//print_r($data); exit;
		include("form/periodo/view_form_.php");
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_periodo->getid($buscar);
		//print_r($data); exit;
		$data = array(
			"periodo"=> str_replace(" ","",str_replace(","," ",$data[0]["periodo"])) ,
			"ano_lectivo"=> $data[0]["ano_lectivo"],
			"fecha_inicio"=> $data[0]["fecha_inicio"],
			"fecha_final"=> $data[0]["fecha_final"],
			"descripcion"=>  str_replace(" ","",str_replace(","," ",$data[0]["descripcion"])) 
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
			"periodo"=>$_POST['InputPeriodocss_u'],
			"ano_lectivo"=>$_POST['InputLectivoAnocss_u'],
			"fecha_inicio"=>$_POST['InputFechaInicss_u'],
			"fecha_final"=>$_POST['InputFechaFinalcss_u'],
			"descripcion"=>$_POST['InputDescripcioncss_u']
		);
		//print_r($data); exit;
		$msn= $this->modelo_periodo->update($id,$data);
		echo $msn;
	}
	function delete1()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_periodo->delete($id);
		echo $msn;
	}
	public function error404()
	{
		include("html/header.php");
		include("html/error404.php");
		include("html/link.php");
		include("html/footer.php");
	}
	
}