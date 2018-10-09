<?php 

require "model/connection.php";

$connect = new connect;


if (isset($_POST["nam"])){

	$name = $_POST["nam"];
	$author = $_POST["auth"];
	$comment = $_POST["comm"];

	$sql = "INSERT INTO schemes (NAME,COMMENT,AUTHOR) VALUES (:name,:comment,:author)";
	$array = array(":name"=>$name,":comment"=>$comment,":author"=>$author);

	$fetch = $connect->db($sql,$array);
	$count = $fetch->rowCount();

	if ($count >0 ) {
		echo "Registro insertado";
	}
}
