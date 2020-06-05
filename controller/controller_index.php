<?php

require_once ("model/modelo_index.php");
require_once ("library/configuracion.php");
require_once ("config/configdb.php");

class Controller_index  {
	private $modelo_cliente;
	private $db;
	
	function __construct(){
		
        //$this->modelo_cliente= new Modelo_index();
		//$this->db = new Configuracion();
		
    } 
	function index(){
		//include("view/view_index/view01.php");
		include("view/view_index/head.php");
		include("view/view_index/navegador.php");
		include("view/view_index/index.php");
		include("view/view_index/footer.php");
		include("view/view_index/view_1.php");
    }
    
    function servicios(){
		//include("view/view_index/view01.php");
		include("view/view_index/head.php");
		include("view/view_index/navegador.php");
		include("view/view_servicios/servicios.php");
		include("view/view_index/footer.php");
		include("view/view_index/view_1.php");
    }
    function somos(){
		//include("view/view_index/view01.php");
		include("view/view_index/head.php");
		include("view/view_index/navegador.php");
		include("view/view_somos/somos.php");
		include("view/view_index/footer.php");
		include("view/view_index/view_1.php");
    }
    function contactos(){
		//include("view/view_index/view01.php");
		include("view/view_index/head.php");
		include("view/view_index/navegador.php");
		include("view/view_contactos/contactos.php");
		include("view/view_index/footer.php");
		include("view/view_index/view_1.php");
    }
	
	public function error404()
	{
		include("view/error404.php");
	}
	
}