<?php 

$elements->add_element("alert","div","div_alert");
$elements->add_element("modal","div","modal_");
$email = $elements->get_element("input",["type"=>"text","id"=>"login_email","class"=>"add_text","autocomplete"=>"off"]);
$pass = $elements->get_element("input",["type"=>"text","id"=>"login_pass","class"=>"add_text","autocomplete"=>"off"]);

$lemail = $elements->get_element("label",["for"=>"login_email","content"=>"Ingresa tu Email"]);
$lpass = $elements->get_element("label",["for"=>"login_pass","content"=>"Ingresa tu contraseña"]);

$link_reg = $elements->get_element("link",["href"=>"registrer","content"=>"Registrar"]);
$button_log = $elements->get_element("input",["class"=>"botsi","type"=>"submit","id"=>"button_log","value"=>"Ingresar"]);
$button_reg = $elements->get_element("boton-alt",["id"=>"button_reg","content"=>$link_reg]);
$alert = $elements->get_element("alert",["style"=>"display:none"]);
$modal = $elements->get_element("modal",["content"=>"Espere un momento...","style"=>"display:none"]);

$form = $elements->get_element("form",["id"=>"login_form","method"=>"post","content"=>[$alert,$lemail,$email,$lpass,$pass,$button_log,$button_reg]]);
$div_reg = $elements->get_element("div",["content"=>$form]);
$body_into = $elements->get_element("body_into",["content"=>$div_reg]);
$body_all = $elements->get_element("body_all",["content"=>$body_into]);

$styles = ["login"];
$scripts = ["login"];