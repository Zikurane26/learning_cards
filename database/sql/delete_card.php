<?php
    //Elimina la carta seleccionada
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
    $id = $_POST['id'];
    $id_card = $_POST['id_card'];
    //Valida si la carta tiene otro dueño en la tabla usercards, si tiene otro dueño solo se elimina la relación entre el usuario y la carta. Si no tiene otro dueño se elimina la carta de la tabla cards teniendo en cuenta la relación con la tabla usercards
    //La tabla usercards tiene una relación de uno a muchos con la tabla cards y la tabla users
    
    $sql = "SELECT * FROM usercards WHERE id_card = $id_card";
    $result = $conex->query($sql);
    if($result->num_rows > 1){
        $sql = "DELETE FROM usercards WHERE id_user = $id AND id_card = $id_card";
        if($conex->query($sql) === TRUE){
            echo "Only was delete the relation between the user and the card";
        }else{
            echo "Error: ".$sql."<br>".$conex->error;
        }
    }else{
        $sql = "DELETE FROM usercards WHERE id_user = $id AND id_card = $id_card";
        if($conex->query($sql) === TRUE){
            echo "Relation deleted successfully";
        }else{
            echo "Error: ".$sql."<br>".$conex->error;
        }
        $sql = "DELETE FROM cards WHERE id = $id_card";
        if($conex->query($sql) === TRUE){
            echo "Card deleted successfully";
        }else{
            echo "Error: ".$sql."<br>".$conex->error;
        }
    }
    $conex->close();
    
?>