<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session_start.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/sql/search_card.php';
    $id=$_SESSION["use_id"];
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit card</title>
    <link rel="stylesheet" href="/learningcards/style/css/edit_card.css">
</head>
<body>
    <div class="container">
        <h1>Editar carta</h1>
        <form action="../../database/security/edit_card.php" method="POST">
            <input type="hidden" name="id_card" value="<?php echo $id_card ?>">
            
            <div class="input-group">
                <label for="word">Word</label>
                <input type="text" name="word" id="word" value="<?php echo $card["word"] ?>">
            </div>
            
            <div class="input-group">
                <label for="description">Description</label>
                <textarea name="description" id="description"><?php echo $card["description"] ?></textarea>
            </div>
            
            <div class="buttons-container">
                <input type="submit" value="Editar" class="btn btn-edit">
                <a href="dashboard.php" class="btn btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>