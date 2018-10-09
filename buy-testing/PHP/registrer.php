<?php 
require_once 'functions.php';


$user=$_GET["user"];
$password=$_GET["pass"];
$name=$_GET["name"];
$lastname=$_GET["lastname"];
$email=$_GET["email"];

$sel_sql1 = "SELECT user FROM login WHERE user = '$user'";
$sel_sql2 = "SELECT email FROM login WHERE email = '$email'";

$prepare=$conect->prepare($sel_sql1);
$prepare_email = $conect->prepare($sel_sql2);

$prepare->execute();
$prepare_email->execute();

$prepare -> fetch(PDO::FETCH_ASSOC); 
$prepare_email->fetch(PDO::FETCH_ASSOC);

$num_count1 = $prepare -> rowCount();
$num_count2 = $prepare_email->rowCount();

$p_veri= password_hash($password,PASSWORD_DEFAULT);

if ($num_count1 != 0 && $num_count2 != 0){
	echo 'email user';
}else if($num_count1 != 0){
	echo 'user';
}else if($num_count2 != 0){
	echo 'email';
}else if ($num_count1 == 0 && $num_count2 == 0) {
	$sql="INSERT INTO login (user,password, name, lastname, email, f_date,last_f_date) VALUES (:user,:p_veri,:name,:lastname,:email,NOW(),NOW())";
	
	$array = array(":user"=>$user,"p_veri"=>$p_veri,":name"=>$name,":lastname"=>$lastname,":email"=>$email);
	insertSql($sql,$array);

	echo 'ok';
}





 ?>