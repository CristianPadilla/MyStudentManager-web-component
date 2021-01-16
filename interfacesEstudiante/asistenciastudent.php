<?php
require '../conextion2.php';
session_start();
if (isset($_SESSION['log'])) {
    $sql = "SELECT * FROM matricula INNER JOIN  curso
    ON curso.id_curso = matricula.id_curso 
    WHERE matricula.id_estudiante = " . $_SESSION['log']['id_usuario'] . " AND matricula.estado=1";
    $requestAsistencia = $mysqli->query($sql) or die($mysqli->error);
} else {
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
    </script>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" type="text/css" href="../style/home.css">
    <title>Asistencias</title>

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
                                    <a href="homestu.php"><i class="fas fa-university fa-fw"></i> &nbsp;
                                        Inicio </a>
                                </li>

                                <li>
                                    <a href="notasf.php" class="nav-btn-submenu"><i class="fas fa-book-reader"></i>
                                        &nbsp;
                                        Notas </a>
                                </li>

                                <li>
                                    <a href="asistenciastudent.php" class="nav-btn-submenu active"><i
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
                                <center>
                                    <h1 class="font-weight-bold">Asistencias
                                    </h1>
                                </center>

                                <!--<p class="lead text-muted ml-3 mr-4"> Seleccione cual de las opciones desea
                                            hacer.</p>-->
                            </div>
                        </section>

                        <section class="bajar-tabla">
                            <div class="container contenido-tabla2">

                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                                    <thead>
                                        <tr border="0">
                                            <th></th>
                                            <th colspan="16" class="text-center" style="font-size: 18px">
                                                Clase</th>
                                        </tr>

                                        <tr>
                                            <th>Asignatura</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                            <th>8</th>
                                            <th>9</th>
                                            <th>10</th>
                                            <th>11</th>
                                            <th>12</th>
                                            <th>13</th>
                                            <th>14</th>
                                            <th>15</th>
                                            <th>16</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $clase = null;
                                    $valoresCkeckbox[] = null;
                                    $pos = 0;

                                    if (isset($_SESSION['log']) && $requestAsistencia->num_rows > 0) {
                                        while ($itemTemp = $requestAsistencia->fetch_assoc()) {

                                            echo "<tr>
                                            <td>" . $itemTemp['asignatura_curso'] . "</td>";
                                            for ($i = 1; $i < 17; $i++) {

                                                if ($itemTemp['clase' . $i] == 1) {
                                                    echo "<td><img src='../img/checked.png'  width='20' height='20'></td>";
                                                } else {
                                                    echo "<td><img src='../img/x-button.png'  width='20' height='20'></td>";
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </section>
                    </div>
                    <!--fin contenido-->

                </div>
            </div>



        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
    //Idiomas con el 1er método   
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }

        });
    });

    //$(document).ready(function() {
    // $('#example').DataTable();
    //});
    </script>

</body>

</html>