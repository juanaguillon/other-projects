<?php 

/**
* Existing routes
*/
class routes
{
	private $routes = [];
	
	public function add_route($key){

		if ( array_key_exists($key, $this->routes)) {
			return;
		}else{
			$this->routes[$key] = $key;			
		}
	}

	public function get_route($key){
		if ( ! array_key_exists ( $key , $this->routes ) ) {
			throw new Exception("La ruta '".$key."', no ha sido encontrada.");
		}else{
			return $this->routes[$key];			
		}
	}
}