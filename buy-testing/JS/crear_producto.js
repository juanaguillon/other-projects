/*TODAS LAS FUNCIONES USADAS EN ESTE DOCUMENTO*/
/*Funcion para eliminar el valor o archivo que hay dentro del input seleccionado (i)*/

function del_input(i) {
	$(i).wrap('<form>').closest('form').get(0).reset();
	$(i).unwrap();
}


function create_canvas(){

			var input = $('#pr_image input');
				if (input.val()!=="") {
					$('#pr_image canvas').remove();
					$('#pr_image').append('<canvas id="canvas_pr" height="260" width="400"></canvas>');
					var canvas = $('#canvas_pr')[0];
					var ctx = canvas.getContext('2d');

					ctx.fillStyle = "white";
					ctx.fillRect(0,0,canvas.width,canvas.height);

					var img = $('#pr_image img')[0];
					var h_i = img.height;
					var w_i = img.width;

					var math = Math.floor(h_i)+70;

					if(w_i == math){
						ctx.drawImage(img,0,0,w_i,h_i);
					}else if(w_i > math){
						var ext = w_i - math;
						ctx.drawImage(img,0,ext / 2,canvas.width,canvas.height - (ext * 2));
					}else if(math > w_i){

						var ext = (w_i * canvas.height) / h_i;
						var i = canvas.width - ext;
						
						ctx.drawImage(img,i/2, 0 , ext , canvas.height);
					}	

				}

		}/*FINAL DE LA FUNCION create_canvas()*/



function send_product() {

		$.ajax({
			url: "../PHP/create_product.php",
			method: "POST",
			data: new FormData(document.getElementById('create_product')),
			contentType: false,				
			processData: false,
			success: function(data) {		
			
				$('.select_send_form').put_alert_after(data,"","notice");			
			}
		});
			
			if ($('#pr_image input').val()!=="") {
				create_canvas();
				var canvas = document.getElementById('canvas_pr');
					var datac = canvas.toDataURL('image/jpg');					
					$.ajax({
						url: "../PHP/create_product.php",
						method: "POST",
						data: {				
							image64: datac
						},						
						success: function(data) {						
									
						}
					});
			}
					
	
	

	$('#create_product')[0].reset();	
	$('.select_images img,.alert,.close_image').remove();
	
}

//Comienzo de la funcion para crear el canvas



/*FINAL DE LAS FUCNIONES LOCALES*/



