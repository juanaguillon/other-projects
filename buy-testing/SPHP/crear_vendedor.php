<?php 
require_once '../PHP/clases.php';
is_session();
$user = $_SESSION['username'];

// En caso de encontrar registrado este vendedor enviar a el menu inicio

$reg = new confirm_action;
$reg_v = $reg->is_session();



 ?>

 <?php 

		if($reg_v) {
				header('location:crear_producto');
				exit;
		}else{ 

			
		?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registro como vendedor</title>	
	<link rel="stylesheet" type="text/css" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/stylepag/create_vendor.css">	
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	<script src="../JS/create_vendor.js"></script>
		
</head>
<body>
<?php include_once 'menu.php'; ?>
	<div class="body_all">
		<div class="body_into">
		
			<form id="create_vendor_form" enctype="multipart/form-data" action="../PHP/create_vendor.php" method="post">
				<table align="center">
					<tr>
						<td>
							<p>Tipo de vendedor</p>
							<select name="type_vendor" id="type_vendor">
								<option value="ind">Independiente</option>
								<option value="comp">Empresa o Compañia</option>				
							</select></td>
					</tr>
					<tr>
						<td><p id="p_alt_name">Nombre Alternativo</p><input type="text" name="i_alt_name" id="i_alt_name"></td>
					</tr>
					<tr>
						<td><p id="p_desc">Texto representativo</p><input type="text" name="i_desc" id="i_desc"></td>
					</tr>
					<tr>
						<td>
							<p id="p_profile">Imagen de Perfil</p>
							<span class="span_alert">Selecciona una imagen con formato .png, .jpg, .gif, .jpeg.<br> Un tamaño máximo de 2 mb.</span>
							<div class="file">
								<i class="fa fa-upload"></i>
								<input type="file" name="img_profile" id="img_profile" accept="image/x-png,image/jpeg,image/gif">								
							</div>							
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="send_reg_vendor" value="Registrar"></td>
					</tr>
				</table>
			</form>
		
	
		</div>
	</div>
	<?php add_footer(); ?>
</body>
</html>
<?php } ?>