<?php 

$elem = new elements;

$elem->add_element('link','a','link');
$elem->add_menu('primary_menu');

$elem->add_to_menu('primary_menu','home',array(
	"content" => "<a href='inicio'>Inicio</a>",
	"class"   => "menu-item"
));
$elem->add_to_menu('primary_menu','otro_menu',array(
	"content" => "<a href='crisx'>crisis</a>",
	"class"   => "aument-look"
));
$elem->add_to_menu('primary_menu','index',array(
	"content" => "<a href='index'>Ir a Index</a>",
	"class"   => "aument-look2"
));

$menu1 = $elem->get_menu('primary_menu','menu-primary','idder_menu');


