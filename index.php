<?php
session_start();
require 'conextion2.php';
if (isset($_SESSION['log'])) {
    $request = $mysqli->query('SELECT id_usuario,nombre FROM usuarios WHERE documento_identidad=' . $_SESSION['log']['documento_identidad'] . '');
    $fila = $request->fetch_array(MYSQLI_ASSOC);

    $user = '';
    if ($request->num_rows > 0) {
        header('location:interfacesDocente/phome.php');
        // echo $fila['nombre_profesor'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>
        MyStudentManager
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/77e62b7a23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/index.css" />
</head>

<body>
    <!-- <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v9.0"
        nonce="mKrh90pf"></script> -->

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
            <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center">Bienvenido</h1>
                <br>
                <br>

                <p class="text-center">
                    <b>Para ingresar a la plataforma, por favor inicie sesión.</b>
                </p>
                <br>
                <a href="login.php" class="btn btn-md text-center"><b>Iniciar Sesión</b></a>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">

            <div class="left-col">
                <a href="http://www.uniajc.edu.co/">
                    <img src="./img/logo.png" class="logo"></a>
                <div class="social-media">
                    <p class="rights-text">Redes Sociales: </p>
                    <a href="https://www.instagram.com/uniajc_/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/user/UNIAJC"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/UNIAJC"><i class="fab fa-facebook-f"></i></a>
                </div>
                <p class="rights-text">&copy; 2020 Created by Cristian Lozada and Daniela Rojas | All rights
                    reserved.</p>
            </div>

            <div class="right-col">
                <a class="twitter-timeline" data-lang="es" data-width="450" data-height="410" data-theme="dark"
                    href="https://twitter.com/UNIAJC?ref_src=twsrc%5Etfw">Tweets by UNIAJC</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>

        </div>
    </footer>
</body>

</html>