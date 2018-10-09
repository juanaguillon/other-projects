<?php 

/**
* Operaciones necesitadas en los códigos.
*/
class operations
{	
	public function is_session(){
		if (isset($_SESSION["id"])) {
			return true;
		}else{
			return false;
		}
	}
		
	//Final de la clase operations 
}