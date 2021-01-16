<?php
require 'conextion2.php';
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>
        Recuperar Usuario
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/77e62b7a23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/index.css" />
    <link rel="stylesheet" href="style/recupUsuario.css">

</head>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-md">
                    <div class="navbar-brand">MyStudentManager</div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactenos</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!---->
            <form action="Mailer.php" method="POST" class="login-form">
                <h1>Recuperación del nombre de usuario</h1>
                <label for="">Ingrese el correo electronico al cual se encuentra registrado.</label>
                <div class="txtb">

                    <input name="para" type="email" id="correo">
                    <span class="focus-efecto" data-placeholder="Email"></span>
                </div>

                <input name="click" type="submit" class="logbtn" value="Recuperar" id="enviar">

            </form>
            <?php
                if(isset($_SESSION["msg"])){
                echo $_SESSION["msg"];
                session_destroy();
                }
            ?>
            <!--fin-->
        </div>
    </div>
    <script type="text/javascript">
    $(".txtb input").on("focus", function() {
        $(this).addClass("focus");
    });

    $(".txtb input").on("blur", function() {
        if ($(this).val() == "")
            $(this).removeClass("focus");
    });
    </script>

    <script>
    $("#enviar").click(function(e) {
        //e.preventDefault();
        var correo = $("#correo").val();

        if (correo == '') {
            alert("Debe ingresar un correo electronico");
        }
    });
    </script>
</body>

</html>