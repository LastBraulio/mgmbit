<?php

require_once ("model/modelo_tareas.php");
require_once ("library/configuracion.php");


class Controller_tareas {
	private $modelo_tareas;
	private $db;
	
	function __construct(){
		
        $this->modelo_tareas= new Modelo_tareas();
		$this->db = new Configuracion();
		
    }
	function index(){
		//$query =$this->model_e->get();
		include("html/view_tareas/header.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_tareas/body.php");
		include("html/view_tareas/link.php");
		include("html/footer.php");
    }
	function ajaxtabla(){
		$id = $_COOKIE["cedula"];
		$tabla= $this->modelo_tareas->mostrar_ajax($id);
		echo $tabla;
	}
	function ajaxtabla_calendario(){
		$id = $_COOKIE["cedula"];
		$tabla= $this->modelo_tareas->mostrar_ajax_calendario($id);
		echo $tabla;
	}
	function ajaxtabla_tareas(){
		$tabla= $this->modelo_tareas->mostrar_ajax2();
		echo $tabla;
	}
	function ajaxtabla_tareas_evaluar(){

		$id = $_COOKIE["cedula"];
		$tabla= $this->modelo_tareas->mostrar_ajax_evaluar($id);
		echo $tabla;
	}
	function get_tipo_cliente()
	{
		$tabla= $this->modelo_tareas->tipo_cliente_ajax();
		echo $tabla;
	}
	function get_materia_profesor()
	{
		$id = $_COOKIE["cedula"];
		$tabla= $this->modelo_tareas->tipo_materia($id);
		echo $tabla;
	}
	function get_jornada_profesor()
	{
		$id = $_COOKIE["cedula"];
		$id_materia = $_GET["id"];
		$tabla= $this->modelo_tareas->tipo_jornada($id,$id_materia);
		echo $tabla;
	}
	function get_grado_profesor()
	{
		$id = $_COOKIE["cedula"];
		$id_materia = $_GET["id"];
		$tabla= $this->modelo_tareas->tipo_grado($id,$id_materia);
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
		$msn= $this->modelo_tareas->insert($data);
		echo $msn;
	}
	function insert_tarea(){
		$data = array(
			"id_grado"=>$_POST['InputGradocss'],
			"id_materia"=>$_POST['InputMateriacss'],
			"id_jornada"=>$_POST['InputJornadacss'],
			"nombre_tarea"=>$_POST['InputNombrecss'],
			"descripcion"=>$_POST['InputDescripcioncss'],
			"puntuacion"=>$_POST['InputPuntcss'],
			"cerrar_tarea"=>0,
			"fecha_entrega"=>$_POST['InputFechacss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_tareas->insert($data);
		echo $msn;
	}
	function insert_crear_nota(){

		$porcentaje = (((double)$_POST['InputCalificacioncss']) / ((double)$_POST['InputPcss'])) * 100 ;

		$data = array(
			"id_tarea"=>$_POST['InputIDcss'],
			"descripcion"=>$_POST['InputDescripcioncss'],
			"observacion"=>$_POST['InputObservacioncss'],
			"calificacion"=>$_POST['InputCalificacioncss'],
			"porcentaje"=>$porcentaje,
			"fecha_cal"=>$_POST['InputFechacss']
		);
		//print_r($data); exit;
		$msn= $this->modelo_tareas->insert_notas($data);
		echo $msn;
	}
	function view1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_tareas->getid($buscar);
		
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
		include("form/tareas/view_form_.php");
	}
	function kardes_tarea()
	{
		$buscar = $_GET["id"];
		$id = $_COOKIE["cedula"];
		$data= $this->modelo_tareas->getid($buscar,$id);
		
		$data = array(
			"id_tareas"=> $data[0]["id_tareas"],
			"nom_materia"=> $data[0]["nom_materia"],
			"title"=> $data[0]["title"],
			"descripcion"=> $data[0]["descripcion"],
			"puntuacion"=> $data[0]["puntuacion"],
			"start"=> $data[0]["start"],
			"nombre"=> $data[0]["nombre"]
		);

		include("html/view_tareas/header_kardes_tarea.php");
		
        $menu = $this->db->configurar_menus_opciones($id);
		include("html/view_tareas/kardes_tareas.php");
		include("html/link.php");
		include("html/footer.php");
	}
	function edit1()
	{
		$buscar = $_GET["id"];
		$data= $this->modelo_tareas->getid($buscar);
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
		$msn= $this->modelo_tareas->update($id,$data);
		echo $msn;
	}
	function update_tareas(){
		$id=$_POST['InputID'];
		
		$data = array(
			"cerrar_tarea"=> $_POST['Inputstatus'],
			"adjuntos"=> $_POST['exampleInputFile']
		);

		//print_r($data); exit;
		$msn= $this->modelo_tareas->update_tareas($id,$data);
		echo $msn;
	}
	function delete1()
	{
		$id=$_GET['id'];
		$msn= $this->modelo_tareas->delete($id);
		echo $msn;
	}

	public function calendario()
	{
       include("html/view_tareas/header_calendario.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_tareas/body_calendario.php");
		include("html/view_tareas/link_calendario.php");
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
	public function creartareas()
	{
		include("html/view_tareas/header_crear.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_tareas/body_crear.php");
		include("html/view_tareas/link_crear.php");
		include("html/footer.php");
	}
	public function evaluar_tareas()
	{
		include("html/view_tareas/header_evaluar.php");
		$id = $_COOKIE["cedula"];
		$menu = $this->db->configurar_menus_opciones($id);
		include("html/view_tareas/body_evaluar.php");
		include("html/view_tareas/link_evaluar.php");
		include("html/footer.php");
	}
	
}