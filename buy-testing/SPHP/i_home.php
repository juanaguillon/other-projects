<?php require_once '../PHP/clases.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/stylepag/home.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	<script>
		$(document).ready(function(){
			$('.right_button').click(function(){
				$('.s_post_img').css('transform','translateX(-48.8%)');
			});
			$('.left_button').click(function(){
				$('.s_post_img').css('transform','translateX(0)');
			});
		});
	</script>
</head>
<body>
<?php include_once 'menu.php'; 

	// c_session devuelve false si no esta registrado como vendedor.

	$session = new confirm_action;
	$c_session = $session->is_session();
?>
	<div class="body_all">
		<div class="body_into">
			<div class="all_page">
			<?php 
			

			/*Se Ejectará esta accion unicmente si esta registrado como vendedor*/

			if ($c_session) {			
				
				// Se ejecutara la siguiente acción en caso de encontrar algun producto publicado por este vendedor.
				// Function de clases 

				$pro =  new products;
				$pro_a = $pro->products_exists();
				if ($pro_a->rowCount()>0){
					?>
			
				<div class="my_post">
					<div class="title_s_post">
						<h3>Tus últimos productos publicados</h3>
					</div>
					<div class="s_post_carrousel">
						<div class="s_post_img" style="transform: translateX(0);">						
							
								<?php 

								while ($pro_b = $pro_a->fetch(PDO::FETCH_ASSOC)) {
									echo '<a href="ver_producto_creado?id_prd='.$pro_b['id'].'"><div class="list_img">';
									$folder = $pro_b['folder'];		
									if ($folder=="No Folder") {
										echo '<img class="into_list_img" src="../resources/imgs/no_image.png" alt="">';
									}else{										
										echo '<img src="../resources/Users/'.ID_SESION.'/'. $folder.'/' .'profile_product.jpg">';			
									}								
									
									echo '<h3>'.$pro_b['title'].'</h3>';

									echo '</div></a>';
								}

							 ?>
							
							

						</div>
						<?php 

						if ($pro_a->rowCount()>4) {
							
								?>
							<div class="left_button">
								<i class="fa fa-angle-left"></i>
							</div>
							<div class="right_button">
								<i class="fa fa-angle-right"></i>
							</div>
						<?php } ?>
					</div>
				</div>				
				<?php }else{
					?> 
				<div class="my_post">
					<div class="title_s_post">
						<h3>Notificacion:</h3>
						<p class="parr_alert">Aun no has creado ningun producto.<a href="crear_producto"> ¿Deseas crear uno ahora?</a></p>
					</div>					
				</div>
					<?php
					}
				} ?>
				<div class="all_post">
					<div class="last_products">
						
					</div>					
				</div>
			</div>
		</div>
	</div>	
	<?php add_footer(); ?>
</body>
</html>