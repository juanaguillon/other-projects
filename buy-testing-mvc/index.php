<div class="xx">
	
</div>

<?php 

define("CONT","controllers/");
define("PUBL","public/");
define("MODEL","models/");

// Añadir rutas (URL) dinámicamente
require(CONT . "roots.php");
require(CONT . "add-routes.php");


try{	
	$url = $_GET["url"];	
	

	$action = $roots->read_route($url);
	$action->
	// Añadir elementos dinámicamente
	require("include_files.php");
	require(CONT . "elements.php");
	require(CONT . "add-elements.php");
	$action->
	require(PUBL . "view/".$url.".php");
	// Añadir elementos a el html dinámicamente
	require(PUBL . "view/mains.php");	
	
	// Se comienza a añadir archivos con relación a base de datos	
	$control_name = $action["controller"];
	$method = $action["method"];
	$named = $action["name"];

	$mains = new $control_name($headers,$named);
	$mains->$method();	
	

}catch(Exception $e){
	echo $e->getMessage();
}






