<?php 
	
// Ingreso de arrays para indicar nuevas propiedades

$elements = new elements;
$op = new operations;
session_start();

// Añadir un elemento: $elements->add_element(nombre identificativo, elemento(tipo de elemto), clase (class))


// Creando elementos en el menú principal.
// Formularios
$elements->add_element("input","input","all_i");
$elements->add_element("form","form","form_key");
$elements->add_element("label","label","label_text");
$elements->add_element("select","select","all_i");
$elements->add_element("option","option","all_i");

// Listas 
$elements->add_element("list","li","list_order"); 
$elements->add_element("ul","ul","ul_list_order");
// Botones y links
$elements->add_element("link","a","linked");
$elements->add_element("boton-si","button","botsi");
$elements->add_element("boton-no","button","botno");
$elements->add_element("boton-alt","button","botalt");

// Navegacion
$elements->add_element("navigation","nav","_nav");

// Headers
$elements->add_element("linka","link",null);
$elements->add_element("scripta","script",null);

// Divs
$elements->add_element("div","div","dblock");
$elements->add_element("body_all","div","body_all");
$elements->add_element("body_into","div","body_into");

// Textos
$elements->add_element("title","span","span_title");
$elements->add_element("parrafo","p","text");
$elements->add_element("h1","h1","text");
$elements->add_element("h2","h2","text");
$elements->add_element("h3","h3","text");
$elements->add_element("h4","h4","text");
$elements->add_element("h5","h5","text");




try{

	
	// ***MENU PRINCIPAL -------------------------------------------
	// --------------------------------------------------------------
	$menu_home = $elements->get_element("link",["href"=>"home","content"=>["Inicio"],"id"=>"menu_home"]);
	$menu_option = $elements->get_element("link",["href"=>"opciones","content"=>"Opciones","id"=>"menu_option"]);
	
	$menu_sub_f = $elements->get_element("input",["type"=>"submit","id"=>"menu_sub_f","class"=>"botsi_menu","value"=>"Buscar"]);
	$menu_text_f = $elements->get_element("input",["type"=>"text","id"=>"menu_text_f","class"=>"menu_text","placeholder"=>"Buscar..."]);
	$menu_title = $elements->get_element("title",["id"=>"menu_title","style"=>"font-size:25px","content"=>"OpenCol"]);

	$li_menu_option = $elements->get_element("list",["content"=>$menu_option,"id"=>"li_menu_option"]);
	$li_menu_home = $elements->get_element("list",["content"=>$menu_home,"id"=>"li_menu_home"]);

	if ($op->is_session()) {
		$menu_login = $elements->get_element("link",["href"=>"?close_session=true","content"=>"Cerrar Sesión","id"=>"menu_close"]);
		$li_menu_ = $elements->get_element("link",["content"=>$menu_login]);
	}else{
		$menu_login = $elements->get_element("link",["href"=>"login","content"=>"Ingresar","id"=>"menu_login"]);
		$li_menu_ = $elements->get_element("list",["content"=>$menu_login,"id"=>"li_menu_login"]);
	}
	
	
	$ul_primary_key = $elements->get_element("ul",["content"=>[$li_menu_home,$li_menu_,$li_menu_option],"id"=>"ul_primary_key"]);
	$form_menu_nav = $elements->get_element("form",["content"=>[$menu_text_f,$menu_sub_f],"id"=>"form_menu_nav"]);

	$div_ul_pk = $elements->insert_element($ul_primary_key,["element"=>"div","class"=>"divpk"],["id"=>"div_ul_pk"]);
	$div_f_pk = $elements->insert_element($form_menu_nav,["element"=>"div","class"=>"divpk"],["id"=>"div_f_pk"]);
	$div_title_pk = $elements->insert_element($menu_title,["element"=>"div","class"=>"divpk"],["id"=>"div_title_pk"]);
	$nav_primary = $elements->get_element("navigation",["content"=>[$div_title_pk,$div_f_pk,$div_ul_pk],"id"=>"nav_primary","class"=>"body_all"]);

	$header_pr = $elements->insert_element($nav_primary,["element"=>"header","class"=>"header"],["id"=>"header"]);
	
	

}catch(Exception $e){
	echo $e->getMessage();
}



