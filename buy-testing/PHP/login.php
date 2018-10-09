<?php 
		require_once 'functions.php';
		
			$user=$_GET["log_user"];
			$pass=$_GET["log_pass"];
			
			$sql_select="SELECT * FROM LOGIN WHERE USER=:user ";
			$prepare = $conect->prepare($sql_select);
			$prepare->execute(array(":user"=>$user));			
			$i_registrer = $prepare->fetch(PDO::FETCH_ASSOC);			
			$p_pass = $i_registrer['password'];

			$p_password = password_verify($pass,$p_pass);
			if ($p_password) {
				$sql_select2="SELECT * FROM LOGIN WHERE USER=:user AND PASSWORD =:password ";
				$reg = $conect->prepare($sql_select2);
				$reg->execute(array(":user"=>$user,":password"=>$p_pass));
				$in_login = $reg->fetch(PDO::FETCH_OBJ);
				$num = $reg->rowCount();
				if($num > 0){				

					//Se generara en caso de encontrar filas 

					// Se crea la sesion con el id seleccionado

					$session = $in_login->id;

					session_start();
					$_SESSION["username"]=$session;				
					$log_encode = json_encode('valid');
					echo $log_encode;
				}else{
					$log_encode = json_encode('esta mierda que pasa');
					echo $log_encode;
				}
			}else{					
					$log_encode2 = json_encode('no valid');
					echo $log_encode2;				
				}
		


	 ?>