<?php 

require_once 'functions.php';
$user = $_SESSION["username"];

if (isset($_POST["title"])) {

		$alt_name = ALT_VENDOR;

		$img=[];
		$uping = [];
		/*Recorriendo todas las imagenes.*/
		for ($i=1; $i <6 ; $i++) { 
			if(($_FILES["img_".$i]["name"])!=""){
				$img[$i-1] = $_FILES["img_".$i]["name"];
				$uping[$i-1] = $_FILES["img_".$i]["tmp_name"];
			}else{
				break;
			}		
		}

		if (count($img)<1) {
			$folder = false;
		}else{
			$folder = true;
		}
		/*Seleccionando Variables para instertar en la base de datos*/
		$title = $_POST["title"];
		$description = $_POST["description"];
		$user = $_SESSION["username"];
		$date = date('ymdHis');
		$n_user = USER_SESION;
		if ($folder) {	
			$path_folder = $date.rand(10000,99999).$user;
			$dir = '../resources/Users/'.$user.'/'.$path_folder;
			if (!file_exists($dir)) {			
				mkdir($dir);
			}else{
				$date = date('ymdHis');
				$path_folder = $date.rand(10000,99999).$user;
				mkdir($dir);
			}	
			
			for ($i=0; $i <count($img) ; $i++) { 
				move_uploaded_file($uping[$i],$dir.'/'.'000'. $i . $img[$i]);
			}	
		}else{
			$path_folder = "No Folder";
		}

		
		$sql = "INSERT INTO product_post (cod_s,title,f_date,user,alt_name,description,folder,last_f_date) VALUES (:cod_s,:title,NOW(),:user,:alt_name,:description,:folder,NOW())";
		$array = array(":cod_s"=>$user,":title"=>$title,":user"=>$n_user,":alt_name"=>$alt_name,":description"=>$description,":folder" => $path_folder);
		$ex = insertSql($sql,$array);

		/*CODIGO PARA INGRESAR LA IMAGEN HECHA EN CANVAS*/



		if ($ex >0 && $folder) {
			echo 'Se ha logrado crear el producto,puedes crear un nuevo producto.'; 
		}else if ($ex >0) {
			echo 'Se ha logrado crear el producto, sin ninguna imagen. Ten en cuenta que no has añadido imagenes a tu producto. Ahora, ¡Crea otro producto!';
		}else{
			echo 'Ha ocurrido un error. Intenta de nuevo';
		}


		// Este código se genera para el proceso deingresar la imagen de canvas.
}if (isset($_REQUEST["image64"])){	
			
			$f_rig = '../resources/Users/'.$user;
			$folder_dir = scandir($f_rig,SCANDIR_SORT_DESCENDING);
			$path_folder = $folder_dir[1];
			$canvas = $_REQUEST["image64"];			
			$remove = substr($canvas,strpos($canvas,','));
			$img = base64_decode($remove);
			$open = fopen($f_rig.'/'.$path_folder . '/profile_product.jpg','wb');
			fwrite($open,$img);
			fclose($open);
			echo "Imagen creada en canvas";

		}
?>