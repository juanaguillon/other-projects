	$(document).ready(function(){

			$('#type_vendor').change(function(){
				var select = $(this).val();
				if(select=="ind"){
					$('#p_alt_name').html('Nombre Alternativo');
					$('#p_profile').html('Imagen de Perfil');
				}else if(select=="comp"){
					$('#p_alt_name').html('Nombre de organización');
					$('#p_profile').html('Logotipo');
				}
			});

			$('#img_profile').change(function(){
				
				if (this.files && this.files[0]) {

						var expr = ['.jpg', '.png', '.jpeg', '.gif'],
						true_ex = false,
						true_sz = false,					
						form = $('#create_vendor_form'),
						name = this.files[0].name,
						size = this.files[0].size;
					
					var extension = name.substring(name.lastIndexOf('.')).toLowerCase();
					


					for (var i = 0; i < expr.length; i++) {
					 	if(extension == expr[i] && size >= 2097152){
					 		true_ex = true;
					 		true_sz = true;
					 	}else	if(extension == expr[i]) {
					 		true_ex = true;
					 	}else if(size<=2097152){
					 		true_sz = true;
					 	} 
					 } 

					 if (!true_ex) {
					 		form.put_alert_append('Este tipo de archivo no es permitido');
					 		$(this).in_wrap();
					 }else if(!true_sz){
					 		form.put_alert_append('El archivo es demasiado grande. Máximo 2 mb');					 		
					 		$(this).in_wrap();
					 }else if(name.length>140){
					 		form.put_alert_append('El archivo tiene un nombre extenso.');
					 		$(this).in_wrap();
					 }

				}
			});

			$('#create_vendor_form').submit(function(){
				
				var t_alt = $('#i_alt_name').val();
				var desc = $('#i_desc').val();
				var img_profile = $('#img_profile')[0].value;
				var type_vendor = $('#type_vendor').val();
				if(type_vendor=="ind"){

					if (t_alt=="") {
					$(this).put_alert_append('Ingresa un nombre alternativo');
					return false;
					}else if (desc=="") {
						$(this).put_alert_append('Ingresa un texto representativo');
						return false;
					}else if(img_profile==""){
						$(this).put_alert_append('Ingresa una imagen de perfil');
						return false;
					}else{
						return;
					}

				}else if(type_vendor=="comp"){


					if (t_alt=="") {
						$(this).put_alert_append('Ingresa el nombre de compañia');
						return false;
					}else if (desc=="") {
						$(this).put_alert_append('Ingresa un texto representativo');
						return false;
					}else if(img_profile==""){
						$(this).put_alert_append('Ingresa una logotipo de tu organización');
						return false;
					}
				}
				return;
			});
			
		});