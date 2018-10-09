<?php 

/**
* @package Dyn Internal Links
* @since 1.0
* Ejecuciones ajax.
*/
class Class_ajax_dynil extends Class_dynil
{
	/**
	* @since 1.0
	* Verificar existensia de id_ajax
	*/
	private $ajax = array();

	/**
	* @since 1.0
	* Instancia inical
	*/
	public static $instance = null;


	/** 
	* @since 1.0
	* @param $id_ajax: Nombre unico para ingresar un ajax
	* Crea un nombre unico para cada ajax con una accion.
	* Es necesario tambien crear un action único.
	*/

	public function __construct(){					
		$this->init();
	}
	

	/**
	* @since 1.0
	* Instanciador de clase.
	*/

	public static function instance(){

		if ( is_null(self::$instance )){
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	* @since 1.0
	* Funcion constructora de Clase.
	*/
	private function init(){

		$this->load_ajax();
		$this->hooks_actions();

	}
	

	/**
	* @since 1.0 
	* @param $function [string] 
	* @param $action [string | array ] El valor que sera ingresado en el array  
	* Si se ingresa un array, tomarse en cuenta que debe ser para ingresar a un hook.
	* Ingresar idenficiativo ajax a el array de Clase.
	* 
	*/
	public function set_ajax_request( $action, $func ){

		if ( is_string( $func ) || is_array( $func ) ){

			if ( ! array_key_exists($action, $this->ajax ) ){

				$this->ajax[ $action ] = $func;

			}			
		}
	}	
	

	/**
	* @since 1.0
	* @see set_ajax_request
	* Cargar AJAX para ejecucion */
	private function load_ajax(){
		include_once DYNIL_CLASSES . 'class-request-dynil.php';
		$this->set_ajax_request( 'show_pages' , array( Class_request_dynil::instance(), 'get_name_page' ) );
		$this->set_ajax_request( 'show_setting_page', array( Class_request_dynil::instance(), 'get_setting_pages' ) );
	}

	/**
	* @since 1.0
	* @see Hook - WP Directory/admin/admin-ajax.php
	* @see load_ajax Method
	* Ejecutar los ajax
	*/
	private function hooks_actions(){

		foreach ( $this->ajax as $action => $func ){

			add_action( 'wp_ajax_' . $action  , $func );
			add_action( 'wp_ajax_nopriv_' . $action , $func );
			
		}

	}
	
}
