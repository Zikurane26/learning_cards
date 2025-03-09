<?php 
    //include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session_start.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/security/edit_profile.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="/learningcards/style/css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Perfil de Usuario</h2>
        <ul class="profile-info">
            <li><strong>Nombre:</strong> <?php echo $name; ?></li>
            <li><strong>Usuario:</strong> <?php echo $user; ?></li>
            <li><strong>Email:</strong> <?php echo $email; ?></li>
            <li><strong>Teléfono:</strong> <?php echo $phone; ?></li>
        </ul>
        <div class="buttons-container">
            <a class="edit-button" href="edit_profile.php?id=<?php echo $id; ?>">Editar</a>
            <a class="dashboard-button" href="dashboard.php">Dashboard</a>
        </div>
    </div>
</body>
</html>

