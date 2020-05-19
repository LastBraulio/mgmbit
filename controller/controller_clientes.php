<?php

require_once ("model/modelo_cliente.php");
require_once ("library/configuracion.php");
require_once ("conexion/configdb.php");

class Controller_clientes {
	private $modelo_cliente;
	private $db;
	
	function __construct(){
		
        $this->modelo_cliente= new Modelo_cliente();
		$this->db = new Configuracion();
		
    }
	function index(){
		//$query =$this->model_e->get();
		include("html/view_cliente/header_cliente.php");
		$menu = $this->db->configurar_menus_opciones();
		include("html/view_cliente/body_cliente.php");
		include("html/view_cliente/link_cliente.php");
		include("html/footer.php");
    }
	function ejemplo1(){
		
		$arra = array(
			"titulo"=> "Esto es Un titulo",
			"cuerpo"=>"Esto es un cuerpo....."
		);
		include("html/view_cliente/view_cliente.php");
	}
	function insert(){
		$data = array(
			"country"=>$_POST['InputCountrycss'],
			"iso2"=>$_POST['InputISO2css'],
			"iso3"=>$_POST['InputISO3css'],
			"noc"=>$_POST['InputNOCcss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_cliente->insert($data);
		echo $msn;
	}
	function view1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_cliente->getid($buscar);
		//print_r($data); exit;
		$data = array(
			"country"=> $data[0]["country"],
			"iso2"=> $data[0]["iso2"],
			"iso3"=> $data[0]["iso3"],
			"noc"=> $data[0]["noc"],
		);
		include("form/view_form_country.php");
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_cliente->getid($buscar);
		//print_r($data); exit;
		$data = array(
			"country"=> $data[0]["country"],
			"iso2"=> $data[0]["iso2"],
			"iso3"=> $data[0]["iso3"],
			"noc"=> $data[0]["noc"],
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
			"country"=>$_POST['InputCountrycss'],
			"iso2"=>$_POST['InputISO2css'],
			"iso3"=>$_POST['InputISO3css'],
			"noc"=>$_POST['InputNOCcss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_cliente->update($id,$data);
		echo $msn;
	}
	function delete1()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_cliente->delete($id);
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



?>