$(document).ready(function() {

	$('button').click(function(e){
		e.preventDefault();
	});
	/*FUNCION VISTA INMEDIATA DE IMAGEN CARGADA PARA LOS PRODUCTOS
	 *Script 0001
	 */
	function readImage (f) {
		if (f.files && f.files[0]) {

			/*Ocultar el boton para elimnar la imagen actual*/


			var expr = ['.jpg', '.jpeg', '.gif', '.png'];
			var name = f.files[0].name;
			var sub = name.substring(name.lastIndexOf('.')).toLowerCase();
			var ext = false,
				sz = false;
			var size = f.files[0].size;
			for (var i = 0; i < expr.length; i++) {
				if (sub == expr[i] && size <= 2097152) {
					ext = true;
					sz = true;
				} else if (size <= 2097152) {
					sz = true;
				} else if (sub == expr[i]) {
					ext = true;
				} /*Final del if Anadido*/
			} /*Final del for en la funcion*/
			if (ext && sz) {
				$(f).parent().find('img,button').remove();
				var reader = new FileReader();
				reader.onload = function(e) {
								
					/*Creacion del boton para elimiar la imagen*/
					

					// Este código se aplicará únicamente si es la imagen principal que se esta procesando
					/*Carga de imagen en el input seleccionado*/		
					if ($(f).parent()[0].id=="pr_image") {
							$(f).parent().append('<img src="'+e.target.result+'" style="visibility:hidden"></img>');
							$('.show_image,#pr_image span').remove();
							$('#pr_image').before('<button class="show_image" type="button">Ver Imagen</button>');
							$('.show_image').click(function(){
								$('#pr_image').children('img').css('visibility','visible');
								
							})
					}else{
						$(f).parent().append('<img></img>').children('img').attr('src', e.target.result);
						$(f).parent().append('<button class="close_image"><i class="fa fa-times-circle"></i></button>');
					}
					
					/*Padding de el div padre de los elemenotos, para una mejor vista en cada una de las 	divisiones*/
					$('show')
					$('.close_image').on('click', function() {
						del_input(f);
					});
					$('.close_image').click(function() {
						$(this).prev().remove();						
						$(this).next('canvas').remove();
						$(this).remove();
					});
				}

				reader.readAsDataURL(f.files[0]);
			} else if (!ext) { /*Final del IF para poder insertar la imagen a peticion*/
				$('.select_images').after('<p class="alert">El archivo seleccionado tiene una extension inválida</p>');
				del_input(f);
			} else if (!sz) {
				$('.select_images').after('<p class="alert">La imagen seleccionada es demasiado grande</p>');
				del_input(f);
			} else {
				$('.select_images').after('<p class="alert">Ha ocurrido un error, intenta nuevamente</p>')
				del_input(f);
			}
			$('.alert').click(function() {
				$(this).remove();
			})
		} /*Final del if total...*/
	} /*Final de la funcion Total*/
	$('.file input,#pr_image input').change(function() {
			readImage(this);
		})
		/*FINAL DE LA FUNCION DE VISTA INMEDIANTA DE IMAGEN CARGADA PARA LOS PRODUCTOS
		 *Script 0001
		 */


	/*FUNCION PARA LOGRAR QUE EL FORMULARIO TENGA EL TITULO, Y HAYA IMAGENES CARGADAS
	 *Script 0002
	 */


	$('.file').hover(function() { /*Funcion para mostrar la casilla de cierre para input Files del formulario... Paso de hover.*/

		$(this.children[2]).show();
	}, function() {
		$(this.children[2]).hide();
	}); /*Final de la funcion de hover... */

	$('#create_product').submit(function(e) {
		

		e.preventDefault();

		
		/*Click de Submit en el formulario principal para crear un nuevo post, o producto*/
		var img_perm = true;

		for (var i = 0; i < $('.select_images input').length; i++) {

			/*Reccorre todos los inputs files en caso de encontrar un input file vacio, deshabilita la variable img_perm*/



			if ($('.select_images input')[i].value == "") {
				img_perm = false;
			}
		}

		/*Fin del FOR para recorrer los inputs*/
		if ($('.select_title input').val() == "") {

			/*En caso de estar el titulo Vacío*/

			$('#title').focus();
			$('.select_title .alert').remove();
			$('.select_title').append('<div><p>El titulo es requerido</p></div>').children('div').addClass('alert').append('<button class="close_alert"><i class="fa fa-times-circle"></i></button>');
			$('.close_alert').click(function() {
				$(this).parent().remove();
			}) /*Fin del primer if para alerta de titulo requerido*/


		} else if (!img_perm || $('.select_description textarea').val() == "") {
			var alerta = 'Tienes uno o mas campos del fomulario por completar. ¿Estás seguro que deseas continuar? Esto te puede traer desventajas futuramente';
			$('.select_description textarea').put_alert_after(alerta, '<button class="accept">Aceptar</button><button class="cancel">Cancelar</button>');
			$('.accept').click(function() {
				
				send_product();

				
			});
			$('.cancel').click(function(){
				$('.alert,.notice').remove();
			})
		} else {
	
			send_product();

		}



	}); /*Fin de la funcion submit en el formulario principal para crear post o producto.*/


	/*CODIGO DE CREAR DESCRIPCION DINÁMICA PARA LA DESCRIPCION*/
	/*SCRIPT ID 003*/

	$('.create_table').hide();
	var text_area = $('#text_area');
	function selectText(){		
		var text = "";
		if (window.getSelection) {
		text = text_area.get(0).value.substring(text_area.get(0).selectionStart,text_area.get(0).selectionEnd);
		}
		return text; 
	}	

	function close_tag(tag, style=""){

		text = selectText();
		var t_area = $('#text_area')[0];
		var before_t = t_area.value.substring(0,t_area.selectionStart);
		var after_t =  t_area.value.substring(t_area.selectionEnd, t_area.length);

		if(style===""){
			t_area.value = before_t + '<'+tag+'>'+ text +'</'+tag+'>' + after_t + '\n';
		}else if(style!==""){
			t_area.value = before_t + '<'+tag+' style="'+style+'">'+ text +'</'+tag+'>' + after_t + '\n';
		}

		t_area.focus();
		
		
	}	

	function insert_element(element) {
		var t_area = $('#text_area').val();		
		var new_value =  t_area + '<'+element+'></'+element+'>';			
		
		$('#text_area').val(new_value + '\n');
		$('#text_area').focus();
		
	}

var c_l = false;
$('#iframe_area').hide();
$('.change_look').click(function(){	
	if(!c_l){/*Ocurre esto si esta activado el modo HTML*/
		c_l = true;
		$(this).text('HTML');
		$('#text_area').hide();
		$('#iframe_area').show();
		
		$('.inner_buttons_edit').hide();
		
	}else if(c_l){/*Ocurre, si esta activado el modo VISUAL*/
		c_l = false;
		$(this).text('VISUAL');
		$('#iframe_area').hide();
		$('#text_area').show();
		$('.inner_buttons_edit').show();
		var val_iframe_body = $('#iframe_area').contents().find('body').html();
				$('#text_area').val(val_iframe_body);
				$('#text_area').html(val_iframe_body);				
		
}
		
});		


		$('#text_area').bind('keyup focus',function(){
			$(this).html($(this).val());

			var val_text_area = $(this).val();

			$('#iframe_area').contents().find('body').html(val_text_area);
			$('#iframe_area').contents().find('body')[0].contentEditable = true;		

			
		});


$('#b_e_negrita').click(function(){	
	close_tag('b');
});

$('#b_e_italic').click(function(){
	close_tag('i');
});

$('#b_e_underline').click(function(){
	close_tag('u');
});
$('#b_e_aright').click(function(){
	close_tag('div','text-align:right');
});
$('#b_e_aleft').click(function(){
	close_tag('div','text-align:left');
});
$('#b_e_acenter').click(function(){
	close_tag('div','text-align:center');
});

$('#b_i_element').change(function(){
	var value_e = $(this)[0].value; 

	if(value_e == "h1"){
		insert_element('h1');
	}else if(value_e=="h2"){
		insert_element('h2');
	}else if(value_e =="h3"){
		insert_element('h3');
	}else if(value_e =="h4"){
		insert_element('h4');
	}else if(value_e =="h5"){
		insert_element('h5');
	}else if(value_e =="h6"){
		insert_element('h6');
	}else if(value_e =="table"){
		$('.create_table').show();

		$('#send_create_table').one("click",function(){
			var tr = $('.create_table input[name*="tr"]').val();
			var td = $('.create_table input[name*="td"]').val();			
					

			if((tr || td) <= 0){
				$('.create_table').put_alert_append('Los valores deben ser mayores a "1"');
			}else if((tr || td) > 10){
				$('.create_table').put_alert_append('Los valores debenser menores a "11"');
			}else{
				var t_area = $('#text_area').val();	
				var td_value, tr_value;
				td_value = ' <td></td>';
				for (var i = 0; i < td-1; i++) {					
					td_value += '<td></td>';					
				}
				tr_value = '\n<tr>\n '+td_value+'\n</tr>\n';
				for (var xi = 0; xi < tr-1; xi++) {
						
						tr_value += '\n<tr>\n '+td_value+'\n</tr>\n';
						
				}
				var new_value = '<table border="1">\n<tbody>\n '+tr_value+'</tbody>\n</table>';
				
					$('#text_area').val(t_area+new_value);
				
				
			}
			$('.create_table').hide();
			$('#text_area').focus();
		});
	}
	$(this)[0].value = 'default';
});

	/*final de Script para agregar descripcion dinámica a el producto*/

});
/*FINAL DEL SCRIPT PARA LOGRAR INGRESAR TITULO Y ADVERTIR DE CAMPOS EN EL FORMULARIO DE CREAR PRODUCTO ESTAN VACIOS*/