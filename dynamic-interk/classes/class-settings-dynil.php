<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 * Pagina settings de plugin
 * Esta pagina, sera la encargada de configurar las paginas que se han creado, en el panel de administracion del plugin
 */
class Class_settings_dynil extends Class_dynil
{


  /** 
  * @since 1.0
  * Instancia de clase
  */
	private static $instance = null;

	/** 
	* @since 1.0
	* @see content_settings method.
	*
	* Contenido html de esta clase.
	*/
	private static $content = null; 

	/**
	 * @since 1.0
	 * Instancia de clase
	 */


	private $notice = null;

	private $current_message = false;


	public static function instance(){
		if ( self::$instance == null ){
			self::$instance = new self();
			
		}
	
		return self::$instance;
	}


	public function __construct( ){

		include_once DYNIL_CLASSES . 'class-content-settings-dynil.php';
		static::$content = Class_content_settings_dynil::instance();		
		$this->process_request();
		$this->init_hooks();
		if( dynil_is_insert_page() ){
			$this->scripts();
			$this->enqueue_scripts();
		}
	}

	public function process_request(){

		if( isset( $_POST['interk_structures'] ) ){
			$this->insert_structure();
		}
		if( isset( $_POST['inserting'] ) )  {
			$this->insert_pages();
		}
		if( isset( $_POST['sending_topping_page']) ){
			$this->set_topping_page();
		}

		
	}
	
	public function scripts(){
		$this->import_script( dynil_script_path('ajax-request','js'),'ajax_request','admin' );
		$this->import_script( dynil_script_path('settings' , 'js' ), 'settings_javs', 'admin' );
		$this->import_script( dynil_script_path('admin-settings' , 'js' ), 'admin_settings', 'admin' );
		$this->import_style( dynil_script_path('settings-style','css'),'settings_stiles','admin');
	}


	private function notice_messages(){

		$this->notice = array( 
			"pages_inserted" => array(
				"message" => __('The pages have been inserted successfully.','dynil'),
				"class"   => 'notice notice-success'
			),
			"pages_unset" => array(
				"message" => __('An error ocurred while inserted the pages. Try again.','dynil'),
				"class"   => 'notice notice-error'
			)			
		);		
	}

	public function content_settings(){
		
		?>
		<div class="wrap dynil_form_insert_pages">
		<form action="" name="form_insert_pages" method="post">			
			<?php 
			if( get_option( 'dynil_set_pages' ) ){
				static::$content->content_the_pages();
				
			}else{
				static::$content->pages_not_found();
			}
			?>
		</form>	
		</div>
		<?php
	}

	public function insert_structure(){
		
		$ins = $_POST['interk_structures'];

		if( update_option('dynil_structure_html', $ins) ){
			$this->current_message = true;
		}
		
	}

	public function insert_pages(){
		
		if( $this->notice == null ) $this->notice_messages();
	
		$insertings = $_POST['inserting'];	
		$orderies = $_POST['priority_vals'] ;
		$cout = array();
		foreach ( $insertings as $index => $insert ){
			if( ! empty ($orderies) ){

				if( array_key_exists( $index , $orderies ) ){
					$cout[ $insert ] = $orderies[ $index ];
				}else{
					$cout[ $insert ] = '';
				}
			}
		}

		if( update_option( 'dynil_inserted_pages', $cout ) ){
			$this->current_message = true;			
		}	
		

	}
	public function set_topping_page(){
		$page = $_POST['dynil_top_selected'];

		$all_page = get_option('dynil_set_pages');
		$new_arr = [];
		
		foreach ( $all_page as $order ){
			if( $order == $page ){
				$new_arr[ $order ] = '0'; 
				continue;
			} 
			$new_arr[ $order ] = '';
		}

		$new_arr = array( $page => $new_arr[$page] ) + $new_arr;
		
		update_option('dynil_inserted_pages', $new_arr );
	}

	public function init_hooks( ){
		add_action('admin_notices',array( $this , 'show_message' ) );
	}
	
	public function show_message( ){
		$notice = $this->current_message ? $this->notice['pages_inserted']: $this->notice['pages_unset'];

		echo dynil_wrap_content("<p>" . $notice['message'] . "</p>", [ "class" => $notice['class'] ] ) ;

	}



}