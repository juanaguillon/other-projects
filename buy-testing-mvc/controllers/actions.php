			
<?php 

chdir(dirname(__DIR__));

require("models/connect.php");
require("models/user_sells.php");

$user = new user_sells;
if (isset($_GET["registrer"])) {
	if ($_GET["registrer"]=="new_user") {

		// Agregando variables del formulario
		$name = $_POST["reg_name"];
		$lastname = $_POST["reg_ap"];
		$email = $_POST["reg_email"];
		$pass = $_POST["reg_pass"];

		if($user->ver_uso($email)){
			// Se ejecutará el registro si está el email disponible
			$reg = $user->registro($email,$pass,$name,$lastname);
			if ($reg->rowCount()>0){
				
				echo "ok";
			}else{
				echo "Ha ocurrido un error. Intenta nuevamente.";
			}
		}else{
			echo "Email no disponible";			
		}
	}		
}
if (isset($_GET["login"])) {		

	// Idenficando variables para el ingreso de usuarios.
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	
	$db = $user->ingreso($email,$pass);
	if (!$db) {
		echo "Email o contraseña incorrecta";
	}else{
		session_start();
		$_SESSION["id"] = $db;
		echo "ok";		
	}		
}	