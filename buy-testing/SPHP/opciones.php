<?php require_once '../PHP/clases.php'; is_session(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Configuración de Usuario - OpenCol</title>
	<link rel="stylesheet" type="text/css" href="../Styles/style.css">
	<link rel="stylesheet" type="text/css" href="../Styles/stylepag/opciones.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>	
	<script src="../JS/options.js"></script>
</head>
<body>



	<?php 
		include_once 'menu.php';
		$user = $_SESSION["username"];
		$sql_option = "SELECT * FROM login WHERE id = '$user'";
		$registrer = selectSql($sql_option);		
	?>
	<div class="body_all">
		<div class="body_into">
			<h2>Configuración de Usuario</h2>
			<p>Debes estar seguro de los cambios que hagas.</p>
			<div class="option">
				<div class="acordeon">
					<span class="info_click">Nombre de Usuario</span>				
				</div>
				<div class="info_acordeon">
					<span class="info_info"><?php echo $registrer['user']; ?></span>					
					<spnan class="edit_option">Editar</spnan>
					<div class="edit_option_show">
						<p>Al editar este campo, se cerrará sesión cuando se hayan concretado cambios</p>
						<input type="text" id="edit_user_text">
						<input type="button" value="Cambiar" id="edit_user_button">
					</div>
				</div>		
			</div>
			<div class="option">
				<div class="acordeon">
					<span class="info_click">Email</span>				
				</div>
				<div class="info_acordeon">
					<span class="info_info"><?php echo $registrer['email']; ?></span>
					<spnan class="edit_option">Editar</spnan>
					<div class="edit_option_show">
						<input type="text" id="edit_email_text">
						<input type="button" value="Cambiar" id="edit_email_button">
					</div>
				</div>		
			</div>
			<div class="option">
				<div class="acordeon">
					<span class="info_click">Nombre</span>				
				</div>
				<div class="info_acordeon">
					<span class="info_info"><?php echo $registrer['name']; ?></span>
					<spnan class="edit_option">Editar</spnan>
					<div class="edit_option_show">
						<input type="text" id="edit_name_text">
						<input type="button" value="Cambiar" id="edit_name_button">
					</div>
				</div>		
			</div>
			<div class="option">
				<div class="acordeon">
					<span class="info_click">Apellido</span>				
				</div>
				<div class="info_acordeon">
					<span class="info_info"><?php echo $registrer['lastname']; ?></span>
					<spnan class="edit_option">Editar</spnan>
					<div class="edit_option_show">
						<input type="text" id="edit_lastname_text">
						<input type="button" value="Cambiar" id="edit_lastname_button">
					</div>
				</div>		
			</div>
			<div class="option">
				<div class="acordeon">
					<span class="info_click">Contraseña</span>				
				</div>
				<div class="info_acordeon">
					<div>Mantente seguro de los cambios que hagas en esta opción</div>
					<div><strong>Ingresa tu contraseña actual:</strong></div>						
						<input type="password" id="look_password" autocomplete="off" name="look_password">
						<input type="submit" id="button_look_password" value="Procesar" name="button_look_password">	
						
				</div>		
			</div>
		</div>
		<?php 
		$pr_ven =  new confirm_action;
		$is_vendor = $pr_ven->is_session();

		if ($is_vendor) {			
		
		 ?>
		<div class="body_into">
			<div class="title">
				<h3><a href="perfil_vendor?perfil_vendor=<?php echo ID_SESION; ?>">Perfil de vendedor</a></h3>				
			</div>
		</div>
		<?php } ?>
	</div>	
	<?php add_footer() ?>	
</body>
</html>