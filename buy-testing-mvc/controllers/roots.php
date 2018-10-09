<?php 

class roots{

	private $routes = [];	

	public function add_route($route,$controller,$method){

		$this->routes[$method] = ["name"=>$route,"controller"=>$controller,"method"=>$method];

	}
	public function read_route($method){
		if (array_key_exists($method,$this->routes)) {
			return $this->routes[$method];
		}else{
			throw new Exception("La ruta '$method' no ha sido encontrada");			
		}
	}

	
}