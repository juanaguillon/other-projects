<?php 

require_once '../PHP/functions.php';

/*Se enviara a i_home.php en caso que no se encuentre el texto a buscar.*/

if (!isset($_GET["send_search"]) && !isset($_GET["search_text"])) {
	header('location:i_home');
}else{ 	
	

	/*Si se ha seleccionado el texto, se creara toda la operación*/

	$text_search = $_GET["search_text"];

	$sql_select_search = "SELECT * FROM product_post WHERE title LIKE '%' :search '%' ";
	$arr_select_search = array(":search"=>$text_search);
	$reg_search = selectSqlinject($sql_select_search,$arr_select_search,false);	
	
	

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Busqueda de <?php echo $text_search; ?> - OpenCol</title>
	<link rel="stylesheet" type="text/css" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/stylepag/mostrar_producto.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	
</head>
<body>
	<?php include_once 'menu.php'; ?>
	<div class="body_all">
		<div class="body_into">	
				
			<?php 

			if ($reg_search->rowCount()>0) {
				while($as = $reg_search->fetch(PDO::FETCH_ASSOC)){				
					


				echo '<div class="line_product"><a href="../SPHP/ver_producto_creado?id_prd='.$as['id'].'">	';
				 
				$user = $as['user'];	
						
				$folder_reg = $as['folder'];	
				$user_id = $as['cod_s'];	
				
				
				if ($folder_reg!=="No Folder") {	
				echo '<img class="each_image" src="../resources/Users/'.$user_id.'/'. $folder_reg.'/' .'profile_product.jpg">';
				
				
				
				}else if($folder_reg==="No Folder"){
						echo '<img class="each_image" class="img_product" src="../resources/imgs/no_image.png" alt="">';
				}		

				echo '<div class="title_post"><h4>' . $as['title'] . '</h4></div><button class="add_product" title="Agregar a favoritos."><i class="fa fa-heart"></i></button></a></div>';
				
				}


		}else{
					echo "<h3>No se han encontrado resultados con el texto '".$text_search."' </h3>";		
			}

	 ?>
	</div>
	</div>
	<?php add_footer() ?>	
</body>
</html>

<?php  
}
?>




