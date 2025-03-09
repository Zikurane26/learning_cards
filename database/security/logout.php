<?php
session_start();
//Se puede colocar cualquier nombre de variable de sesión
unset($_SESSION["use_id"]);
$_GET['option']='login';
session_destroy();
header("location:/learningcards/index.php");
?>