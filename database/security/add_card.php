<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';

    if(isset($_POST['btn_add'])) {
        $word = trim(mysqli_real_escape_string($conex, $_POST['word']));
        $description = mysqli_real_escape_string($conex, $_POST['description']);
        $id = (int) $_GET['id']; // Convertir a entero para mayor seguridad

        // Validar que los campos no estén vacíos
        if(empty($word) || empty($description)) {
            echo "Please fill all the fields";
            return;
        }
    
        // Valida si la palabra ya existe en la base de datos para ese usuario
        $sql_word = "SELECT id FROM cards WHERE word = '$word' LIMIT 1";
        $result = mysqli_query($conex, $sql_word);

        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $card_id = $row['id'];

            //Consultamos si en usercards ya existe la carta para el usuario con el id $id
            $sql_usercards = "SELECT * FROM usercards WHERE id_user = $id AND id_card = $card_id";
            $result_usercards = mysqli_query($conex, $sql_usercards);

            if($result_usercards && mysqli_num_rows($result_usercards) > 0) {
                echo "The card already exists";
                return;
            }
        }

        // If que se ejecuta si la palabra no existe en cards para el usuario
        if ($result) {
            // La palabra no existe, insertarla en cards
            $sql = "INSERT INTO cards (word, description) VALUES ('$word', '$description')";
            if(mysqli_query($conex, $sql)) {
                // Obtener el ID de la palabra recién insertada
                $card_id = mysqli_insert_id($conex);
    
                // Insertar en usercards con la fecha actual
                $sql2 = "INSERT INTO usercards (id_user, id_card, date) VALUES ($id, $card_id, NOW())";
    
                if(mysqli_query($conex, $sql2)) {
                    echo "Card added successfully";
                    header('Location: /learningcards/php/site/dashboard.php');
                } else {
                    echo "Error: " . mysqli_error($conex);
                }
            } else {
                echo "Error: " . mysqli_error($conex);
            }
        }
    }
?>