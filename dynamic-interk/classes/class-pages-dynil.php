<?php

/**
* @package Dyn Internal Links
* @since 1.0 
* Llamada de Paginas
*/
class Class_pages_dynil extends Class_dynil
{	
	/** 
	* @since 1.0
	* Intancia de clase.
	*/	
	public static $instance = null;


	/**
	* @since 1.0
	* Bajo que parametros se mostraran todas las paginas.
	*/
	public $criteria = array( );

	/**
	* @since 1.0
	* Paginas de exlusion
	*/	
	public $pages_exclude = array( );
	


	/**
	* @since 1.0	
	* Constructor de clase
	*/
	public function __construct(){			

	}	

	/**
	* @since 1.0
	* @return Esta clase $this	
	* Intanciacion de clase | Singleton
	*/
	public static function instance( ){

		if ( empty( self::$instance )){

			self::$instance = new self();
		}
		return self::$instance;

	}
	
	/**
	* @param string $arg Modo de entrega de los valores
	* @param string $value Valor de la entrega pre-establecida
	* Se creara un nuevo criterio para la muestra de las paginas.
	*/
	public function set_criteria( $arg , $value ){

		$this->criteria[ $arg ] = $value;

	}

	/**
	* @since 1.0	
	* @see https://codex.wordpress.org/Function_Reference/get_pages para mas info.* 	
	* Regresará un array con las páginas de el sitio
	* Se tomara en cuenta todas las determinaciones, establecidas en $criteria.
	* 
	*/
	public function get_all_pages( ){

		$this->exclude_woo_pages();		
		return get_pages( $this->criteria );	
		
	}	
	

	/** 
	* @since 1.0
	* @see this->criteria property
	* Excluir paginas de woocommerce
	*/
	public function exclude_woo_pages( ){

		if ( dynil_woo_exists() ){

			$woo_pages = array( 'shop', 'myaccount', 'checkout', 'cart' );

			for ( $i = 0; $i < count( $woo_pages ); $i++){
				$page_exclude[] = wc_get_page_id( $woo_pages[ $i ] );
			}
			$this->criteria['exclude'] = $page_exclude;			

		}
	}	
}


 ?>