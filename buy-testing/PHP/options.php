<?php 


require_once 'functions.php';
is_session();
$user = $_SESSION["username"];

if(isset($_GET["see_password"]) && ($_GET["see_password"])){
	$input_text = $_GET["password"];	
	

	$password = PASSWORD_SESION;

	if (password_verify($input_text,$password)) {	
		echo 'ok';
	}else{
		echo 'no ok';
	}
	
}

if (isset($_GET["change_password"]) && $_GET["change_password"]) {
		$new_password = $_GET["new_password"];
		$p_veri = password_hash($new_password,PASSWORD_DEFAULT);
		$sql_change_password = "UPDATE login SET password = :new_password, last_f_date = NOW() WHERE id = '$user'";
		$update = $conect->prepare($sql_change_password);
		$update->execute(array(":new_password"=>$p_veri));
		$num_affected = $update->rowCount();
		if($num_affected >0){
			echo 'ok';
		}else{
			echo 'no ok';
		}
	}

if (isset($_GET['change_user']) && $_GET['change_user']) {
	$change_user = $_GET['new_user'];

	$sql_change_user = "SELECT user FROM login WHERE id = :user ";
	$array_change_user = array(":user"=>$change_user);
	$changereg = selectSqlinject($sql_change_user,$array_change_user,false);
	$num = $changereg->rowCount();
	if($num>0){
		echo 'no ok';
	}else {
		
		$sql_update_user = "UPDATE login SET user = :new_user, last_f_date = NOW() WHERE id = :user";
		$sql_update_user2 = "UPDATE product_post SET user = :new_user, last_f_date = NOW() WHERE id = :user";
		$arr_update = array(":new_user"=>$change_user,":user"=>$user);
		$up_reg = selectSqlinject($sql_update_user,$arr_update,false);
		$up_reg2 = selectSqlinject($sql_update_user2,$arr_update,false);
		$num_up = $up_reg->rowCount();
		$num_up2 = $up_reg2->rowCount();
		if ($num_up>0  && $num_up2>0) {
			echo 'ok';
			session_destroy();
		}else if ($num_up2>0) {
			echo 'ok post';
			session_destroy();
		}else if($num_up>0){
			echo 'ok login';
			session_destroy();
		}else{
			echo 'up no ok';
		}
	}
}

if (isset($_GET['change_email']) && $_GET['change_email']) {
	$new_email = $_GET['new_email'];

	$sql_change_email = "SELECT email FROM login WHERE email = :new_email";
	$arr_email = array(":new_email"=>$new_email); 
	$emailreg = selectSqlinject($sql_change_email,$arr_email,false);
	$num_mail = $emailreg->rowCount();

	if ($num_mail>0) {
		echo 'no ok';
	}else{
		$sql_update_email = "UPDATE login SET email = :new_email, last_f_date = NOW() WHERE id = :user";
		$arr_up_email = array(":new_email"=>$new_email,":user"=>$user);
		$up_reg_mail = selectSqlinject($sql_update_email,$arr_up_email,false);
		$num_mail_up = $up_reg_mail->rowCount();
		if ($num_mail_up>0) {
			echo 'ok';
		}else{
			echo 'no ok up';
		}
	}
}

if (isset($_GET['change_name']) && $_GET['change_name']) {
	$new_name = $_GET['new_name'];

	$sql_change_name = "UPDATE login SET name = :name, last_f_date = NOW() WHERE id = '$user'";
	$arr_change_name = array(":name"=>$new_name);
	$reg_up_name = selectSqlinject($sql_change_name,$arr_change_name,false);

	$num_name_up = $reg_up_name->rowCount();
	if ($num_name_up>0) {
		echo 'ok';
	}else{
		echo 'no ok';
	}


}

if (isset($_GET['change_lastname']) && $_GET['change_lastname']) {
	
	$new_lastname = $_GET['new_lastname'];
	$sql_change_lastname = "UPDATE login SET lastname = :lastname, last_f_date = NOW() WHERE id = '$user'";
	$arr_change_lastname = array(":lastname"=>$new_lastname);
	$reg_up_lastname = selectSqlinject($sql_change_lastname,$arr_change_lastname,false);

	$num_lastname_up = $reg_up_lastname->rowCount();
	if ($num_lastname_up>0) {
		echo 'ok';
	}else{
		echo 'no ok';
	}
}





?>