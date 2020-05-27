<?php
	require_once('controller/controller_mgmbit.php');
	
	$controller= new Controller_index();
    
    if(!empty($_REQUEST['m'])){
        $metodo=$_REQUEST['m'];
        if (method_exists($controller, $metodo)) {
            $controller->$metodo();
        }else{
			if ($metodo == "index" or "")
			{
				$controller->index();
			}else{
				$controller->error404();
			}
        }
    }else{
        $controller->index();
    }


//Luis estubo aqui

?>