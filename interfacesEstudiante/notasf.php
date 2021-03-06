<?php
session_start();
require '../conextion2.php';
if (isset($_SESSION['log'])) {
    $sql = "SELECT * FROM notas INNER JOIN  matricula
    ON matricula.id_matricula = notas.id_matricula INNER JOIN curso ON curso.id_curso = matricula.id_curso
    WHERE matricula.id_estudiante = " . $_SESSION['log']['id_usuario'] . " AND matricula.estado=1";
    $requestNotas = $mysqli->query($sql) or die($mysqli->error);
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

    <!--DataTables-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" type="text/css" href="../style/home.css">
    <title>Notas</title>

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
                                    <a href="notasf.php" class="nav-btn-submenu active"><i
                                            class="fas fa-book-reader"></i>
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
                                <center>
                                    <h1 class="font-weight-bold">Notas
                                        <?php //echo $_SESSION['log']['nombre'] 
                                        ?>
                                    </h1>
                                </center>

                                <!--<p class="lead text-muted ml-3 mr-4"> Seleccione cual de las opciones desea
                                            hacer.</p>-->
                            </div>
                        </section>

                        <section class="bajar-tabla">
                            <table border="0" class="mini-tabla2">
                                <tr>
                                    <td class="espacio">
                                        <p><b>P1:</b> Primer Parcial</p>
                                    </td>
                                    <td class="espacio">
                                        <p><b>P2:</b> Segundo Parcial</p>
                                    </td>
                                    <td class="espacio">
                                        <p><b>P3:</b> Tercer Parcial</p>
                                    </td>
                                    <td class="espacio">
                                        <p><b>P.I:</b> Proyecto Integrador</p>
                                    </td>
                                    <td class="espacio">
                                        <p><b>N.A:</b> Notas Adicionales</p>
                                    </td>
                                    <td class="espacio">
                                        <p><b>N.F:</b> Nota Final</p>
                                    </td>
                                </tr>
                            </table>
                            <div class="container contenido">
                                <table id="example" class="table table-striped table-bordered bajar-tabla"
                                    style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Asignatura</th>

                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                            <th>P.I</th>
                                            <th>N.A</th>
                                            <th>N.F</th>
                                            <!--<th>Promedio</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['log'])) {
                                            if ($requestNotas->num_rows > 0) {

                                                while ($itemTem = $requestNotas->fetch_assoc()) {
                                                    $pParcial = floatval($itemTem['primer_parcial']);
                                                    $sParcial = floatval($itemTem['segundo_parcial']);
                                                    $tParcial = floatval($itemTem['tercer_parcial']);
                                                    $pIntegrador = floatval($itemTem['proyecto_integrador']);
                                                    $nAdicionales = floatval($itemTem['notas_adicionales']);
                                                    $notaFinal = ($pParcial * 0.2) + ($sParcial * 0.2) + ($tParcial * 0.25) + ($pIntegrador * 0.2)
                                                        + ($nAdicionales * 0.15);
                                                    echo "<tr>
                                                        <td>" . $itemTem['asignatura_curso'] . "</td>
                                                        <td>" . $pParcial . "</td>
                                                        <td>" . $sParcial . "</td>
                                                        <td>" . $tParcial . "</td>
                                                        <td>" . $pIntegrador . "</td>
                                                        <td>" . $nAdicionales . "</td>  
                                                        <td>" . round($notaFinal, 1, PHP_ROUND_HALF_UP) . "</td>                                                                              
                                                    </tr>";
                                                }
                                            }
                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>
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