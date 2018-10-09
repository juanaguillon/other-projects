<?php 

/*
CREATE TABLE `codecs`.`schemes` ( `id` INT(15) NOT NULL AUTO_INCREMENT , `name` VARCHAR(250) NOT NULL , `comment` VARCHAR(250) NOT NULL , `author` VARCHAR(250) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
*/

define("MODEL","model/");
define("CONTROL","controllers/");
define("VIEW" , "view/");


require MODEL."connection.php";
require CONTROL . "routes.php";
require CONTROL . "new_routes.php";


try{
	

	if ( ! isset( $_GET["url"] ) || $_GET["url"] =="index.php") {
		$url = "index";
	}else{
		$url = $_GET["url"];
	}
	$method = $rout->get_route($url);

	require CONTROL . "elements.php";
	require CONTROL . "add_elements.php";
	require VIEW . "mains.php";
	require VIEW . $url . ".php";


	$main = new methods($head);
	$main->$method();


}catch(Exception $e){
	echo $e->getMessage();
}


 ?>