$(document).ready(function(){

	$('#login_form').submit(function(es){

		es.preventDefault();
		var em = $('#login_email')[0].value, pass = $('#login_pass')[0].value;
		var alert = $('.div_alert');
		if (em=="" || pass=="") {
			
			alert.html("<p>Todos los campos son necesarios.</p>");
			alert.css("display","block");
		}else{
			$('.modal_').css("display","block");
			$.ajax({
				url: "controllers/actions.php?login=adb",
				method: "post",
				data:{
					email: em,
					pass: pass
				},
				success:function(e){
					if (e=="ok") {
						window.location.href = "home";
					}else{
						alert.html("<p>"+e+"</p>");
						alert.css("display","block");
					}
				}
			});
		}

	});
	

});