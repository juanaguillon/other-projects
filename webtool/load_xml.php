<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Colors Scehemes</title>	
	<style>
		td{
			max-width: 400px;
		}
		tr{
			border:1px solid black;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	

	<script>
		"use strict";
		$(document).ready(function(){
						
			var table = $('.table'),			
			 		objstm = [],
					names = [];
					
			<?php $i = 0; foreach ( glob( "Sublime Text/TmTheme/*.tmTheme") as $file):?>
				objstm.push("<?php echo $file; ?>");				
			<?php endforeach;?>
			

			for (var i = 0; i < objstm.length; i++) {
				var xmlR = new XMLHttpRequest();				
						
						
				xmlR.onreadystatechange = function(){
					if (this.readyState == 4 && this.status == 200) {
						load_ccxml(this);
						
					}
				}
				xmlR.open('GET',objstm[i],true);
				xmlR.send();		


				names.push(objstm[i]);				
			}

			function toup(strg){
				return strg.charAt(0).toUpperCase() + strg.slice(1);
			}

			var sss = 1;
			function load_ccxml(xml){
				var xl = xml.responseXML,
					 div = $('#info'),					 
					 xmldoc = $(xl),
					 person = xmldoc.find('plist>dict>key'),
					 author,
					 comment,
					 auth1,
					 name1,
					 name;

				for (var i = 0; i < person.length; i++) {						
					var keyer = person[i].childNodes[0].nodeValue;

						if ( keyer == "author" ) {
							if ($(person[i]).next("string")[0].childNodes.length > 0) {
								auth1 = $(person[i]).next('string')[0].childNodes[0].nodeValue;						
								author = $(person[i]).next('string')[0].childNodes[0].nodeValue = toup(auth1);
								
								

								
							}
						}else if( keyer == "comment"){
							if ($(person[i]).next("string")[0].childNodes.length > 0) {
								comment = $(person[i]).next('string')[0].childNodes[0].nodeValue;	
							}
						}

						if (typeof author =="undefined") {
							author = "Anónimo";
						}else if ( typeof comment =="undefined"){
							comment = "Comentario no disponible";
						}
						var nn = 0;
						var prename = person[nn].childNodes[0].nodeValue;
						while (prename != "name") {
							nn++;
							prename = person[nn].childNodes[0].nodeValue;
						}
						name1 = $(person[nn]).next('string')[0].childNodes[0].nodeValue;
						name = $(person[nn]).next('string')[0].childNodes[0].nodeValue = toup(name1);

					}	
									
					table.append('<tr><td>'+sss+'</td><td>'+name+'</td><td>'+author+'</td><td>'+comment+'</td></tr>');				
					sss++;

					$('.send_table').click(function(){
						$.ajax({
							url: 'send_table.php',
							type: 'post',
							data:{
								nam: name,
								auth: author,
								comm: comment
							},
							success:function(e){
								$('.key').append("<p>"+e+"</p>");
							}
						})
					})
				}		
 			

		});

	</script>	
</head>
<body>
	<div class="info">
		<table class="table" border="1">			
		</table>
		<button class="send_table">Enviar Tabla</button>
	</div>
	<div class="key"></div>
</body>
</html>