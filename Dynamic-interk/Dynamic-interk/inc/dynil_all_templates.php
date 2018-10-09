<?php 

function dynil_script_path( $name, $typ, $min = false ){

	$mins = ! $min ? '' : 'min.';
	return plugins_url( 'publics/' . $typ . '/' .$name . '.' . $mins . $typ , dirname(__FILE__) );
}

function dynil_wrap_content( $content, $attrs = array() ){

	$defaults = array(
		'wrap_content' => 'div',
		'id'           => '',
		'class'        => ''		
	);

	$attr = wp_parse_args( $attrs , $defaults );

	$content_html  = '<' . $attr['wrap_content'];
	$content_html .= $attr['id'] != '' ?  ' id="' . $attr['id'] . '"': '';
	$content_html .= $attr['class'] != '' ? ' class="' . $attr['class'] . '">': '>';
	$content_html .= $content;
	$content_html .= '</' . $attr['wrap_content'] . '>';

	return $content_html;


}

function dynil_create_wpdb ( $sql, $output = OBJECT ){

	global $wpdb;
	return $wpdb->get_results( $sql , $output );

}

function dynil_woo_exists( ){

	if( class_exists('WooCommerce') ){
		return true;
	}
	return false;
}

function dynil_clean_pages( $pages ){

	if ( is_array( $pages ) ){
		$html_pages = "" ;
		for( $i = 0 ; $i< sizeof( $pages ); $i++){
			$current_object = $pages[$i];
			
			$html_pages .= "<div class='dyn_box_content dyn_box_{$current_object->ID}'>";		
			$html_pages .= "<div class='dyn_box_data dyn_box_title'>{$current_object->post_title}</div>";
			$html_pages .= "<div><input class='dyn_box_check' type='checkbox' name='dynil_set_pages[]' value='{$current_object->ID}'></div>";	
			$html_pages .= "<div class='dyn_box_data dyn_box_date'><strong>" . __('Creation date: ','dynil') . "</strong><span>" . $current_object->post_date . "</span></div>";			
			$html_pages .= '</div>';

		}
		return $html_pages;
	}

}

function dynil_is_set_page(){

	if( isset( $_GET['page'] ) && $_GET['page'] === "dynil_menu_admin") return true;
	
	return false;
	
}

function dynil_is_insert_page(){

	if( isset( $_GET['page']) && $_GET['page'] === "dynil_menu_settings") return true;

	return false;
	
}


