<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>a</title>
	<link rel="stylesheet" href="">
	<script src="../JS/jquery-3.2.1.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		$('button').click(function(){
			

			$.ajax({
			url: '../PHP/operations_products.php',
			data:{
				o: 'hola que tal'
			},
			success:function(pro){
				alert(pro);
				}
			})


		})

		

	});
	</script>
</head>
<body>
	<button>CLick</button>
</body>
</html>