<?php

//require_once ("model/modelo_mgmbit.php");
require_once ("library/configuracion.php");
require_once ("config/configdb.php");

class Controller_index {
	private $modelo_cliente;
	private $db;
	
	function __construct(){
		
       // $this->modelo_cliente= new Modelo_index();
		//$this->db = new Configuracion();
		
    }
	function index(){
		include("view/view_admin/index.php");
    }
    function login(){
    	include("view/view_login/login.php");
    }	
	public function error404()
	{
		include("view/error404.php");
	}
	
}