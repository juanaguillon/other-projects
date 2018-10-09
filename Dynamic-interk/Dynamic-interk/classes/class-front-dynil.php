<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 * Encargada de modificar el contenido de las paginas
 */
class Class_front_dynil extends Class_dynil
{
	/**
	* @since 1.0
	* Array de paginas que se han insertado para ser mostradas.
	*/
	private $pages = null;

	/**
	* @since 1.0
	* Propiedad intancia de clase
	*/
	public static $instance = null;

	private $this_page = null;

	private $is_selected = false;

	/**
	 * @since 1.0
	 * Instancia de clase
	 */
	public static function instance( $param = null ){

		if ( self::$instance == null ){
			self::$instance = new self(  );
		}
	
		return self::$instance;
	}	


  /**
	 * @since 1.0
   * Constructor de class
   */
  public function __construct(  ){
  		global $post;
      $this->pages = get_option( 'dynil_inserted_pages' );
      $this->this_page = $post->ID;
			$this->change_the_content();
			$this->enqueues();
	}
	
	public function enqueues( ){
		$this->import_style( dynil_script_path( 'dynil-front','css'), 'dynil_front_css','site' );
		$this->enqueue_scripts();
	}

	/**
	 * @since 1.0
	 * Crea la estructrua global de la estructura html en el blucle (segun su caso) de las paginas seleccionadas.
	 * 
	 * De otra manera, esta funcion creara la estructura html que se proporcionara en el front-end, ya que se usara en caso de que sea necesario ejecutar el bucle, o no (para evitar errores).
	 */

	public function generic_html( $index, $html_struct, $bucle = false ){

		
		
		if( ! $bucle ){
			$html = '<div class="dyn_parent_link">';
		}else{
			global $global_html;
			$html .= '<div class="dyn_parent_link">';
		}		
		
		$html .= '<a href="' . get_permalink( $index ) . '" class="dyn_lined_pages"><div class="dyn_cr_pages">';		
		// Title post
		$html .= '<' . $html_struct['0'] .' class="dyn_title_post">' . get_the_title( $index ) . '</'. $html_struct['0'] . '>';

		if( has_post_thumbnail( $index ) ){
			
			$html.= dynil_wrap_content( get_the_post_thumbnail( $index, 'medium', array('class'=>'dyn_image_interk') ), array(
				'wrap_content' => $html_struct['1']
			) ) ;
		}
		if( has_excerpt( $index ) ){
			
			$html .= '<' . $html_struct[2] . ' class="dynil_the-excerpt">' . get_the_excerpt( $index ) . '</' . $html_struct[2] . '>';
		}

		$html .= '</div></a></div>';		
		return $html;

	}

  public function get_html_another_pages( $id ){  	
		$count_per = count($this->pages) * ( 70 / 100 );
		if(  $count_per < 1 ) return;
		$html_struct = get_option('dynil_structure_html');		
		$arr_total = array_rand( $this->pages, $count_per );		

		if( ! is_array( $arr_total ) ){		
			
			if ( $id == $arr_total ){
				return;
			}	
			$html = $this->generic_html( $arr_total, $html_struct );		

		}else{

			$global_html = '';
			foreach( $arr_total as $id_page ){	
				if ( $id == $id_page ){
					continue;
				}		
				
				$html .= $this->generic_html( $id_page,$html_struct, true );
				
			}

		}		
  	
  	return $html;

  }
  public function change_hook( $content ){
  	$returned = $content;
    global $post;
		$this->this_page = $post->ID;
		
  	foreach( $this->pages as $id_page => $order ){
  		if( is_page() && $this->this_page == $id_page  ){

    		$this->is_selected = true;

  		}else if( ! $this->is_selected ){
  			unset( $this->pages[ $id_page ] );
  		}
  	}

  	if( $this->is_selected ){  		
  		$returned .= dynil_wrap_content( $this->get_html_another_pages( $this->this_page ), ['class'=>'dyn_all_pages'] );
  	}

  	return $returned;
  }

	
  public function change_the_content( ){  	

  		add_filter( 'the_content', array( $this , 'change_hook') );
  	
  }
}