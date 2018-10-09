<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 *
 * Peticiones creadas, tanto ajax como posts admins.
 */
class Class_request_dynil 
{

	/** 
	* @since 1.0
	* Instancia de clase
	*/
	private static $instance = null;

	/** 
	* @since 1.0
	* Obtener instancia de la clase | Singleton Function
	*/

	public static function instance( ){
		if ( self::$instance == null ){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/** 
	* 
	* @since 1.0 
	* Regresar un el nombre de la pagina
	*/
	public function get_name_page( ){

		global $wpdb;
		$name = $_POST['name'];		
		$sql = "SELECT ID, post_title, post_date FROM {$wpdb->posts} WHERE post_title LIKE '%{$name}%' AND post_type = 'page' ";
		$resultes = dynil_create_wpdb( $sql );

		foreach ( $resultes as $result ) {
			$html_ret = '<span class="dyn_ajax_title">' . $result->post_title . '</span>';
			$html_ret .= '<input type="hidden" class="dyn_ajax_id" value="' . $result->ID . '" >';
			$html_ret .= '<input type="hidden" class="dyn_ajax_date" value="' . $result->post_date . '" >';
			echo dynil_wrap_content( $html_ret , array(
				'class' => 'names_pages'
			) );
		}
		die();
	}

	/**
	* @since 1.0
	* Funcion de llamada para las paginas establecidas por el usuario.
	* Se usará, para mostrar las paginas establecidas por el usuario en la pagina de ajustes ( Version 1.0 )
	*/
	public function get_setting_pages(){
		global $wpdb;
		$name = $_POST['name'];
		$pages_settings = get_option( 'dynil_set_pages' );
		$pages_settings = implode( ',' , $pages_settings );
		$sql = "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_title LIKE '%{$name}%' AND ID IN ({$pages_settings})";
		$results = dynil_create_wpdb( $sql );
		
		// Bucle mostrando los resultados
		foreach( $results as $result ){
			$html_ret = '<span class="dyn_ajax_title">' . $result->post_title . '</span>';
			$html_ret .= '<input type="hidden" class="dyn_ajax_id" value="' . $result->ID . '" >';
			
			echo dynil_wrap_content( $html_ret , array(
				'class' => 'names_pages'
			) );
		}
		
		die();
	}

	/** 
	* @since 1.0
	* Actualizara opciones y redirigira a el admin page.
	*/
	public function save_pages(){
		
		$set_pages = $_POST["dyn_table_checks"];
		update_option('dynil_set_pages',false);
		update_option( 'dynil_inserted_pages' , false );
		if( update_option('dynil_set_pages', $set_pages ) ){
			wp_redirect( admin_url('admin.php?page=dynil_menu_admin&update_pages=true') );			
		}else{
			wp_redirect( admin_url('admin.php?page=dynil_menu_admin&update_pages=false') );
		}
		
	}

	
}

