<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];
    
    // Aquí puedes procesar el contenido como necesites. Por ejemplo, guardarlo en una base de datos.
    
    echo 'Contenido recibido: ' . htmlspecialchars($content);
} else {
    //echo 'No se recibió ningún contenido.';
}
?>