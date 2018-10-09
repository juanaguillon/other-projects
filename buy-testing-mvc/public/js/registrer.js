$(document).ready(function(){


	"use strict";		

	$("#reg_form").submit(function(e){
		e.preventDefault();

		var email = document.getElementById("reg_email").value;
		var ext = /^[a-zA-Z0-9_\.\-]+@(gmail|outlook|hotmail|yahoo)+\.[a-zA-Z0-9]+$/;
		var inp = {"name":$('#reg_name'),"ap":$('#reg_ap'),"pass":$('#reg_pass'),"passt":$("#reg_passt")};		
		var alert = $(".div_alert");
		

		for(var key in inp){
			if (inp.hasOwnProperty(key)) {
				if (inp[key].val()=="") {
					var test = false;
				}else{
					var test = true;
				}
			}
		}

		var name = $("#reg_name").val(),ap = $("#reg_ap").val(),pass = $("#reg_pass").val(),passt = $("#reg_passt").val();



		if(!test){
			alert.html("<p>Todos los campos son obligatorios</p>");
			alert.css("display","block");
		}else if (!ext.test(email)) {
			alert.html("<p>El email que has ingresado es incorrecto</p>");
			alert.css("display","block");			
		}else if(pass !== passt){
			alert.html("<p>Las contraseñas no coinciden</p>");
			alert.css("display","block");
		}else{
			$(".modal_").css("display","block");
			$.ajax({
				url: "controllers/actions.php?registrer=new_user",
				method: "POST",
				data:{
					reg_name: name,
					reg_ap: ap,
					reg_email: email,
					reg_pass: pass
				},
				success:function(e){
					if (e=="ok") {
						window.location.href = "registrer?data=new_user";
					}else{
						var notice = $('.div_notice');
						notice.css("display","none");
						alert.html("<p>"+e+"</p>");
						alert.css("display","block");
						$(".modal_").css("display","none");
					}
				}
			});
		}
	});
});