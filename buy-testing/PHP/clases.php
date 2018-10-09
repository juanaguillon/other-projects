<?php /**
* Clase para ingresar los datos a una table representativa
*/
require_once 'functions.php';


class add_bd
{
	
	
	// Inserta datos en una tabla
	public function insert_table($sql,$array)
	{
		global $conect;
		$prepare = $conect->prepare($sql);
		$prepare->execute($array);
		$return = $prepare;
		return $prepare;		

	}

	//Selecciona datos de una tabla

	public function select_table($sql,$array,$fetch = true)
	{

		global $conect;
		
		$prepare = $conect->prepare($sql);
		$prepare->execute($array);

		if ($fetch) {
			$return = $prepare->fetch(PDO::FETCH_ASSOC);
			return $return;

		}else{
			$return = $prepare;
			return $return;
		}

	}
} 

/**
* Insertar, y buscar datos en la tabla sin inyeccion. Consultas comunes
*/
class add_bd_with_inject
{
	
	function select_table($sql,$fetch = true)
	{	
		global $conect;

		$prepare = $conect->prepare($sql);
		$prepare->execute();

		if ($fetch) {
			$prepare->fetch(PDO::FETCH_ASSOC);

			$return = $prepare;
			return $prepare;
		}else{
			$return = $prepare;

			return $return;
		}
	}
}

/**
* Clases repetitivas, preferiblemente para demostrar la sesion, y acceder a funcionalidades
*/
class confirm_action
{

	// Si se aplica esta funcion en DETERMINADA PÁGINA, será necesario que este registrado como 
	// vendedor para poder acceder a la respectiva página
	
	function is_session(){	


		if (isset($_SESSION["username"])) {
			$user = $_SESSION["username"];
			$sql_find_v = "SELECT user FROM profile_vendor WHERE id = '$user'";
			$add_bd_without = new add_bd_with_inject;		
			$r = $add_bd_without->select_table($sql_find_v,false);		
		
			
			if ($r->rowCount()>0) {
			$return = true;
			}else{
			$return = false;
			}

			return $return;
		
	}
		
		
		
	}

	public function begin_session(){
		if (isset($_SESSION["username"])) {
			return true;
		}else{
			return false;
		}
	}
}

/**
* Clase para acceder a los productos publicados
*/
class products extends add_bd_with_inject
{
	
	 function products_exists()
	{
		$user = ID_SESION;
		$sql_products = "SELECT * FROM product_post WHERE cod_s = '$user' LIMIT 10";

		$a = $this->select_table($sql_products,false);		
		
		return $a;
		

	}

	private function return_products($where = "",$result = "")
	{
		global $conect;
		if ($where =="" && $result=="") {
			
			$sql = "SELECT * FROM product_post";

		}else{
			$sql = "SELECT * FROM product_post WHERE $where =  '$result'";
		}
			$prepare = $conect->prepare($sql);
			$prepare->execute();

			return $prepare;
	}

	

}
