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
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("view/view_admin/container.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }
    function orders(){
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("view/view_orders/container.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }
    function new_orders(){
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("form/orders/new_orders.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }
    function invoices(){
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("view/view_admin/container.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }
    function notific(){
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("view/view_admin/container.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }
    function ntrack(){
		//include("view/view_admin/index.php");
		include("view/view_admin/header.php");
		include("view/view_admin/navlogin.php");
		include("view/view_admin/navbar.php");
		include("view/view_admin/container.php");
		include("view/view_admin/logout.php");
		include("view/view_admin/footer.php");
    }

    function login(){
    	//include("view/view_login/login.php");
    	include("view/view_login/view_login2.php");
    }
    function registro(){
    	//include("view/view_login/registro.php");
    	include("view/view_login/view_registro.php");
    }	
    function registro2(){
    	include("view/view_login/view_registro.php");
    }
	public function error404()
	{
		include("view/error404.php");
	}
	
}