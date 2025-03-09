<?php include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
// Verificar si los parámetros llegaron por POST
    if (!isset($_POST["id_card"]) || !isset($_POST["word"]) || !isset($_POST["description"])) {
        die("Faltan parámetros en la URL.");
    }
    // Obtener los valores del formulario
    $id_card = trim($_POST["id_card"]);
    $word = trim($_POST["word"]);
    $description = trim($_POST["description"]);
    // Consulta SQL para obtener o modificar la tarjeta
    $sql = "UPDATE cards SET word = ?, description = ? WHERE id = ?";
    $stmt = $conex->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $word, $description, $id_card);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "✅ Tarjeta actualizada.";
            header("Location:/learningcards/php/site/dashboard.php");
        } else {
            echo "⚠️ No se pudo actualizar la tarjeta.";
            header("Location:/learningcards/php/site/dashboard.php");
        }
        $stmt->close();
    } else {
        echo "❌ Error en la consulta.";
    }
    $conex->close();
?>