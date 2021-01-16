<?php
session_start();
require '../conextion2.php';
if (!isset($_SESSION['log'])) {
    header('location:login.php');
}
if (isset($_SESSION['curso'])) {
    $sql3 = "SELECT * FROM notas INNER JOIN  matricula
    ON matricula.id_matricula = notas.id_matricula INNER JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante
    WHERE matricula.id_curso = " . $_SESSION['curso']['id_curso'] . " AND matricula.estado=1";
    $requestNotas = $mysqli->query($sql3) or die($mysqli->error);
} else {
    header('location:phome.php');
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
            <div class="oculto">
                <!--SideMenu-->
                <section class="full-box nav-lateral">

                    <div class="full-box nav-lateral-bg show-nav-lateral"></div>

                    <div class="full-box nav-lateral-content" id="sidebar-container">
                        <div class="nombre text-center font-weight-bold py-4" style="color: white">
                            <?php echo $_SESSION['curso']['asignatura_curso'] ?> <br><small
                                class="profesion"><?php echo $_SESSION['curso']['codigo_curso'] . "-" . $_SESSION['curso']['grupo_curso'] ?></small>
                        </div>
                        <figure class="full-box nav-lateral-avatar">

                            <img src="../img/usuario.jpg" class="img-fluid" alt="Avatar">
                            <figcaption class="nombre text-center font-weight-bold">
                                <?php echo $_SESSION['log']['nombre'] ?> <br><small class="profesion">Docente</small>
                            </figcaption>

                        </figure>
                        <div class="full-box nav-lateral-bar"></div>
                        <nav class="full-box nav-lateral-menu">
                            <ul>
                                <li>
                                    <a href="home.php"><i class="fas fa-university fa-fw"></i> &nbsp;
                                        Inicio </a>
                                </li>

                                <li>
                                    <a href="asistencias.php" class="nav-btn-submenu"><i
                                            class="fas fa-user-edit fa-fw"></i>
                                        &nbsp;
                                        Asistencias </a>
                                </li>

                                <li>
                                    <a href="notas.php" class="nav-btn-submenu active"><i
                                            class="fas fa-file-alt fa-fw"></i>
                                        &nbsp;
                                        Notas </a>
                                </li>

                            </ul>
                            <br>
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
                        <a href="phome.php" class="ml-2 las-a">
                            < Ir a Cursos</a>
                                <center><a class="navbar-brand" href="home.php">MyStudentManager</a></center>
                                <a href="../logout.php" style="text-decoration:none" class="text-sc las-a"
                                    data-toggle="modal" data-target="#ModalCenter">Cerrar
                                    Sesión&nbsp;&nbsp;<img src="../img/power.png" width="30" height="30"
                                        class="d-inline-block align-top"></a>

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
                                        <span aria-hidden="true" style="outline: none;">&times;</span>
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
                                    </h1>
                                </center>

                                <!--<p class="lead text-muted ml-3 mr-4"> Seleccione cual de las opciones desea
                                            hacer.</p>-->
                            </div>
                        </section>

                        <section class="bajar-tabla">
                            <div class="card">
                                <div class="card-reporte row">
                                    <div class="col-r">
                                        Reporte de todo el curso: <a href="notascurso.php"
                                            class="btn btn-success btn-reportes px-3"><i
                                                class="fas fa-file-excel"></i></a>
                                    </div>
                                    <div class="col">
                                        Reporte promedios del curso: <a href="notaspromedio.php"
                                            class="btn btn-success btn-reportes px-3"><i
                                                class="fas fa-file-excel"></i></a>
                                    </div>
                                </div>
                            </div>
                            <br>
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
                                            <th>Nombre</th>
                                            <th>P1 (20%)</th>
                                            <th>P2 (20%)</th>
                                            <th>P3 (25%)</th>
                                            <th>P.I (20%)</th>
                                            <th>N.A (15%)</th>
                                            <th>N.F</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

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
                                            <td>" . $itemTem['nombre'] . "</td>
                                            <td>" . $pParcial . "</td>
                                            <td>" . $sParcial . "</td>
                                            <td>" . $tParcial . "</td>
                                            <td>" . $pIntegrador . "</td>
                                            <td>" . $nAdicionales . "</td>
                                            <td> " . round($notaFinal, 1, PHP_ROUND_HALF_UP) . " </td>
                                            <td>
                                                <div class='text-center'>
                                                    <div class='btn-group'>                                                                                               
                                            ";
                                                echo '
                                                        <button class="btn btn-primary btn-sm px-3" data-toggle="modal" data-target="#modalCRUD" 
                                                        name="btnEditar" onClick="selNotas(' . $itemTem['id_notas']  . ',' . $itemTem['primer_parcial'] . ',' . $itemTem['segundo_parcial']  . ',
                                                        ' . $itemTem['tercer_parcial'] . ',' . $itemTem['proyecto_integrador'] . ',' . $itemTem['notas_adicionales'] . ',' . "'" . $itemTem['nombre'] . "'" . ')">
                                                        <i class="fas fa-pencil-alt"></i></button>
                                                       
                                                        <form action="notastudent.php" method="POST">
                                                        <input class="btn btn-success btn-reportes" type="submit" value="Reporte">
                                                        <input name="idnotas" value="' . $itemTem['id_notas'] . '" type="hidden">
                                                        <input name="nombre" value="' . $itemTem['nombre'] . '" type="hidden">
                                                </form>';

                                                echo "
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                            }
                                        }
                                        ?>

                                    </tbody>

                                </table>
                                <br>

                            </div>
                    </div>

                    </section>

                    <!--Modal para CRUD-->
                    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: rgb(27, 84, 170)">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <h5 class="modal-title titulo-m" id="exampleModalLabel">
                                                    Notas del Estudiante
                                            </td>
                                            <td>
                                                <input type="text" id="nombre" class="form-control input-name" disabled>
                                                </h5>
                                            </td>
                                        </tr>

                                    </table>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        style="color: white; outline: none;"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formUsuarios" name="frmModificar" method="POST" action="modificaTblNotas.php">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Primer Parcial</label>
                                                    <input type="number" step="any" name="primer_parcial"
                                                        class="form-control" id="pp">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Segundo Parcial</label>
                                                    <input type="number" step="any" name="segundo_parcial"
                                                        class="form-control" id="sp">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Tercer Parcial</label>
                                                    <input type="number" step="any" name="tercer_parcial"
                                                        class="form-control" id="tp">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Proyecto Integrador</label>
                                                    <input type="number" step="any" name="proyecto_integrador"
                                                        class="form-control" id="pi">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Notas Adicionales</label>
                                                    <input type="number" step="any" name="notas_adicionales"
                                                        class="form-control" id="na">
                                                    <input type="hidden" name="id_notas" class="form-control" id="id">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="btnModificar" class="btn btn-dark">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--fin modals-->

                </div>
                <!--fin contenido-->

            </div>
        </div>

        </div>

    </main>
    <script>
    selNotas = function(id, pp, sp, tp, pi, na, pp2) {
        $('#id').val(id);
        $('#pp').val(pp);
        $('#sp').val(sp);
        $('#tp').val(tp);
        $('#pi').val(pi);
        $('#na').val(na);
        $('#nombre').val(pp2);
    };
    </script>

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
    </script>

</body>

</html>