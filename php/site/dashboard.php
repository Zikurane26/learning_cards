<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/function/session_start.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/learningcards/database/connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/learningcards/js/validate_login.js"></script>
    <link rel="stylesheet" href="/learningcards/style/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
                <?php $id=$_SESSION["use_id"];
                echo $id;
                ?>
            <nav>   
                <a href="profile.php?id=<?php echo $id?>">Profile</a>
                <a href="add_card.php?id=<?php echo $id?>">Add Cards</a>
                <a href="../../database/security/logout.php">Cerrar Sesion</a>
            </nav>
        </div>
        <p>Bienvenido a la pagina de inicio</p>
        <p>Esta es una pagina segura</p>
        <p>Esta pagina solo puede ser vista por usuarios registrados</p>
        <?php 
            print_r($_SESSION);
            print_r($_COOKIE);
        ?>
        <div id="cards" class="cards-container">
            <?php 
                $sql = "SELECT * FROM cards JOIN usercards ON cards.id = usercards.id_card WHERE usercards.id_user = $id and usercards.date <= CURDATE()";
                $result = mysqli_query($conex, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div id='".$row['id']."' class='card'>";
                        //aqui se almacena el id de esta variable en el script var id_card = cards.eq(current).attr("id_card");
                        //echo "<h2>".$row['id_card']."</h2>";
                        echo "<h3>".$row['word']."</h3>";
                        echo "<p>".$row['description']."</p>";
                        echo "</div>";
                    }
                }else{
                    echo "No hay cartas";
                }
                
            ?>
        </div>
        
        <div class="buttons-container">
            <button id="previous">Anterior</button>
            <button id="tomorrow">Mañana</button>
            <button id="aftertomorrow">3 días</button>
            <button id="afterweek">Una semana</button>
            <input type="date" name="date" id="date">
            <button id="delete">Eliminar</button>
            <button id="next">Siguiente</button>
            <button id="edit">Editar</button>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var cards = $("#cards div");
            var current = 0;
            cards.hide();
            cards.eq(current).show();
            //Muestra el id_card en consola
            var id_card = cards.eq(current).attr("id");
            console.log(id_card);
            //Convertimos la función que hace el #next para poder usala en el #tomorrow, #aftertomorrow y #afterweek
            function next(){
                cards.eq(current).hide();
                current = (current + 1) % cards.length;
                cards.eq(current).show();
                //Muestra el id_card en consola
                var id_card = cards.eq(current).attr("id");
                console.log(id_card);
                //limpia el campo de fecha
                $("#date").val("");
            }
            //Si presiona #next pasará a la siguiente carta
            $("#next").click(function(){
                next();
            });
            $("#previous").click(function(){
                cards.eq(current).hide();
                current = (current - 1 + cards.length) % cards.length;
                cards.eq(current).show();
                //Muestra el id_card en consola
                var id_card = cards.eq(current).attr("id");
                console.log(id_card);
                //limpia el campo de fecha
                $("#date").val("");
            });
            $("#tomorrow").click(function(){
                var id = <?php echo $id?>;
                var id_card = cards.eq(current).attr("id");
                
                $.ajax({
                    url: "/learningcards/database/sql/update_date.php",
                    type: "POST",
                    data: {id: id, id_card: id_card, date: "tomorrow"},
                    success: function(response){
                        console.log(response);
                        next();
                    }
                });
            });
            $("#aftertomorrow").click(function(){
                var id = <?php echo $id?>;
                var id_card = cards.eq(current).attr("id");
                $.ajax({
                    url: "/learningcards/database/sql/update_date.php",
                    type: "POST",
                    data: {id: id, id_card: id_card, date: "aftertomorrow"},
                    success: function(response){
                        console.log(response);
                        next();
                    }
                });
            });
            $("#afterweek").click(function(){
                var id = <?php echo $id?>;
                var id_card = cards.eq(current).attr("id");
                $.ajax({
                    url: "/learningcards/database/sql/update_date.php",
                    type: "POST",
                    data: {id: id, id_card: id_card, date: "afterweek"},
                    success: function(response){
                        console.log(response);
                        next();
                    }
                });
            });
            $("#date").change(function(){
                var id = <?php echo $id?>;
                var id_card = cards.eq(current).attr("id");
                var date = $("#date").val();
                console.log(date, id, id_card);
                $.ajax({
                    url: "/learningcards/database/sql/update_date.php",
                    type: "POST",
                    data: {id: id, id_card: id_card, date: date},
                    success: function(response){
                        console.log(response);
                        next();
                    }
                });
            });
            $("#delete").click(function(){
                var id = <?php echo $id?>;
                var id_card = cards.eq(current).attr("id");
                console.log(id, id_card);
                $.ajax({
                    url: "/learningcards/database/sql/delete_card.php",
                    type: "POST",
                    data: {id: id, id_card: id_card},
                    success: function(response){
                        console.log(response);
                        //recargamos la página
                        location.reload();
                        next();
                    }
                });
            });
            //El siguiente boton es para editar una carta, enviando el id de la carta a la pagina de edicion
            $("#edit").click(function() {
                var id = "<?php echo $id; ?>"; // ID desde PHP
                var id_card = cards.eq(current).attr("id"); // ID de la tarjeta seleccionada

                if (!id_card) {
                    alert("⚠️ No se encontró la tarjeta actual.");
                    return;
                }

                // Construir la URL con los parámetros en la barra de direcciones
                var url = "/learningcards/php/site/edit_card.php?id=" + encodeURIComponent(id) + "&id_card=" + encodeURIComponent(id_card);
                
                // Redirigir a la URL generada
                window.location.href = url;
            });


        });
    </script>
    
    

</body>
</html>