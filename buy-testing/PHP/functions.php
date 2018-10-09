<?php 
	
	try {

	// Agregando la conexion de la base de datos.

	$conect=new PDO('mysql:host=localhost;dbname=proyecto','root','');
	$conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$conect->exec('SET CHARACTER SET utf8');

	// CREATE TABLE IF NOT EXISTS `login` ( `id` INT(150) NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `lastname` VARCHAR(200) NOT NULL , `user` VARCHAR(200) NOT NULL , `password` VARCHAR(100) NOT NULL , `f_date` DATE NOT NULL , `last_f_date` DATE NOT NULL , `email` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

	// CREATE TABLE IF NOT EXISTS `product_post` ( `id` INT(100) NOT NULL AUTO_INCREMENT , `cod_s` INT(100) NOT NULL , `user` VARCHAR(200) NOT NULL , `title` VARCHAR(100) NOT NULL , `description` TEXT NOT NULL , `alt_name` VARCHAR(200) NOT NULL , `f_date` DATE NOT NULL , `last_f_date` DATE NOT NULL , `folder` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

	// CREATE TABLE IF NOT EXISTS`profile_vendor` ( `alt_name` VARCHAR(200) NOT NULL , `id` INT(100) NOT NULL , `img_back` VARCHAR(200) NOT NULL , `img_profile` VARCHAR(200) NOT NULL , `last_update` DATE NOT NULL , `lema` VARCHAR(200) NOT NULL , `type_sell` VARCHAR(50) NOT NULL , `user` VARCHAR(200) NOT NULL , UNIQUE (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

	
	
} catch (Exception $e) {
	die($e->getMessage());
}
	session_start();


	// Consulta buscando registros de el usuario en sesion

	if (isset($_SESSION["username"])) {

		$user_prin = $_SESSION["username"];

		$prin_con_log = "SELECT * FROM login WHERE id= '$user_prin' ";
		$prepare_prin = $conect->prepare($prin_con_log);
		$prepare_prin->execute();
		$reg_prin = $prepare_prin->fetch(PDO::FETCH_OBJ);

		// Definiendo constantes con los datos registrados

		define('ID_SESION',$user_prin);
		define('USER_SESION',$reg_prin->user);		
		define('NAME_SESION',$reg_prin->name);
		define('LASTNAME_SESION',$reg_prin->lastname);
		define('EMAIL_SESION',$reg_prin->email);
		define('PASSWORD_SESION',$reg_prin->password);

		$prepare_prin->closeCursor();

		$prin_con_prof = "SELECT * FROM profile_vendor WHERE id= '$user_prin' ";
		$prepare_second = $conect->prepare($prin_con_prof);
		$prepare_second->execute();
		$reg_second = $prepare_second->fetch(PDO::FETCH_OBJ);

		if ($prepare_second->rowCount()>0) {			
			define('ALT_VENDOR',$reg_second->alt_name);
			define('IMG_VENDOR',$reg_second->img_profile);
			define('TYPE_VENDOR',$reg_second->type_sell);
		}

		$prepare_second->closeCursor();
	}
	

	function insertSql($sql,$array)
	{
		global $conect;
		$prepare=$conect->prepare($sql);
		$execute=$prepare->execute($array);
		$return = $prepare->rowCount();
		return $return;
	}
	function selectSql($sql)
	{
		global $conect;
		$prepare=$conect->prepare($sql);
		$prepare->execute();
		$return = $prepare->fetch(PDO::FETCH_ASSOC);
		return $return;
	}

	function selectSqlinject($sql,$array,$fetch = true ){
		global $conect;
		$prepare=$conect->prepare($sql);
		$prepare->execute($array);
		if ($fetch) {
			$return = $prepare->fetch(PDO::FETCH_ASSOC);
			return $return;
		}else{
			$return  = $prepare;
			return $return;
		}
	}

	function not_session()
	{
		if (isset($_SESSION["username"])) {
			header('location:../SPHP/i_home');
		}
	}
	function is_session()
	{
		if (!isset($_SESSION["username"])) {
			header('location:../SPHP/ingresar');
		}
	}
	function add_footer()
	{
		include_once '../SPHP/anexed_items/footer.php';
	}

	function send_home($isset)
	{
		if (!isset($isset)) {
			header('location:../sphp/i_home');
		}
	}




?>