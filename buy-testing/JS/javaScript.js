
/*MIS PROPIAS FUNCIONES DE JQUERY*/
(function($) {
	/*Comienzo de las funciones de Jquery*/
	$.fn.put_alert_append = function(text, add = "") {
		/*Primera Funcion, poner alerta dentro de el selector seleccionado*/
		$('.alert,.notice').remove();
		if (add == "") {
			$(this).append('<div class="alert"><p>' + text + '</p></div>');
		} else if (add != "") {
			$(this).append('<div class="alert"><p>' + text + '</p>' + add + '</div>');
		}
	};
	/*Final de la primera funcion*/

	$.fn.put_alert_after = function(text, add = "", clas ="alert") {
			/*Segunda Función, poner alerta despues del elemento seleccionado*/
			$('.notice,.alert').remove();
			if (add == "") {
				$(this).after('<div class="'+clas+'"><p>' + text + '</p></div>');
			} else if (add != "") {
				$(this).after('<div class="'+clas+'"><p>' + text + '</p>' + add + '</div>');
			}
		}
		/*Final de la segunda Fucncion*/

	$.fn.in_wrap = function(){
		$(this).wrap('<form></form>').closest('form').get(0).reset();
		$(this).unwrap();
	}
	
})(jQuery);

/*FINAL DE LAS FUNCIONES DE JQUERY PROPIAS*/


$(document).ready(function(){



/*VALIDACION DE LOGIN EN EL MENU DE NAVEGACION PRINCIPAL
			*	script id 0002
			*/
			
			
			$('#ing_form').submit(function(){
				$('.tr_alert').remove();
				var form_data = $(this).serialize();
				var user = $('#log_user').val();
				var pass = $('#log_pass').val();
				/*En caso de tener el campo de usuario y el campo de contraseña vacio, ejecutar:*/
				if (user == "" && pass=="") {	
					$('#ing_form table').append('<tr class="tr_alert"><td colspan="2"><div class="alert"><p>Ambos campos son necesarios</p></div></td></tr>');	
				
				/*En caso de tener el campo de usuario vacio ejecutar:*/
				}else if (user == "") {
				
				$('#ing_form table').append('<tr class="tr_alert"><td colspan="2"><div class="alert"><p>Introduce tu usuario</p></div></td></tr>');				
				
				/*En caso de tener el campo de contraseña vacio, ejecutar:*/
				}else if (pass == "") {
				
				$('#ing_form table').append('<tr class="tr_alert"><td colspan="2"><div class="alert"><p>Introduce tu Contraseña</p></div></td></tr>');				
				
				/*Envio de peticion a la base de datos en caso de encontrar algun regisro con la contraseña y usuario proporcionada*/

				}else{
					
					$.getJSON('../PHP/login.php',form_data,function(come_ing){
						if(come_ing=='valid'){
							alert(come_ing);
							location.reload();
							return true;

							/*En caso de no encontrar ninguna coherencia entre el usuario o la contraseña*/
						}else if (come_ing=='no valid') {
							
							$('.tr_notice').remove();
							$('#ing_form table').append('<tr class="tr_alert"><td colspan="2"><div class="alert"><p>Los datos introducidos no estan registrados.</p></div></td></tr>');
							return false;
							/*Final de el ultimo else en caso de encontrar o no la peticion de ingreso de usuario*/
						}else{
							alert(come_ing);
						}
					});
				}

				return false;//Return function Submit
			});//Final de tabla de ingresar NAV PRIMARY Script Id 0002	

/*SCRIPT: BUSQUEDA DE DATOS A LA BASE DE DATOS, ENVIO A EL ARCHIVO "php/search_product.php
*script id0003
*/
		$('#result_search').hide();
		// Click en Body para Cerrar la division de buscador
		$('body').click(function(){
			$('#result_search').hide();
			$('#result_search').click(function(e){
				e.stopPropagation();
			});
		});

		$('#key_menu #form_search input').bind('keyup',function(){
			// Escritura de datos
			var input_text = document.getElementById('search_text').value;			
			var divr = $('#result_search');
			
			if (input_text=="") {
				divr.hide();
			}else if(input_text.length >3){
				divr.show();
				$.ajax({
				// Envio de datos por medio de AJAX
				url: "../PHP/search_product.php",				
				data: 'search_text='+input_text,
				contentType: false,
				processData: false,
				success: function(data) {
					$('#result_search p').remove();
					$('#result_search').append(data.toLowerCase());
				}/*Final de la funcion de regreso de datos*/
			});/*Final de Ajax*/
			}
			
		});	/*Final de la funcion de Key UP*/

		/*FUncion para enviar a la pagina de busqueda*/

	

/*FINAL DE SCRIPT PARA BUSQUEDA DE DATOS EN LA BASE DE DATOS
FINAL DE SCRIPT ID 0003
*/

/*Nuevo Script*/
/*Entrega de datos para ingresar a la base de datos*/
/*Muestra de seccion de productos favoritos*/
$('.add_product').click(function(e){
        e.preventDefault();
        var linka_a = $(this).parent().attr('href'),
            t = linka_a.substring(linka_a.indexOf('=')+1,linka_a.length),
            n = $(this).parent().find('.title_post h4').html(),
            trx = $(this).parent().find('img').attr('src'),
            i = trx.substr(trx.indexOf('/',trx.indexOf('User'))+1,trx.length);
            button = $(this);
        
        $.ajax({
          url: '../PHP/operations_products.php',          
          data:{
            add_p: t,
            name_p: n,
            img_p: i
          },          
          contentType: false,
          success:function(proe){  

            if (proe=="add to favorite") {
              $('#favorite_link div').css('display','block').delay(1000).fadeOut();

              
            }else if(proe=="still add"){
              $(button).after('<span class="span_alert" style="display:block">Previamente agregado</span>').next('span').delay(2000).fadeOut();
            }else if(proe=="no sesion"){

            }
          }

        });

      });


			// Muestra de seccion produtos favoritos
      $('#favorite_link,.show_product_favorite').hover(function(){

        $('.show_product_favorite').toggle();
        
      });



		/*FINAL DE LA FUNCIÓN READY*/
	});
