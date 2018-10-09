<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* @since 1.0
*	Interfaz de usuario, capaz de dar las ordenes correspondientes para acomodar el plugin de manera deseada.
* En esta clase, se creara la estructura general de la seccion de administrador de plugin.
* Tanto como estilos, scripts, y estructura.
* 
*/
class Class_admin_dynil extends Class_dynil
{
	
	/** 
	* @since 1.0
	* Intancia de clase
	*/
	public static $intance = null;


	/** 
	* @since 1.0
	* Seccion de noticias para ser mostradas en admin_notices
	*/
	public $notices = array();

	private static $content = null;

	/**
	* @since 1.0
	* Intanciacion de clase
	*/
	public static function instance(){

		if( self::$intance === null ){
			self::$intance = new self();
		}
		return self::$intance;
	}

	/**
	* @since 1.0
	* Constructor
	*/
	public function __construct(){
		
		include_once DYNIL_CLASSES . 'class-content-admin-dynil.php';
		static::$content = Class_content_admin_dynil::instance();
		$this->hooks_actions();

		if( $_GET["page"] == 'dynil_menu_admin' ){
			$this->scripts();		
			$this->enqueue_scripts();						
		}	

	}

	/** 
	* @since 1.0
	* Importar scripts de esta clase
	*/
	private function scripts( ){	

		$this->import_script( dynil_script_path( 'ajax-request' , 'js' ) , 'ajax-request' , 'admin' );
		$this->import_script( dynil_script_path('tables-request', 'js' ) , 'tables-request' ,'admin' );
		$this->import_script( dynil_script_path( 'admin-script' , 'js' ) , 'admin-script' , 'admin' );
		$this->import_style( dynil_script_path( 'admin-style' , 'css'), 'admin-style' , 'admin' );	

	}	



	/**
	* @since 1.0
	* Contenido de plugin en la seccion de Admin.
	*/
	public function content_admin(){
		$content = static::$content;
		?>
		
		<div class="wrap dynil_content_options">
			<h1><?php _e('Internal Link Options', 'dynil' ); ?></h1>
			<div class="content">
				<form name="dyn_form_send_pages" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
					<div class="dynil_ajax_section">					
						<?php $content::content_ajax(); ?>				
					</div>

					<div class="dynil_pages_section">	
						<div class="dynil_info">
							<h4 class="dynil_title_info"><?php _e('Or select One by One','dynil') ?></h4>
						</div>			
						<?php
							$content::content_pages();
							$content::content_load_pages();								
						?>						
					</div>
					<div class="dynil_table_result">
						<?php $content::content_table_result(); ?>
					</div>
					<div class="dynil_submit">
						<?php $content::content_submit_pages(); ?>
					</div>
				</form>
			</div>
		</div>
		<?php		
	}

	

	/** 
	* @since 1.0
	* Agregar Menu a el menu lateral de wp
	*/
	

	/** 
	* @since 1.0
	* @see add_menus method
	* Hooks de la clase
	*/
	private function hooks_actions( ){
		add_action( 'admin_post_dyn_save_pages', array( Class_request_dynil::instance( ) , 'save_pages')  );
		add_action( 'admin_post_nopriv_dyn_save_pages' , array( Class_request_dynil::instance( ) , 'save_pages') );

		if ( isset( $_GET['update_pages'] ) ){
			add_action( 'admin_notices' , array( $this , 'show_messages' ) );			
		}

	
	}

	/** 
	* @since 1.0
	* @see show_messages Method
	* Agrega mensajes informativos
	*/
	public function notices_messages(){
		$this->notices = array(
			'success_pages' => array(
				'message' => __( 'All pages have been successfully loaded.', 'dynil' ),
				'class'   => 'notice notice-success'
			),
			'error_pages'   => array(
				'message' => __( 'An error occurred while loading the pages.' , 'dynil '),
				'class'   => 'notice notice-error'
			)
		);

	}

	/** 
	* @since 1.0
	* Se ejecutara el mensaje respectivo de acuerdo a la peticion que se este haciendo.
	*/
	public function show_messages(){

		if( empty($this->notices ) ){
			$this->notices_messages();
		}
		$notices = $this->notices;

		$message = $_GET['update_pages'] == true ? $notices['success_pages'] : $notices['error_pages'];

		echo dynil_wrap_content( '<p class="dynil_message">' . "<strong>" . __('Message:','dynil') . "</strong> " . $message['message'] . '</p>' , [ 'class'=> $message['class'] ] );
	}
	
}
