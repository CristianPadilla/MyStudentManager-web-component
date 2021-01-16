<?php
session_start();
require '../conextion2.php';
if (!isset($_SESSION['log'])) {
    header('location:../login.php');
}

if (isset($_SESSION['curso'])) {
    $sql = "SELECT * FROM matricula INNER JOIN usuarios 
    ON usuarios.id_usuario = matricula.id_estudiante WHERE id_curso =" . $_SESSION['curso']['id_curso'] . " AND matricula.estado=1";
    $request = $mysqli->query($sql) or die($mysqli->error);
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
                                    <a href="#" class="nav-btn-submenu active"><i class="fas fa-user-edit fa-fw"></i>
                                        &nbsp;
                                        Asistencias </a>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fas fa-users"></i>&nbsp;Todas las
                                                asistencias</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="notas.php" class="nav-btn-submenu"><i class="fas fa-file-alt fa-fw"></i>
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
                                    data-toggle="modal" data-target="#ModalCenter">Cerrar Sesión&nbsp;&nbsp;<img
                                        src="../img/power.png" width="30" height="30"
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
                                    <h1 class="font-weight-bold">Asistencia

                                    </h1>
                                </center>

                                <!--<p class="lead text-muted ml-3 mr-4"> Seleccione cual de las opciones desea
                                            hacer.</p>-->
                            </div>
                        </section>

                        <section class="bajar-tabla">
                            <form action="asistencias.php" method="POST">
                                <table border="0" class="mini-tabla">

                                    <tr>
                                        <td>
                                            <p>Seleccione la clase:</p>
                                        </td>
                                        <td>
                                            <select id="clase" class='custom-select; form-group elcombo' name='clases'>
                                                <option selected class='form-control'></option>
                                                <option value='1'>Clase1</option>
                                                <option value='2'>Clase 2</option>
                                                <option value='3'>Clase 3</option>
                                                <option value='4'>Clase 4</option>
                                                <option value='5'>Clase 5</option>
                                                <option value='6'>Clase 6</option>
                                                <option value='7'>Clase 7</option>
                                                <option value='8'>Clase 8</option>
                                                <option value='9'>Clase 9</option>
                                                <option value='10'>Clase 10</option>
                                                <option value='11'>Clase 11</option>
                                                <option value='12'>Clase 12</option>
                                                <option value='13'>Clase 13</option>
                                                <option value='14'>Clase 14</option>
                                                <option value='15'>Clase 15</option>
                                                <option value='16'>Clase 16</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="submit" name="verClase"
                                                class="btn btn-warning btn-ir">Ir</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>

                            <div class="container contenido-tabla2">

                                <form action="asistencias.php" method="POST">

                                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Documento</th>
                                                <th>Asistencia</th>
                                            </tr>
                                        </thead>
                                        <!-- <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">Seleccione una clase</td></tr> -->
                                        <?php
                                        $clase = null;
                                        $valoresCkeckbox[] = null;
                                        $pos = 0;

                                        if (isset($_POST['verClase']) && $request->num_rows > 0) {
                                            $clase = "clase" . $_POST['clases'];
                                            while ($itemTemp = $request->fetch_assoc()) {
                                                if ($itemTemp[$clase] == 1) {
                                                    $estado = "checked";
                                                } else if ($itemTemp[$clase] == null) {
                                                    $estado = "";
                                                }
                                                echo "<tr>
                                                        <td>" . $itemTemp['id_matricula'] . "</td>
                                                        <td>" . $itemTemp['nombre'] . "</td>
                                                        <td>" . $itemTemp['correo_electronico'] . "</td>
                                                        <td>" . $itemTemp['documento_identidad'] . "</td>
                                                        <td>
                                                            <div class='centrado-check'>
                                                                <input type='checkbox' name='a[]' value='" . $itemTemp['id_matricula'] . "'   " . $estado . ">
                                                                <input type='hidden' name='clase' value='" . $clase . "'>
                                                                <input type='hidden' name='valores[]' value='" . $itemTemp['id_matricula'] . "'>
                                                            </div>
                                                        </td>
                                                    </tr>";
                                                // $valoresCkeckbox[$pos] =  intval($itemTemp['id_matricula']);

                                                // $pos++;
                                            }
                                        }
                                        ?>
                                    </table>
                                    <button type="submit" name="modificar" class="btn btn-warning btn-cambios">Guardar
                                        Cambios</button>
                                </form>

                            </div>

                            <?php
                            if (isset($_POST['modificar']) && isset($_POST['clase'])) {

                                if (isset($_POST['a'])) {
                                    foreach ($_POST['valores'] as $valor) {
                                        // echo $valor;
                                        foreach ($_POST['a'] as $id_matricula) {
                                            // echo $id_matricula;
                                            if ($valor == $id_matricula) {

                                                $sql = "UPDATE  matricula SET " . $_POST['clase'] . " = 1 WHERE id_matricula = " . $valor . "";
                                                $sentencia = $mysqli->query($sql) or die($mysqli->error);
                                                break;
                                            } else {
                                                $sql = "UPDATE  matricula SET " . $_POST['clase'] . " = NULL WHERE id_matricula = " . $valor . "";
                                                $sentencia = $mysqli->query($sql) or die($mysqli->error);
                                            }
                                        }
                                    }
                                } else {
                                    foreach ($_POST['valores'] as $valor) {
                                        $sql = "UPDATE  matricula SET " . $_POST['clase'] . " = NULL WHERE id_matricula = " . $valor . "";
                                        $sentencia = $mysqli->query($sql) or die($mysqli->error);
                                    }
                                }
                            }
                            ?>
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
            // dom: 'lfrtip',
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
                // "zeroRecords": "Seleccione una clase",
                // "sProcessing": "Seleccione una clase",
            }

        });
    });

    //$(document).ready(function() {
    // $('#example').DataTable();
    //});
    </script>

</body>

</html>