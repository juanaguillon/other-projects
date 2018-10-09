<?php 

require_once '../PHP/clases.php';
	
	is_session();
	$r = new confirm_action;
	$is_vendor = $r->is_session();

	if (!$is_vendor) {
		header('location:crear_vendedor');
		exit;
	}else{

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Crear Producto</title>
	<link rel="stylesheet" type="text/css" href="../Styles/style.css">
	<link rel="stylesheet" type="text/css" href="../Styles/stylepag/crear_producto.css">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script src="../JS/javaScript.js"></script>
	<script src="../JS/crear_producto.js"></script>
	
</head>
<body>	
	<?php 	
	include_once 'menu.php';
	?>
	
	<div class="body_all">

	<?php 
	
		
		$name_user = ALT_VENDOR; 		
		
	}


	 ?>
		<form id="create_product" enctype="multipart/form-data" action="../PHP/product.php" method="post">
		<div class="body_into">
			<div class="block_info">
				<h3>Crea un producto <?php echo $name_user; ?></h3>
				<p class="p_info">Comienza ahora, inicia progreso vendiendo los productos que seguramente a la comunidad le va a gustar.</p>
			</div>
			<div class="select_title">
					<h3>Selecciona el Titulo a publicar</h3>
					<input type="text" name="title" autocomplete="off" id="title" maxlength="130">
				</div>
		</div>
		<div class="body_into">
			<div class="select_images">	
				<h3>Selecciona las Imagenes</h3>	
				<p><strong>Nota: </strong>Únicamente es permitido archivos con extension "jpeg", "png" y "gif"</p>		
					
					<div id="pr_image"><i class="fa fa-upload"></i><span style="display: block;font-size: 12px; margin-top:25px;">Insertar imagen principal</span><input type="file" name="img_1" accept="image/png,image/jpeg,image/gif"></div>
					<div class="file"><input type="file" name="img_2" accept="image/png,image/jpeg,image/gif"></div>
					<div class="file"><input type="file" name="img_3" accept="image/png,image/jpeg,image/gif"></div>
					<div class="file"><input type="file" name="img_4" accept="image/png,image/jpeg,image/gif"></div>
					<div class="file"><input type="file" name="img_5" accept="image/png,image/jpeg,image/gif"></div>
			</div>
				
				<div class="select_description">
					<h3>Selecciona tu description</h3>
					<p>Seria conveniente no insertar una descripcion demasiado larga, esta se tomara en cuenta en futuras ocaciones para saber un poco de tu producto. Te recomendamos que coloques la mayor cantidad de descripcion la seccion <strong>"Escribe la descripcion de producto"</strong></p>
					
					<div class="buttons_edit">

						<div class="inner_buttons_edit">
							<button title="Negrita" id="b_e_negrita"><i class="fa fa-bold"></i></button>
							<button title="Itálica" id="b_e_italic"><i class="fa fa-italic"></i></button>
							<button title="Lista Desordenada" id="b_e_list_ul"><i class="fa fa-list-ul"></i>	</button>
							<button title="Lista Ordenada" id="b_e_list_ol"><i class="fa fa-list-ol"></i></button>
							<button title="Sobre Línea" id="b_e_underline" ><i class="fa fa-underline"></i></button>
							<button title="Alinear a Izquierda" id="b_e_aleft"><i class="fa fa-align-left"></i></button>
							<button title="Centrar" id="b_e_acenter"><i class="fa fa-align-center"></i></button>
							<button title="Alinear Derecha" id="b_e_aright"><i class="fa fa-align-right"></i></button>						
							<select name="insert_elemnt" id="b_i_element" >
								<option value="default">Agregar Elemento</option>
								<option value="h1">Titulo 1</option>
								<option value="h2">Titulo 2</option>
								<option value="h3">Título 3</option>
								<option value="h4">Titulo 4</option>
								<option value="h5">Titulo 5</option>
								<option value="h6">Título 6</option>	
								<option value="table">Tabla</option>						
							</select>

						</div>
						<button class="change_look">VISUAL</button>
					</div>
					<div class="create_table">
						<span>Numero de Filas</span>
						<input type="number" name="tr" min="1" max="10">
						<span>Número de Columnas</span>
						<input type="number" name="td" max="10" min="1">
						<button id="send_create_table">Listo</button>
					</div>
					
					<textarea name="description" id="text_area"></textarea>
					<iframe id="iframe_area" width="800" height="500" frameborder="0" style="border:1px solid #DEDEDE; border-radius: 4px"></iframe>					
				</div>
				<div class="select_send_form">
					<input type="submit" name="public" value="Publicar" class="submit" id="boton_form">			
				</div>
				
		</div>
		</form>
	</div> 
	
	<?php add_footer(); ?>
</body>
</html>
