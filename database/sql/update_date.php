<?php
//Actualiza la fecha de la carta actual
include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
$id = $_POST['id'];
$id_card = $_POST['id_card'];
$date = $_POST['date'];
//El sql actualizará la carta seleccionada de este sql $sql = "SELECT * FROM cards JOIN usercards ON cards.id = usercards.id_card WHERE usercards.id_user = $id"; 

if($date == "tomorrow"){
    $sql = "UPDATE usercards SET date = DATE_ADD(CURDATE(), INTERVAL 1 DAY) WHERE id_user = $id AND id_card = $id_card";
}else if($date == "aftertomorrow"){
    $sql = "UPDATE usercards SET date = DATE_ADD(CURDATE(), INTERVAL 3 DAY) WHERE id_user = $id AND id_card = $id_card";
}else if($date == "afterweek"){
    $sql = "UPDATE usercards SET date = DATE_ADD(CURDATE(), INTERVAL 7 DAY) WHERE id_user = $id AND id_card = $id_card";
}else{
    $sql = "UPDATE usercards SET date = $date WHERE id_user = $id AND id_card = $id_card";
}
if($conex->query($sql) === TRUE){
    echo "Date updated successfully";
}else{
    echo "Error: ".$sql."<br>".$conex->error;
}
$conex->close();
?>