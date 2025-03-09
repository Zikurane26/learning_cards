<?php 
    //include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session_start.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/security/edit_profile.php';
    $id=$_SESSION["use_id"];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="/learningcards/style/css/edit_profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Editar Perfil</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name?>">
            </div>
            <div class="input-group">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user" placeholder="User" value="<?php echo $user?>">
            </div>
            <div class="input-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email?>">
            </div>
            <div class="input-group">
                <label for="phone">Teléfono</label>
                <input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo $phone?>">
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password?>">
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $password?>">
            </div>
            <div class="buttons-container">
                <button type="submit" name="btn_update">Actualizar</button>
                <a class="cancel-button" href="profile.php?id=<?php echo $id?>">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
