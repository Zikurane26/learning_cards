<?php
#VALIDAR QUE VENGA UNA ACTION
if(!isset($_POST['btn_login'])){ECHO 'No viene acción adm_login'; EXIT;}

if(isset($_POST['btn_login'])){
    if(!isset($_POST['email'])){ECHO 'No viene email adm_login'; EXIT;}
    if(!isset($_POST['password'])){ECHO 'No viene contraseña adm_login'; EXIT;}

    if(!strlen($_POST['password']) > 1 && !strlen($_POST['password']) < 20) {ECHO 'ESCRIBA UNA CONTRASEÑA CORRECTA';
         #header('Location:'. $_SERVER['HTTP_REFERER']);
    }
?>
    
<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
    mysqli_set_charset($conex, "utf8");

    $sql_query = ' SELECT * FROM users WHERE (email="'.$_POST['email'].'" or user="'.$_POST['email'].'") and password = "'.$_POST['password'].'"';
    if (!$sql_login_validate=mysqli_query($conex,$sql_query)) {
        ECHO "HAY UN ERROR";
        EXIT;
    } 
    else {
        $row_get_login_validate=mysqli_fetch_assoc($sql_login_validate); 
        $num_rows = mysqli_num_rows($sql_login_validate);
        mysqli_free_result($sql_login_validate);
    }

?>
<?php
    //Si el input Checkbox es distinto de 0 entra a este IF
    if($num_rows > 0){
        session_start();

        $_SESSION['user_log_in'] = 1;
        $_SESSION['message']=null;
        $_SESSION['admin_name'] = $row_get_login_validate['user'];
        $_SESSION['use_id'] = $row_get_login_validate['id'];
        $_SESSION['use_nam'] = $row_get_login_validate['name'];
        $_SESSION['use_use'] = $row_get_login_validate['user'];
        $_SESSION['use_ema'] = $row_get_login_validate['email'];
        $_SESSION['use_cel'] = $row_get_login_validate['phone'];
        $_SESSION['use_pas'] = $row_get_login_validate['password'];
        if (!empty($_POST['remember'])) {
            setcookie("email", $row_get_login_validate['user'], time()+(10*365*24*60*90),"/");
            setcookie("password", $row_get_login_validate['password'], time()+(10*365*24*60*90),"/");
        } else { //Si no está activo el Checkbox cada cookie se establece en null / 0
            if(isset($_COOKIE['email'])){
                setcookie("email","",time()-(10*365*24*60*90),"/");
            }
            if(isset($_COOKIE['password'])){
                setcookie("password","",time()-(10*365*24*60*90),"/");
            }
        }
        
        if ($_SESSION['user_log_in'] == 1) {
            //echo "pasaste por acá, para inicio de sesion";
            echo "<script> window.location='/learningcards/php/site/dashboard.php'; </script>";
        } else {
            $_SESSION['message']="Usuario inactivo, ingrese a ¿Olvidó su contraseña? para activar su cuenta";
            //echo "<script> window.location='/learningcards/index.php'; </script>";
        }

    }else{
        session_start();
        ECHO 'Error component/security/adm_login.php';
        $_SESSION['message']="Usuario o contraseña incorrecta";
        setcookie("message", "Usuario o contraseña incorrectos", time()+(10*365*24*60*90));
        header('location:/learningcards/index.php');
        $message="Usuario o contraseña incorrecta";
    }
} 
?>