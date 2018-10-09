<?php 
//  SECCION DE REGISTRO DE USUARIO
// --------------------------------------------------------------

$elements->add_element("alert","div","div_alert");
$elements->add_element("modal","div","modal_");

$modal = $elements->get_element("modal",["content"=>"Espere un momento...","style"=>"display:none"]);

$div_alert = $elements->get_element("alert",["style"=>"display:none"]);

$regl_name = $elements->get_element("label",["for"=>"reg_name","content"=>"Nombre"]);
$regl_ap = $elements->get_element("label",["for"=>"reg_ap","content"=>"Apellido"]);
$regl_email = $elements->get_element("label",["for"=>"reg_email","content"=>"Email"]);
$regl_pass = $elements->get_element("label",["for"=>"reg_pass","content"=>"Contraseña"]);
$regl_past = $elements->get_element("label",["for"=>"reg_passt","content"=>"Confirmar Contraseña"]);
$regi_name = $elements->get_element("input",["autocomplete"=>"off","type"=>"text","id"=>"reg_name","name"=>"reg_name","class"=>"add_text"]);
$regi_ap = $elements->get_element("input",["autocomplete"=>"off","type"=>"text","id"=>"reg_ap","name"=>"reg_ap","class"=>"add_text"]);
$regi_email = $elements->get_element("input",["autocomplete"=>"off","type"=>"text","id"=>"reg_email","name"=>"reg_email","class"=>"add_text"]);
$regi_pass = $elements->get_element("input",["autocomplete"=>"off","type"=>"password","id"=>"reg_pass","name"=>"reg_pass","class"=>"add_text"]);
$regi_past = $elements->get_element("input",["autocomplete"=>"off","type"=>"password","id"=>"reg_passt","name"=>"reg_passt","class"=>"add_text"]);
$regi_reg = $elements->get_element("input",["type"=>"submit","class"=>"botsi","value"=>"Registrar"]);	


$reg_name = $elements->get_element("div",["content"=>[$regl_name,$regi_name]]);
$reg_ap = $elements->get_element("div",["content"=>[$regl_ap,$regi_ap]]);
$reg_email = $elements->get_element("div",["content"=>[$regl_email,$regi_email]]);
$regi_pass = $elements->get_element("div",["content"=>[$regl_pass,$regi_pass]]);
$regi_passt = $elements->get_element("div",["content"=>[$regl_past,$regi_past]]);


if (isset($_GET["data"]) && $_GET["data"]=="new_user") {
	// Condicional para ingresar un content adicional
	$elements->add_element("notice","div","div_notice");
	$notice = $elements->get_element("notice",["content"=>"<p>Usuario registrado</p>"]);	
	$reg_form = $elements->get_element("form",["id"=>"reg_form","method"=>"post","content"=>[$notice,$div_alert,$reg_name,$reg_ap,$reg_email,$regi_pass,$regi_passt,$regi_reg]]);
}else{
	$reg_form = $elements->get_element("form",["id"=>"reg_form","method"=>"post","content"=>[$div_alert,$reg_name,$reg_ap,$reg_email,$regi_pass,$regi_passt,$regi_reg]]);
}
$body_into = $elements->get_element("body_into",["content"=>$reg_form]);

$body_all = $elements->get_element("body_all",["content"=>$body_into,"id"=>"regis"]);

$styles = ["login","registrer"];
$scripts = ["registrer"];


