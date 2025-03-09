<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session_started.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
    
    //Si existe la variable de sesión "use_id" se redirige a la página principal
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/learningcards/js/validate_login.js"></script>
    <link rel="stylesheet" href="/learningcards/style/css/login.css">
    <title>Inicio de Sesión</title>
</head>
<body>
<!--Inicio del FORM------------------------------------------------------------>
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <br>
    <form action="database/security/login.php" id="form" method="POST">
        
        <?php 
        $message;
        if(isset($_SESSION['message'])) {
            ?><h3 class="message_php"><?php echo $_SESSION['message']; ?></h3>
        <?php } ?>
        
        <div class="input-group">
            <input type="email" name="email" placeholder="Email o Usuario" value="<?php if(isset($_COOKIE['email'])){
                echo $_COOKIE['email'];
            } ?>"><span class="line"></span>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password"  value="<?php if(isset($_COOKIE['password'])){
                echo $_COOKIE['password'];
            } ?>"><span class="line"></span>
        </div>
        <div class="options">
            <label>
                <input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["email"])) {
                ?> checked <?php } ?> class="checkbox" > Remember
            </label>
        </div>
        <button id="btn" type="submit" class="button" name="btn_login">Iniciar Sesión</button>
        <div class="options">
            <a class="button" href="php/site/register.php">Registrarse</a>
            <a href="./recuperar_contraseña.php" class="forgot"'>¿Olvidó su contraseña?</a>
        </div>
    </form>
</div>
</body>
</html>