<?php 
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //echo "id recibido";
        //echo "$id";
        $query = "SELECT * FROM users WHERE id = $id";
        $result= mysqli_query($conex,$query);
       

        if (mysqli_num_rows($result) == 1) {
            $row= mysqli_fetch_array($result);
            $id= $row['id'];
            $name= $row['name'];
            $email= $row['email'];
            $user= $row['user'];
            $phone= $row['phone'];
            $password= $row['password'];
        }

    }

    if (isset($_POST['btn_update'])) {
        $id2 = $_GET['id'];
        $alter_name= trim($_POST['name']);
        $alter_user= trim($_POST['user']);
        $alter_phone= trim($_POST['phone']);
        $alter_email= trim($_POST['email']);
        $alter_password= trim($_POST['password']);

        $query2 = "UPDATE `users` SET `name`='$alter_name',`user`='$alter_user',`email`='$alter_email',`phone`='$alter_phone',`password`='$alter_password' WHERE id=$id2";

        $resultado_query=mysqli_query($conex, $query2);
        $error_a = mysqli_errno($conex). " Message ".mysqli_error($conex);
        if (!$resultado_query) {
            echo "Error al actualizar";
            echo $error_a;
        }else{
        echo "Usuario actualizado";
        header("Location:/learningcards/php/site/profile.php?id=$id2");
        }
        
    }
    //$previous = "javascript:history.go(-1)";
    //if(isset($_SERVER['HTTP_REFERER'])) {
    //$previous = $_SERVER['HTTP_REFERER'];
    //}

?>




