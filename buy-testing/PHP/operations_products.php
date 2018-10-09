<?php 
require_once 'clases.php';
// Ingresar productos favoritos a la base de datos.


if (isset($_GET["add_p"]) && $_GET["name_p"]) {

	$sess = new confirm_action;
	if($sess->begin_session()){
		// Se iniciará este codigo en caso de encontrar la sesion inciaada.

		$name_product = $_GET["name_p"];
		$id_product = $_GET["add_p"];
		$image = $_GET['img_p'];
		$sume = $id_product . ID_SESION;

		$adding = new add_bd;

		$sql_sume = "SELECT id FROM product_inf WHERE sume= :sume";
		$arr_sume = array(":sume"=>$sume);
		$rr= $adding->select_table($sql_sume,$arr_sume,false);

		if ($rr->rowCount()>0) {
			echo 'still add';
		}else{

			// Si este producto no se ha seleccionado como "Favorito", se ejecutará el seiguiente código

			$sql_i_fav =  "INSERT INTO product_inf (cod_p,cod_user,f_date,name_product,image,sume) VALUES (:id_product,".ID_SESION.",NOW(),:name_product,:img_p,'$sume')";
			$arr_i_fav = array(":id_product"=>$id_product,":name_product"=>$name_product,":img_p"=>$image);
			$reg = $adding->select_table($sql_i_fav,$arr_i_fav,false);

			if ($reg->rowCount()>0) {
				echo 'add to favorite';
			}else{
				echo 'error';
			}
		}		

	}else{
		echo 'no sesion';
	}
}


