<?php

require_once ("model/modelo_index.php");
require_once ("library/configuracion.php");
require_once ("config/configdb.php");

class Controller_index {
	private $modelo_cliente;
	private $db;
	
	function __construct(){
		
        $this->modelo_cliente= new Modelo_index();
		$this->db = new Configuracion();
		
    }
	function index(){
		include("view/view_index/view01.php");
		include("view/view_index/view_1.php");
    }
	
	public function error404()
	{
		include("html/header.php");
		include("html/error404.php");
		include("html/link.php");
		include("html/footer.php");
	}
	
}