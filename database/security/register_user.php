<?php 

include $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';

if (isset($_POST['btn_register'])) {
    if (strlen($_POST['name']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['user']) >= 1 && strlen($_POST['password']) >= 1) {
		//Trae el último número ID de la base de datos "datos_usuarios" y suma 1
		//$last_id = mysqli_query($conex, "SELECT MAX(id) FROM datos_usuarios");
		//$last_id = mysqli_fetch_array($last_id);
		//$last_id = $last_id[0] + 1;
		$name = trim($_POST['name']);
		$user= trim($_POST['user']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$confirmpassword = trim($_POST['confirm_password']);
		$phone = trim($_POST['phone']);
		
		$consulta = "INSERT INTO users(name, user, email, phone, password) VALUES ('$name','$user','$email','$phone','$password')";
		$verificar_email = mysqli_query($conex, "SELECT	* FROM users WHERE email='$email'");
		$verificar_user= mysqli_query($conex, "SELECT * FROM users WHERE user='$user'");

		
		if (mysqli_num_rows($verificar_email) > 0){
			?> 
	    	<h3 class="message_php">El email ya está registrado</h3>
		   <?php
			exit;
		}else if (mysqli_num_rows($verificar_user) > 0){
			?> 
	    	<h3 class="message_php">El usuario ya está registrado</h3>
		   <?php
			exit;
		}
		

		if($password==$confirmpassword){
			$resultado = mysqli_query($conex,$consulta);
	    	if ($resultado) {
			?> 
	    	<h3 class="message_php">¡Ha inscrito correctamente el usuario!</h3>
		   <?php
		   //sleep(5);
		   $register_result= "Refistro exitoso";
		   echo "<script> window.location='../../index.php'; </script>";
		   
	    	} else {
            ?> 
            <h3>¡Ups ha ocurrido un error!</h3>
           <?php
           $error_a = mysqli_errno($conex). " Message ".mysqli_error($conex);
           echo $error_a;
			}

		} else {
			?> 
	    	<h3 class="message_php">Contraseña incorrecta</h3>
		   <?php
			exit;
		}
		#header('Location:/backend/index.php');
		//echo "<script> window.location='/backend/index.php'; </script>";
		echo "Usuario registrado";

	    
		
    }   else {
	    	?> 
	    	<h3>¡Por favor complete los campos!</h3>
		   <?php
		   $error_b = mysqli_errno($conex). " Message ".mysqli_error($conex);
           echo $error_b;
    }
}

?>