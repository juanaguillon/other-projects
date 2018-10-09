<?php 
$elements->add_element("div_section","div","section");

$option = $elements->get_element("option",["value"=>"default","content"=>"Tipo de vendedor"]);
$comp_sell = $elements->get_element("option",["value"=>"comp_sell","content"=>"Comapñía"]);
$ind_sell = $elements->get_element("option",["value"=>"ind_sell","content"=>"Independiente"]); 
$type_sell = $elements->get_element("select",["id"=>"type_sell","name"=>"type_sell","content"=>[$option,$comp_sell,$ind_sell]]);
$select = $elements->insert_element($type_sell,["element"=>"div","class"=>"section"]);

$namel = $elements->get_element("label",["for"=>"name_","content"=>"Nombre de compañía"]);
$namei = $elements->get_element("input",["type"=>"text","class"=>"add_text","id"=>"name_"]);
$input = $elements->get_element("div_section",["content"=>[$namel,$namei]]);

$inimg = $elements->get_element("input",["type"=>"file","name"=>"img_sell","class"=>"input_file","accept"=>"image/*"]);
$div_img = $elements->get_element("div",["class"=>"div_file","content"=>[$inimg,"Subir Imagen"],"style"=>"text-align:center"]);
$image = $elements->get_element("div_section",["content"=>[$div_img]]);

$submit = $elements->get_element("input",["type"=>"submit","value"=>"Registrar","class"=>"botsi"]);

$form = $elements->get_element("form",["enctype"=>"multipart/form-data","id"=>"reg_sell","content"=>[$select,$input,$image,$submit]]);
$div = $elements->insert_element($form,["element"=>"div","class"=>"dblock"]);
$body_into = $elements->get_element("body_into",["content"=>$div]);
$body_all = $elements->get_element("body_all",["content"=>$body_into]);

$styles = ["reg_sell"];
$scripts = ["reg_sell"];