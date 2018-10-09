<?php
require_once '../PHP/clases.php';

is_session();
$user = $_SESSION["username"];

if (isset($_POST["send_reg_vendor"])) {
 	$alt_name = $_POST["i_alt_name"];
 	$desc = $_POST["i_desc"];
 	$img_profile = $_FILES["img_profile"]['name'];
 	$type_sell = $_POST["type_vendor"];

 	// Busqueda de usuarion en la base de datos login, para ingresar el mismo id de el usuario.

 	

 	$n_user = USER_SESION;
 	$user_id = ID_SESION;
 	
 	$create_vendor_sql = "INSERT INTO profile_vendor (ID,USER,ALT_NAME,IMG_PROFILE,LEMA,TYPE_SELL,F_DATE, LAST_UPDATE) VALUES ('$user',:user,:alt_name,:img_profile,:lema,:type_sell,NOW(),NOW()) ";
 	$arr_i = array(":user" =>$n_user,":alt_name"=>$alt_name,":img_profile"=>$img_profile,":lema"=>
 		$desc,":type_sell"=>$type_sell);
 	$new_bd = new add_bd;
 	$reg_i = $new_bd->insert_table($create_vendor_sql,$arr_i);

 	if (($reg_i->rowCount())>0) {
 		$dir = '../resources/Users/'.$user_id;
 		mkdir($dir);
 		$dir_p = $dir . '/' . 'profile_img/';
 		mkdir($dir_p);
 		move_uploaded_file($_FILES["img_profile"]["tmp_name"], $dir_p . $img_profile);
 		header('location:../SPHP/perfil_vendor?r_true=true&perfil_vendor='. $user_id.'');
 	}else{
 		header('location:../SPHP/crear_vendedor?r_false=false');
 	}

} 


?>




