<?php
require 'conextion2.php';

session_start();
$mensaje = '';
if (isset($_POST['click'])) {
    $nombreUsuario = $_POST['nombreUsuario'];
    $documento = $_POST['documento'];
    include('partials/validarLogin.php');
    if ($completo) {
        // include('conextion2.php');
        $sql1 = "SELECT  id_usuario,  nombre, nombre_usuario,
        correo_electronico, documento_identidad, id_rol, estado FROM usuarios WHERE nombre_usuario = '$nombreUsuario'";
        $request = $mysqli->query($sql1) or die($mysqli->error);
        $fila = $request->fetch_array(MYSQLI_ASSOC);

        if ($request->num_rows > 0 && ($documento == $fila['documento_identidad']) && intval($fila['estado'])==1) {
            
            // $_SESSION['user_id'] = $fila;
            $_SESSION['log'] = $fila;
            $id_rolp=0;
            $id_role=0;
            $sqle = "SELECT id_rol FROM rol WHERE nombre_rol='estudiante'";
            $sqlp = "SELECT id_rol FROM rol WHERE nombre_rol='profesor'";
            $requeste = $mysqli->query($sqle) or die($mysqli->error);
            $filae = $requeste->fetch_array(MYSQLI_ASSOC);
            $requestp = $mysqli->query($sqlp) or die($mysqli->error);
            $filap = $requestp->fetch_array(MYSQLI_ASSOC);
            if($requeste->num_rows>0 ){
                $id_role = $filae['id_rol'];
            }
            if($requestp->num_rows>0 ){
                $id_rolp = $filap['id_rol'];
            }
            echo $id_role . $id_rolp;
            if($_SESSION['log']['id_rol']==$id_role){
                header('location:interfacesEstudiante/homestu.php');
            } else if ($_SESSION['log']['id_rol']==$id_rolp){
               header('location:interfacesDocente/phome.php'); 
            } else {
                echo "<script>alert('Este usuario no tiene acceso a la aplicación');</script>";
                // $mensaje = "<script>swal('Este usuario no tiene acceso a la aplicación','You clicked the button!','warning');</script>";
                session_destroy();
                // $mensaje = 'Este usuario no tiene acceso a la aplicación';
            }            
        } else {
            echo "<script>alert('El usuario no existe o el número de documento es incorrecto');</script>";
            // $mensaje = 'El usuario no existe o la contraseña es incorrecta';
        }
    } else {
        $mensaje = $completoMensaje;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>
        Iniciar Sesión
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/77e62b7a23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/index.css" />
    <link rel="stylesheet" href="style/login.css">

    <style>
    #boton {
        cursor: pointer;
        width: 30px;
    }
    </style>

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
            <!--Login-->
            <form action="login.php" method="POST" class="login-form" id="formulario">
                <h1>Iniciar Sesión</h1>

                <div class="txtb">
                    <input name="nombreUsuario" type="text" id="nUsuario">
                    <span class="focus-efecto" data-placeholder="Usuario"></span>
                </div>
                <div class="txtb">
                    <input name="documento" type="password" id="myInput">
                    <span class="focus-efecto" data-placeholder="Documento">
                    </span>
                    <img src="./img/ojo.png" id="boton" class="ojo">
                </div>

                <input name="click" type="submit" class="logbtn" value="Ingresar" id="enviar">

                <?php //if (isset($_POST['click'])) : ?>
                <p><?php //echo $mensaje ?></p>
                <?php //endif; ?>


                <div class="bottom-text">
                    <a href="recupUsuario.php">¿Olvidaste tu nombre de usuario? </a>
                </div>
            </form>

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
            var boton = document.getElementById('boton');
            var input = document.getElementById('myInput');

            boton.addEventListener('click', mostrarC);

            function mostrarC() {
                if (input.type == "password") {
                    input.type = "text";
                    boton.src = "./img/ojo2.png";

                    setTimeout("ocultar()", 3000)
                } else {
                    input.type = "password";
                    boton.src = "./img/ojo.png";
                }
            }

            function ocultar() {
                input.type = "password";
                boton.src = "./img/ojo.png"
            }
            </script>

            <script>
            $("#enviar").click(function(e) {
                //e.preventDefault();
                var nUsuario = $("#nUsuario").val();
                var myInput = $("#myInput").val();

                if (nUsuario == '' || myInput == '') {
                    alert("Debe ingresar un usuario y/o documento de identidad");
                    // swal({
                    //     title: "Debe ingresar un usuario y/o documento de identidad",
                    //     //type: "warning",
                    //     //text: "Todos o algunos de los campos estan vacios",
                    //     icon: "error", //tipos: warning, succes, error.
                    //     button: "Ok",
                    // });
                }
            });
            </script>

            <!--fin login-->
        </div>
    </div>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
</body>

</html>