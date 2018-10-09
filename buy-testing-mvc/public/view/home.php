<?php 

$home_wel = $elements->get_element("h3",["id"=>"home_wel","content"=>"Yá eres parte de nuestro equipo :)"]);
$home_about = $elements->get_element("parrafo",["id"=>"home_about","content"=>"Gracias por elegirnos, por cambiar la experiencia de las cosas, y por lograr entrar a trabajar con nosotros. Gracias a ti hay un nuevo miembro, y podemos asegurar que gracias a ti esta familia ha crecido. De parte de todos de OpenCol"]);
$body_into = $elements->get_element("body_into",["content"=>[$home_wel,$home_about]]);
$body_all = $elements->get_element("body_all",["content"=>$body_into]);

