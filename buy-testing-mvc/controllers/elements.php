<?php 

/**
* Agrega elementos dinamicamente
*/ 
class elements
{
	
	public $elem = [];


	// Ingresar un nuevo elemento simple
	// Elementos simples como "Input, buttons, spans...".
	public function add_element($kind,$el,$class){
		$this->elem[$kind] = ["element"=>$el,"class"=>$class];

		if ($class==null) {
			unset($this->elem[$kind]["class"]);
		}
		
	}

	// Obtener un elemento simple
	
	public function get_element($kind,$add=[]){
		
		if (array_key_exists($kind, $this->elem)) {
			$var = $this->elem[$kind];

			if (array_key_exists("class",$var)) {
				$fclass = $var["class"];
			}

			if (!empty($add)) {
				if (array_key_exists("class",$add)) {
					$add["class"] =  $fclass." ".$add["class"]; 
				}
				$var = array_merge($this->elem[$kind],$add);

			}

			// Secuencia para ingresar dinámicamente nuevos propiedades en las etiquetas HTML 
			$return = "<".$var["element"];
			foreach ($var as $key => $value) {
				if ($key=="element" || $key=="content") {
					continue;
				}
				$return.= " $key='$value'";
			}
			$return.= ">";

			if (array_key_exists("content",$var)) {
				for ($i=0; $i <count($var["content"]) ; $i++) { 

					if (!is_array($var["content"])) {
						$return .= $var["content"];
					}else{
						$return .= $var["content"][$i];
					}
					
				}
				
			}
			$return .= "</".$var["element"].">";	

			return $return;

		}else{
			throw new Exception("El tipo de elemento '$kind' no se ha encontrado");
		}
	}

	// Insertar elementos dentro de otro nuevo.
	// Al igual que crear elementos, se puede añadir nuevas propiedades HTML a cada elemento con un array Asosiativo en el parametro $add.
	public function insert_element($element,$parent=["element"=>"div","class"=>"body_into"],$add=[]){
		
		$return = "<" . $parent["element"] . " class='".$parent["class"] ."'";
		
		if (!empty($add)) {
			$parent = array_merge($parent,$add);

			foreach ($parent as $key => $value) {
			if ($key == "element") {
				continue;
			}
			$return.= " $key='$value'";
		}
		}
		
		$return.=">".$element ."</".$parent["element"].">";
		
		return $return;		
		
	}

	
}