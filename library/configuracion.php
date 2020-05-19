<?php

require_once "conexion/conexion.php";	

Class Configuracion extends Conexiones{
	
	public function configurar_menus_opciones($id){
		$sentencia = "select t1.* from menus t1, menu_perfil_usuario t2, usu_usuario_perfil t3, usuarios t4 where t1.id_menu = t2.id_menus 
		and t2.id_usuario_perfil = t3.id_usuario_perfil
		and t3.cedula = t4.cedula
		and t4.cedula = '$id'";

		$resultado = $this->pdo->prepare($sentencia);
		$resultado->execute();

		$html = "<!-- Nav Item - Pages Collapse Menu --><li class=\"nav-item\">";
			  
		//while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
		$arr = $resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach ($arr as $row) {
			if (!empty($row["id_menu"])){
				
				$html.= $row["tag_menu"];
				//echo $row["tag_menu"]; //exit;
				//var_dump($row); exit;
				$namecomponent= $row["nombre_menu"];
				$tagger = $row["tagger"];
				
				$sentencia = "select t1.* from submenu t1, menu_perfil_usuario t2, usu_usuario_perfil t3, usuarios t4 where t1.id_menu = t2.id_menus 
				and t2.id_usuario_perfil = t3.id_usuario_perfil
				and t3.cedula = t4.cedula
				and  t1.id_menu = ".$row["id_menu"]." 
				and t3.cedula = '". $id ."' ";
				
				//echo $sentencia; exit;

				$resultado = $this->pdo->prepare($sentencia);
				$resultado->execute();

				$html .= "<div id=\"$tagger\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						  <div class=\"bg-white py-2 collapse-inner rounded\">
							<h6 class=\"collapse-header\">".$namecomponent.":</h6>";
							
				while ($fila = $resultado->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
					$html.= $fila[2];
				}
				$html.="</div></div></li>";
			}
			$html .= "<!-- Nav Item - Pages Collapse Menu --><li class=\"nav-item\">";
		}
		//echo $datos;
		//$this->pdo=null;
		return $html;
	}
	
	public function upload($files){
		if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['file']['name'])){
		    $folder = 'C:/xampp/htdocs/Academico/uploads/';
		    //echo $folder; exit;
		    $threshold = count($_FILES['file']['name']);
		    for($i = 0; $i<$threshold; $i++){
		        $filename = $_FILES['file']['name'][$i];
		        $path = $folder.$filename;
		        if(strpos($filename,'.php') == true){
		            echo "Choose another FIle!";
		        }
		        elseif (strpos($filename,'.exe') == true){
		            echo "Choose another FIle!";
		        }
		        else {
		            if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$path)){
		                echo "File ".$i.' Uploaded Success! <br>';
		            }
		            else {
		                echo "File $i Upload Failed! :/";
		            };
		        };
		    };
		}else
		{
			echo "no se pudo adjuntar";
			die;
		}
	}
	
	
	
	
	
}
?>

