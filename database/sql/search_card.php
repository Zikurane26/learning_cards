<?php
    //Elimina la carta seleccionada
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
    // Verificar si los parámetros llegaron por GET
    if (!isset($_GET["id"]) || !isset($_GET["id_card"])) {
        die("Faltan parámetros en la URL.");
    }
    // Obtener los valores de la URL
    $id = trim($_GET["id"]);
    $id_card = trim($_GET["id_card"]);
    // Consulta SQL para obtener o modificar la tarjeta
    $sql = "SELECT * FROM cards WHERE id = ?";
    $stmt = $conex->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $id_card);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $card = $result->fetch_assoc();
            //echo "<h2>Editar Tarjeta</h2>";
            //echo "<p>ID: " . htmlspecialchars($card["id"]) . "</p>";
            //echo "<p>Word: " . htmlspecialchars($card["word"]) . "</p>";
            //echo "<p>Description: " . ($card["description"]) . "</p>";
            // Aquí podrías agregar un formulario para editar
        } else {
            echo "⚠️ No se encontró la tarjeta.";
        }

        $stmt->close();
    } else {
        echo "❌ Error en la consulta.";
    }

    $conex->close();
?>