<?php 

require_once '../PHP/functions.php';

send_home($_GET["id_prd"]);

$id = $_GET["id_prd"];
$sql_sel_prod = "SELECT * FROM product_post WHERE id LIKE '%$id%'";
$prepare = $conect->prepare($sql_sel_prod);
$prepare->execute();
$as = $prepare->fetch(PDO::FETCH_ASSOC);

/*Variabla adicional para lectura de HTML y ingreso de datos a la tabla LOGIN*/
$user_name = $as['user'];
$sql_sel_us = "SELECT * FROM profile_vendor WHERE user = '$user_name'";
$reg = $conect->prepare($sql_sel_us) ;

$reg->execute();


/*Idica variables para la lectura en el HTML*/



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $as['title']; ?> - OpenCol</title>
	<link rel="stylesheet" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/stylepag/ver_producto_creado.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	<script >
		$(document).ready(function() {
			
			$('.img_min_product').click(function (){

				var new_img =  $(this).attr('src');
				$('.prev_image img').attr('src',new_img);
			})

		});
	</script>
</head>
<body>
<?php include_once 'menu.php';	 ?>

<div class="body_all">
<div class="body_into box_shadow">

<?php 
if (($reg->rowCount())<1) {
	echo "<h3>No se han encontrado resultados</h3>";
}else{

	$reg_f = $reg->fetch(PDO::FETCH_ASSOC);

	$folder_reg = $as['folder'];
if ($folder_reg != "No Folder") {
	echo '<div class="img_block">';
	$folder = '../resources/Users/'.$reg_f['id'].'/'.$folder_reg.'/';
	$dir = dir($folder);
	$dir2 = scandir($folder);
	$expr = "/.*\.(png|jpg|gif|jpeg)$/";

	while (($ar = $dir->read())!== false) {
		if (preg_match($expr,$ar) && $ar!== 'profile_product.jpg') {
			echo '<img class="img_min_product" src="'.$folder . $ar.'">';		

		}		
	}

	
	
	
	
	$dir->close();
	
	echo '</div>';
	echo '<div class="prev_image"><div class="img"><img src="'.$folder.$dir2[2].'" alt=""></div></div>';
}else if($folder_reg == "No Folder"){
	echo '<h3>No se ha encontrado imagenes</h3>';
}
?>

</div>
<div class="body_into box_shadow">
<h1><?php echo $as['title']; ?></h1>
<div class="description_block"><?php echo $as['description']; ?></div>
<h2>Publicado por <a href="perfil_vendor?perfil_vendor=<?php echo $reg_f['id']; ?>"><?php echo $reg_f['alt_name']; ?></a></h2>
<h3>Fecha de Publicacion: <?php echo $as['f_date'] ?></h3>

</div>  
</div>
<?php } ?>

<?php add_footer(); ?>	
</body>
</html>