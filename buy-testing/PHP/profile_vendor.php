<?php 

// Entrada de update en caso de querer cambiar el usaruio a vendedor.
require_once '../PHP/clases.php';
send_home($_GET["ch_v"]);

$user_a = $_SESSION["username"];
// En caso que el proceso sea de independiente a compañia

if ($_GET["ch_v"]=="comp") {

	$type_sell = 'ind';
}else{
	$type_sell = 'comp';
}

	$s_up = "UPDATE profile_vendor SET type_sell= '$type_sell', last_update= NOW() WHERE id = '$user_a' ";
	$a_c = [':user'=>$user_a];

	// llamando la sentecia para hacer una consulta sin inyeccion
	// clases.php linea 47

	$c = new add_bd_with_inject;
	$reg = $c->select_table($s_up, false);

	if ($reg->rowCount()>0) {
		header('location:../SPHP/perfil_vendor?succ_c=true&perfil_vendor='.ID_SESION);
	}else{
		header('location:../SPHP/perfil_vendor?succ_c=false&perfil_vendor='.ID_SESION);
	}

 ?>