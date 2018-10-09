<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Ingresar</title>
		<link rel="stylesheet" href="../Styles/style.css">
		<link rel="stylesheet" type="text/css" href="../Styles/stylepag/ingresar.css">
		<script src="../JS/jquery-3.2.1.js"></script>
		<script src="../JS/javaScript.js"></script>
	</head>
	<body>
	
		<?php include_once 'menu.php';?>
		<?php require_once '../PHP/functions.php';
		not_session();
		?>
		<div class="body_all">
			<div class="body_into">
				<div id="on_login">
					<form action="../PHP/login.php" method="get" id="ing_form">
						<table align="center">
							<tr>
								<td colspan="2">
									<span>Usuario</span>
									<input placeholder="Usuario" type="text" id="log_user" name="log_user" size="30">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<span>Contraseña</span>
									<input placeholder="Contraseña" type="password" id="log_pass" name="log_pass" size="30">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" value="Ingresar">
								</td>
							</tr>
							<tr>
								<td><a href="" class="linka_none">¿Has olvidado tu contrasña?</a></td>
								<td><a href="registro" class="linka_success">¿No has creado una cuenta? Regístrate aquí</a></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<?php add_footer() ?>
	</body>
</html>