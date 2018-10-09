function show_text(text,focus="",classed = "alert") {
	$('.'+classed).html(text);
	$('.alert,.notice').show();
	if(focus!=""){
		$('#'+focus).focus();
	}
	
}
$(document).ready(function() {
	$('.alert').hide();
	/*CREACION DE VALIDACION DE FORMULARIO DE REGISTRO
	 *script id 0001
	 */
	
	/*Falta de campos requeridos, muestra de alerta y css border en campos correspondientes*/
	$('#reg_form input[type="text"],#reg_form input[type="password"]').blur(function() {
		if ($(this).val() == "") {
			$(this).css('border', '#6E3A3A solid 1px');
			$('.alert').html('Todos los campos en rojo son requeridos').fadeIn(400);
		} else if ($(this).val() != "") {
			$(this).css('border', 'black solid 1px');
		}
	});
	// Arreglando el formulario en caso de tener algun tipo de campo inválido o vacio
	$('#reg_form').submit(function(e) {

		e.preventDefault();
		var form = $(this);
		var url = form.attr('action');
				
		var user_expr = /^[a-zA-Z0-9_\.\-]+$/,expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]+$/,user = $('#user').val(),email = $('#email').val(),pass = $('#pass').val(),pass2 = $('#pass2').val(),name = $('#name').val(),lastname = $('#lastname').val();		
		if(user.length < 7){
			show_text('El campo usuario debe tener almenos siete caracteres','user');
		}else if (!user_expr.test(user)) { //Comprobacion de caracteres en el campo usuario	
			show_text('El campo usuario tiene caracteres no adminitidos','user');
		}else if (!expr.test(email)) { //Correo electronico no Admitido
			show_text('El campo email tiene caracteres no adminitidos','email');			
		}else if (name == "" || lastname == "") { //Comprobacion de caracteres en el usuario
			show_text('Debes ingresar el nombre y el apellido.','name');	
		} else if (pass == "" || pass2 == "") { //Campo de contraseñas vacias
			show_text('Debes completar los campos de contraseña','pass');
		} else if (pass !== pass2) { /*Coincidencia de Contraseñas*/
			show_text('Las contraseñas no coinciden','pass2');
			
		} else { // Envio de registro al servidor
			$.ajax({
				url: url,
				data: form.serialize(),				
				success:function (r_d){
					if(r_d=="ok"){
						$(form).put_alert_after('Se ha logrado agregar el registro',"",'notice');
					}else if(r_d=="email user"){
						$(form).put_alert_after('Cambia el nombre de usuario y email');
					}else if (r_d=="user"){
						$(form).put_alert_after('El nombre de usuario no está disponible');
					}else if(r_d=="email"){
						$(form).put_alert_after('El correo electrónico ingresado ya esta en uso.');
					}else{
						/*$(form).put_alert_after('Ha ocurrido un error al momento de registrar, intente nuevamente');*/
						alert(r_d);
					}
				}
			})
		}
		return false;
	}); /*Final del la funcion de Submit*/
	/*FINAL DE VALIDACION DE FORMULARIO DE REGISTRO script id 0001 */
});
