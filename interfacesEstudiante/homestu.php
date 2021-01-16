<?php
session_start();
if (!isset($_SESSION['log'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/77e62b7a23.js" crossorigin="anonymous"></script>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="../style/home.css">
    <title>Home Estudiante</title>

</head>

<body>
    <main class="full-box main-container">
        <div class="d-flex">
            <div>
                <!--SideMenu-->
                <section class="full-box nav-lateral">
                    <div class="full-box nav-lateral-bg show-nav-lateral"></div>
                    <div class="full-box nav-lateral-content py-5" id="sidebar-container">
                        <figure class="full-box nav-lateral-avatar">
                            <img src="../img/usuario.jpg" class="img-fluid" alt="Avatar">
                            <figcaption class="nombre text-center font-weight-bold">
                                <?php echo $_SESSION['log']['nombre'] ?> <br><small class="profesion">Estudiante</small>
                            </figcaption>
                        </figure>
                        <div class="full-box nav-lateral-bar"></div>
                        <nav class="full-box nav-lateral-menu">
                            <ul>
                                <li>
                                    <a href="homestu.php" class="active"><i class="fas fa-university fa-fw"></i> &nbsp;
                                        Inicio </a>
                                </li>

                                <li>
                                    <a href="notasf.php" class="nav-btn-submenu"><i class="fas fa-book-reader"></i>
                                        &nbsp;
                                        Notas </a>
                                </li>

                                <li>
                                    <a href="asistenciastudent.php" class="nav-btn-submenu"><i
                                            class="fas fa-user-edit fa-fw"></i> &nbsp;
                                        Asistencias </a>
                                </li>
                                <br>
                                <br>
                                <br>
                            </ul>
                            <p class="nav__copyright">&copy; 2020, MyStudentManager.</p>
                        </nav>

                    </div>
                </section>
                <!--fin-->
            </div>
            <!-- nav -->
            <div class="pag-principal">
                <div class="w-100">
                    <nav class="navbar navbar-light; nav-fond; nav-a; border-bottom">
                        <a class="navbar-brand" href="homestu.php">MyStudentManager</a>
                        <a href="../logout.php" style="text-decoration:none" class="text-sc las-a" data-toggle="modal"
                            data-target="#ModalCenter">Cerrar
                            Sesión&nbsp;&nbsp;<img src="../img/power.png" width="30" height="30"
                                class="d-inline-block align-top"></a>
                        </a>
                    </nav>
                    <!--Fin Nav-->

                    <!-- ventana modal cerrar sesion-->
                    <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="ModalCenterTitle">
                                        <center>Cerrar Sesión</center>
                                    </h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <center>
                                        <h4>¿Esta Seguro <?php echo $_SESSION['log']['nombre']; ?> ?</h4>
                                        <br> Estas Apunto de cerrar tu sesion actual.
                                    </center><br>
                                </div>
                                <div class="modal-footer">
                                    <div class="dentro-modal">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <a href="../logout.php" class="btn btn-danger"><span class="icon-off">
                                                Salir</span></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- termina ventana modal -->

                    <!--contenido-->
                    <div id="content" class="contenedor-scroll">
                        <section class="py-3">
                            <div class="cabecera">
                                <div class="">
                                    <div class="">
                                        <center>
                                            <h1 class="font-weight-bold mb-3">Bienvenid@
                                                <?php echo $_SESSION['log']['nombre'] ?>
                                            </h1>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="container; dentro">
                                <!-- <p class="text-justify; texto">Las opciones son:</p> -->

                                <div class="full-box tile-container">

                                    <a href="notasf.php" class="tile">
                                        <div class="tile-tittle">Notas</div>
                                        <div class="tile-icon">
                                            <i class="fas fa-book-reader"></i>
                                        </div>
                                    </a>

                                    <a href="asistenciastudent.php" class="tile">
                                        <div class="tile-tittle">Asistencias</div>
                                        <div class="tile-icon">
                                            <i class="fas fa-user-edit fa-fw"></i>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </section>
                        <img src="../img/students.gif" alt="" width="460" height="325" class="img-home"
                            style="margin-left: 65%; margin-top: 3%;">
                    </div>
                    <!--fin contenido-->
                </div>
            </div>
        </div>

    </main>

</body>

</html>