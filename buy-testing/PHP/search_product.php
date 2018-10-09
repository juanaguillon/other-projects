<?php 

require_once 'functions.php';
if (isset($_GET["search_text"])) {
	$search_text = $_GET["search_text"];
	$sql_sel_prod = "SELECT * FROM product_post WHERE title LIKE '%' :search '%' LIMIT 5";
	$prepare = $conect->prepare($sql_sel_prod);
	$prepare->execute(array(":search"=>$search_text));
	
	for ($i=0; $i < 6; $i++) { 
		while ($as = $prepare->fetch(PDO::FETCH_ASSOC)) {		
			 echo '<p><a href="ver_producto_creado?id_prd='.$as['id'].'">'.$as['title'].'</a></p>';			 
		}
	}
	
}

 ?>