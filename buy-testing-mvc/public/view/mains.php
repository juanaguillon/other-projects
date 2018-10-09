<?php 


/**
* Main Controllers
*Asignacion de rutas urls

*op = clase operations.php
*header_pr = Menú de navegación principal
*body_all: Estructura html, asignada como el hijo de la etiqueta "body"
*modal: Ventana modal.
*/
class mains
{
	// Asignacion de propiedades de la clase
	protected $header_pr,$body_all,$modal,$op;
	
	// Asignacion de constructor de la clase
	public function __construct($headers,$title){

		// Asignacion de variables globales del script. (Flujo entero del host)
		global $header_pr,$body_all,$modal,$op;	

		// Asignacion de propiedades como variables globales
		$this->header_pr = $header_pr;
		$this->body_all = $body_all;
		$this->modal = $modal;		
		$this->op = $op;

		// Estructura html como principio en toda página
		echo "<!DOCTYPE html><html><head><meta charset='utf-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><title>$title - OpenCol</title><link rel='stylesheet' href='public/css/nav_primary.css'><script src='public/js/jquery.js'></script>$headers</head><body></body></html>";
		echo $this->header_pr;

		if (isset($_GET["close_session"])) {
				session_destroy();
				header('location:home');
		}
	}
	

	public function home(){
		echo $this->body_all;
	}
	public function registrer(){
		if($this->op->is_session()){
			header("location:home");
		}
		echo $this->body_all;
		echo $this->modal;		

	}
	public function login(){
		if($this->op->is_session()){
			header("location:home");
		}
		echo $this->body_all;

	}
	public function reg_sell(){
		echo $this->body_all;
	}
}


// Final de la clase
// Los headers serán los: metas, styles, scripts, links. Todo aquello que vá dentro del head.
$headers = "";
if (isset($styles)) {
	for ($i=0; $i <count($styles) ; $i++) { 
		$headers .= $elements->get_element("linka",["href"=>PUBL . "css/".$styles[$i].".css","type"=>"text/css","rel"=>"stylesheet"]); 
	}
}

if (isset($scripts)) {
	for ($i=0; $i <count($scripts) ; $i++) { 
		$headers .= $elements->get_element("scripta",["src"=>PUBL . "js/".$scripts[$i].".js"]); 
	}
}


