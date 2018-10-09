$(document).ready(function(){
	$('.info_acordeon').hide();
			$('.acordeon').click(function(){	
				$(this).next('.info_acordeon').slideToggle('fast');
			});
			$('#button_look_password').click(function(e){				

				e.preventDefault();

				$('.alert').remove();
				var input_text = $('#look_password').val();
				if (input_text == "") {
					$('.alert').remove();
					$(this).after('<div class="alert"><p>Ingresa tu contraseña actual.</p></div>');
				}else{
					$.ajax({
						url: '../PHP/options.php',					
						data: {
							password: input_text,
							see_password: true						
						},
						contentType: false,						
						success:function(data){
							/*Comienzo de la funcion para verificar la contraseña prooporiconada
							*Si se encuentra la contraseña, añade los campos para cambiar la contraseña
							*Si no se encuentra, enviara el error para */

							if(data == 'ok'){
								$('.info_acordeon:last').empty();															
								$('.info_acordeon:last').append('<form method="get" id="change_password_form"><table><tr><td><span>Nueva Contraseña</span><input type="password" name="new_password" id="new_password"></td></tr><tr><td><span>Confirmar Contraseña</span><input type="password" name="confirm_new_password" id="confirm_new_password"></td></tr><tr><td colspan="2"><input type="submit" name="send_new_password" value="Cambiar"></td></tr></table></form>');
								$('#change_password_form td input[type="password"]').css('width','100%');
								$('#change_password_form').submit(function(e){
									$('.alert').remove();
									e.preventDefault();
									var new_password = $('#new_password').val(), confirm_new_password = $('#confirm_new_password').val();
									if (new_password !== confirm_new_password) {
										$(this).after('<div class="alert"><p>Las contraseñas no coinciden</p></div>');
									}else{
										$.ajax({
											url:'../PHP/options.php',											
											data: {
												change_password: true,
												new_password: confirm_new_password
											},											
											contentType:false,
											success:function(data){
												if(data == 'ok'){
													$('#change_password_form table').append('<div class="notice"><p>Contraseña cambiada conrrectamente</p></div>');
												}else{
													$('#change_password_form table').append('<div class="alert"><p>Ha ocurrido un problema al cambiar la contraseña, intenta nuevamente</p></div>');		
												}												
											}
										});
									}
								});
								
							}else{															
								$('#button_look_password').after('<div class="alert"><p>La contraseña ingresada no es correcta</p></div>');
					}
					/*Final de la funcion para lograr una contraseña */							
				}
			});
		}
		
	});
			

	/*COMIENZO DEL SCRIPT PARA CAMBIAR EL NOMBRE DE USUARIO*/
			$('.edit_option_show').hide();
			$('.edit_option').click(function(){
				$(this).next('.edit_option_show').show();
			});

			$('#edit_user_button').click(function (){
				// En caso de dar click en el boton
				var text_user = $('#edit_user_text').val();

				if (text_user== "") {
					$(this).put_alert_after('Selecciona un nombre de usuario nuevo');
					
				}else if(text_user.length <8){
					$(this).put_alert_after('Es necesario un nombre de usuario igual o mayor a 8 caracteres');
					
				}else{
					$.ajax({
						url: '../PHP/options.php',
						data:{
							change_user: true,
							new_user: text_user
						},
						contentType:false,
						success:function (e){							
							if (e=="no ok") {
								$('#edit_user_button').put_alert_after('Este nombre de usuario no se encuentra disponible');
							}else if(e=="ok login" || e=="ok post"){
								location.reload();
							}else{
								alert(e);
							}
						}/*Fin funcion devuelta Ajax*/
					})/*Fin funcion total de Ajax*/
				}/*Fin de Else*/
			})/*Fin de Submit*/

			/*Funcion para lograr ingresasr un nuevo email*/
				$('#edit_email_button').click(function (){
				var text_email = $('#edit_email_text').val();
				var expr_mail = /^[a-z_\-\.0-9]+@[a-z]+\.[a-z]+$/;
				if(text_email==""){
					$(this).put_alert_after('Es necesario un corre electronico');
				}else if (!expr_mail.test(text_email)){
					$(this).put_alert_after('El correo electrónico proporcionado no es válido.');
				}else{
					$.ajax({
						url: '../PHP/options.php',
						data: {
							change_email: true,
							new_email: text_email,
						},
						contentType:false,
						success:function (e){
							location.reload();
						}/*Final de Function de Ajax*/
					})/*Final de funcion total de Ajax*/
				}/*Final del Else*/
			})/*Final de la funcion submit para enviar un nuevo email*/

	/*FINAL PARA INGRESAR UN NUEVO EMAIL A LA BASE DE DATOS EN EL QUE EL USUARIO SE ENCUENTRA*/

	/*Ingresar un nuevo nombre a la base de datos*/

			$('#edit_name_button').click(function (){
				var name_text = $('#edit_name_text').val();

				if (name_text=="") {
					$(this).put_alert_append('Debes ingresar el nuevo nombre');
				}else{
					$.ajax({
						url:'../PHP/options.php',
						data:{
							change_name:true,
							new_name: name_text,
						},
						contentType:false,
						success:function (e){
							location.reload();
						}
					});
				}
			});

			/*Funcion para cambiar el apellido */
			$('#edit_lastname_button').click(function (){
				var text_lastname = $(this).prev().val();

				if (text_lastname =="") {
					$(this).put_alert_after('Es necesario introducir un nuevo apellido');					
				}else{
					$.ajax({
						url: '../PHP/options.php',
						data:{
							change_lastname:true,
							new_lastname:text_lastname
						},
						contentType:false,
						success:function (e){
							location.reload();
						}
					});
				}	
			});

});/*FINAL DE LA FUNCION READY*/