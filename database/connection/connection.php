<?php 
function connect() { 
    if (!($conex = mysqli_connect("localhost","root", "","learningcards") or trigger_error(mysqli_error($link),E_USER_ERROR))) { 
        
       echo "Error conectando a la base de datos.";
       exit(); 
    }   /* check connection */
     if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
     }
    return $conex; 
 }

$conex= connect();
?>