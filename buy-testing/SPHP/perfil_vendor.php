<?php 
if (!isset($_GET['perfil_vendor'])) {
	header('location:i_home');
}
$id_vendor = $_GET['perfil_vendor'];
require_once '../PHP/clases.php';

$sql_perfil_vendor = "SELECT * FROM profile_vendor WHERE id = :id_vendor ";
$arr_vendor = [":id_vendor"=>$id_vendor];
$reg_vendor = selectSqlinject($sql_perfil_vendor,$arr_vendor);

$o_m = false;
if (isset($_SESSION["username"])) {
	$user_avilable = $_SESSION["username"];

	if ($user_avilable == $id_vendor) {
		$o_m = true;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Perfil de Vendedor <?php echo $reg_vendor['alt_name']; ?></title>
	<link rel="stylesheet" href="../Styles/style.css">
	<link rel="stylesheet" type="text/css" href="../Styles/stylepag/profile_vendor.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	<script>
		$(document).ready(function(){
			
		});
	</script>
	
</head>
<body>
	<?php include_once '../SPHP/menu.php'; ?>
	<div class="body_all">
		<div class="body_into">
			
			<div class="profile_notice">
			<?php if (isset($_GET["r_true"])) {
					echo "<div class='notice'><h3>Se ha logrado crear el registro</h3><span class='span_alert'>Este es tu perfil</span></div>";
				}else if (isset($_GET["succ_c"])) {
					if ($_GET["succ_c"]) {
						echo "<div class='notice'><h3>Tus cambios han sido modificados exitosamente.</h3></div>";
					}else if(!$_GET["succ_c"]){
						echo "<div class='alert'><h3>Ha ocurrido un error. Intenta nuevamente</h3></div>";
					}

				}
				$alt_name = $reg_vendor['alt_name'];
					
				 ?>
					
				</div>
			<div class="principal_profile ">
				<div class="div_profile">
					<h3> <?php echo $alt_name; ?></h3>
					<div class="img_profile">
						<img src="../resources/Users/<?php echo $id_vendor .'/profile_img/'. $reg_vendor['img_profile'] ?>" alt="">
					</div>
					<div class="text_alt">
						<p class="p_info"><?php echo $reg_vendor['lema']; ?></p>
						<div><?php if ($reg_vendor['type_sell']=="comp") {
							echo '<span style="font-weight: bold;">Tipo de Vendedor <span class="span_alert">Compañia u organización</span></span>';
							if ($o_m) {
								echo '<div class="ch_s_c"><a href="../PHP/profile_vendor?ch_v=comp">Cambiar a vendedor independiente.</a href=""></div>';

							}
						}else{
							echo '<span style="font-weight: bold;">Tipo de Vendedor <span class="span_alert">Vendedor independiente</span></span>';

							if ($o_m) {
								echo '<div class="ch_s_i"><a href="../PHP/profile_vendor?ch_v=ind">Cambiar a compañia.</a></div>';
								}
							} 



							?></div>
					</div>
					<div class="show_products">
						<div class="all_products">
							<?php 

							// Código para ir buscando cada uno de los productos que el usuario registrado ha publicado.


							$user = $reg_vendor['user'];							

							$ss_all = "SELECT id, title, folder, cod_s FROM product_post WHERE user = :user AND alt_name = :alt_name";							

							$arr_ss = [":user"=>$user,":alt_name"=>$alt_name];
							$bd_arr = new add_bd;
							$reg_bd = $bd_arr->select_table($ss_all,$arr_ss,false);

							// Mientras se leen todos los productos publicados por este vendedor.
							while ($r = $reg_bd->fetch(PDO::FETCH_ASSOC)) {




								?> 
								<div class="block_product"><a href="ver_producto_creado?id_prd=<?php echo $r['id'] ?>">
								<?php
								$folder = $r['folder'];
								if ($folder!== "No Folder") {
									
									echo '<img src="../resources/Users/'.$r['cod_s'].'/'. $folder.'/' .'profile_product.jpg">';
									
								}else{
									// Agrega la imagen default en caso que no se encuentre ninguna imagen en la publicacion
									?>
											<img class="img_line_products" src="../resources/imgs/no_image.png" title="'.$r['title'].'">
									<?php
									
								}	

								?>
								<div class="title_products">
									<h3 class="title_principal"><?php echo $r['title'] ?></h3>
								</div>
								
								</a>
							</div>
								<?php				

								// FINAL DEL WHILE POR CADA PRODUCTO PUBLICADO
								}
								?>
								
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?php add_footer() ?>	
</body>
</html>