<?php 
/**
* 
* @package Dyn Internal Links
* @version 1.0
* Plugin Name: Dynamic Interlink
* Description: Create your simple way to generate excellent SEO. Dyn-Internal Links will guide you to create your position through connections between pages.
* Author: Juan C
* Version: 1.0
*/


// Ruta base.
if( ! defined( 'DYNIL_PATH')){
	define( 'DYNIL_PATH', dirname(__FILE__));
}

if ( ! defined( 'DYNIL_CLASSES') ) {
	define ( 'DYNIL_CLASSES' , DYNIL_PATH . '/classes/' );
}

// Llamada de archivo, en el cual se llamas nuevos archivos necesarios.
include_once DYNIL_CLASSES . 'class-dynil.php';

function dynil(){
	
	return Class_dynil::init_class();
}

$GLOBALS['dynil'] = dynil();
