<?php 

/**
* Usuarios modo compra
*/
class user_sells extends connect
{
	
	public function __construct()
	{
		parent::__construct();		
		
	}

	private function sql($sql,$array,$returning=true){

		// Esta funcion añadira el array para seguridad.
		// Intentara insertar datos en la tabla, a su vez de manera segura con marcadores.
		$prp = $this->connect->prepare($sql);
		$prp->execute($array);
		if ($returning) {
			// Si *returning* es verdadera volvera el array asociativo con las tables
			$ret = $prp->fetch(PDO::FETCH_ASSOC);		
		}else{
			// En caso contrario, retornará la variable a iniciar el array asociativo
			$ret = $prp;
		}
		return $ret;

		$prp->closeCursor();
	}
	public function registro($email,$pass,$name,$lastn){

		$sql = "INSERT INTO LOGIN (email,name,lastname,password,f_date,last_f_date) VALUES (:email,:name,:lastname,:password,NOW(),NOW())";
		$password = password_hash($pass,PASSWORD_DEFAULT);
		$arr = [":email"=>$email,":name"=>$name,":lastname"=>$lastn,":password"=>$password];
		return $this->sql($sql,$arr,false);


	}
	public function ver_uso($email){

		$sql = "SELECT email FROM login WHERE email=:email";
		$arr = [":email"=>$email];
		$ver=$this->sql($sql,$arr,false);

		if ($ver->rowCount()>0) {
			return false;
		}else{
			return true;
		}
	}	

	public function ingreso($email,$password){
		//Instrucciones para el ingreso, e inicio de sesion. 

		$sql = "SELECT password,id FROM login WHERE email = :email";
		$arr = [":email"=>$email];
		$adb = $this->sql($sql,$arr,false);
		
		// En caso de encontrar la contraseña con el email proporcionado, verificar si coincide con el hash creado en el registro.
		if ($adb->rowCount()>0) {
			$ing = $adb->fetch(PDO::FETCH_ASSOC);
			$pass_v = $ing["password"];
			if (password_verify($password,$pass_v)) {
				return $ing["id"];
			}else{
				return false;
			}
		}
	}
}



