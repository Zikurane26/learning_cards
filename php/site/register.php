<?php 
    //include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/learningcards/style/css/login.css">
    <title>Register</title>
</head>
<body>
<div class="login-container">
    <h2>Registrar</h2>
    <br>
    <form action="" method="POST">
        <div class="input-group">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="user" placeholder="User">
        </div>
        <div class="input-group">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        <button type="submit" name="btn_register">Register</button>
    </form>
    <div class="options">
    <a href="../../index.php">¿Ya tienes cuenta?</a>
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/security/register_user.php';
    ?>
    </div>
</div>
</body>
</html>