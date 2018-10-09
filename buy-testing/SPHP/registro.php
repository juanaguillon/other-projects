<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Registro</title>
<link rel="stylesheet" type="text/css" href="../Styles/style.css">
<link rel="stylesheet" type="text/css" href="../Styles/stylepag/registro.css">
<script src="../JS/jquery-3.2.1.js"></script>
<script src="../JS/javaScript.js"></script>
<script src="../JS/registro.js"></script>
</head>


<body>
	<?php 	
	include_once 'menu.php';
	not_session();
?>
	
	<div class="body_all">
		
		<div class="body_into">
			<form action="../PHP/registrer.php" id="reg_form" method="get">
			<table id="reg_tab" align="center">
				<tr>
					<td colspan="2"><div class="alert"></div></td>
				</tr>
				<tr>
					<td><label for="user">Usuario</label></td>
					<td><input type="text" id="user" name="user" autocomplete="off" placeholder="Usuario"></td>      
				</tr>    
				<tr>
					<td><label for="email">Correo Electronico</label></td>
					<td><input type="text" id="email" name="email" autocomplete="off" placeholder="Correo Electrónico"></td>      
				</tr>
				<tr>
					<td><label for="name">Nombre</label></td>
					<td><input type="text" name="name" id="name" autocomplete="off" placeholder="Nombres"></td>      
				</tr>
				<tr>
					<td><label for="lastname" >Apellido</label></td>
					<td><input type="text" placeholder="Apellidos" id="lastname" name="lastname" autocomplete="off"></td>      
				</tr>
				<tr>
					<td><label for="pass">Contraseña</label></td>
					<td><input type="password" placeholder="Contraseña" id="pass" name="pass" autocomplete="off"></td>      
				</tr>
				<tr>
					<td><label for="pass2">Confirma contraseña</label></td>
					<td><input type="password" placeholder="Confirma Contraseña" id="pass2" name="pass2" autocomplete="off"></td>      
				</tr>
				<tr>    
					<td colspan="2" align="center"><input type="submit" id="_sendreg" name="_sendreg" value="¡Registrar!"></td>
				</tr>
			</table>
		
		</form>
	</div>
	<?php add_footer() ?>	
</body>
</html>