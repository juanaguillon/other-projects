<?php 

/**
* Agrega elementos dinamicamente
*/ 
class elements
{
	
	public $elem = [];
	public $menu = [];


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
	// Agregar un nuevo menu, sin este, no se podra ejecutar correctamente add_to_menu().
	public function add_menu($id){

		$this->menu[$id] = [$id];


	}

	// Insertar un nuevo elemento para el menu
	// ID: Menu al que se añadira
	// Element: Elemento a añadir a el menu. 
	// ID Element: Valor único para el elemento a ser añadido.

	public function add_to_menu($id,$id_element,$element){

		// Verificar si existe el menu.
		if ( array_key_exists($id, $this->menu)) {
				// Verificar que el paramatreso $element sea un array
				if ( is_array($element)) {	
					// Verificar si el $id_element existe en el array de menu[$id]
					if ( ! array_key_exists($id_element,$this->menu[$id]) ) {
									
						$element["id"] = $id ."-". $id_element;
						if (empty($element["class"])) {
							$element["class"] = "li-menu-element"; 						 	
						 }else{
						 	$element["class"] = "li-menu-element " . $element["class"]; 	
						 } 
						$this->menu[$id][$id_element] = $element;
						
					}	
			}
		}else{
			// Lanzar excepttion de el menu $id no ha sido encontrado.
			throw new Exception("Menu - '$id': No encontrado.");
		}
	}


	// 
	public function get_menu($id,$class,$id_html=""){
		if ($id_html == "") {
			$id_html = $id;
		}
		$return = "<nav class='nav-menu $class' id='$id_html'><ul>";
		foreach ($this->menu[$id] as $k => $v ) { 
			if (is_array($v)) {
				$return .= "<li";	
				
				foreach($v as $key => $val){

					if ($key =="content") {
						continue;
					}					
					$return .= " $key='$val' ";
				}
				$return .= ">". $v["content"];
				$return .= "</li>";
			}

		}
		$return .= "</ul></nav>";
		return $return;
	}
	
}