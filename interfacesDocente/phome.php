<?php
session_start();
require '../conextion2.php';

if (isset($_SESSION['log'])) {


    $sql3 = "SELECT  curso.id_curso, curso.codigo_curso, curso.asignatura_curso, curso.grupo_curso, curso.hora_curso,
	curso.dia_curso, curso.id_programa, programa.nombre_programa FROM curso INNER JOIN programa 
	ON programa.id_programa = curso.id_programa WHERE id_usuario = " . $_SESSION['log']['id_usuario'] . " AND curso.estado=1";
    $requestCursos = $mysqli->query($sql3) or die($mysqli->error);
} else {
    header('location:../index.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/77e62b7a23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style/phome.css">
    <title>Cursos</title>

    <style>
    body {
        background-image: url("../img/Fondo-Phome.jpg");
    }
    </style>

</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-light; nav-fond; nav-a">
        <a class="navbar-brand" href="home.php" style="color: rgb(219, 217, 217)">
            <img src="../img/logou.png" width="30" height="40" class="d-inline-block align-top">
            &nbsp;&nbsp;MyStudentManager
            <a href="../logout.php" style="text-decoration:none; color: rgb(219, 217, 217)" class="text-sc">Cerrar
                Sesión&nbsp;&nbsp;<img src="../img/power.png" width="35" height="35"
                    class="d-inline-block align-top"></a>
        </a>
    </nav>
    <!--Fin Nav-->
    <div>
        <!-- <h3 class="titulo">Seleccione el Curso</h3> -->
    </div>
    <div>

        <div class="container-fluid">
            <div class="cuadro table-responsive">
                <caption>
                    <h3 class="titulo">
                        <center>Seleccione el Curso</center>
                    </h3>
                </caption>
                <table class="table table-dark table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>Codigo</th>
                            <th>Asignatura</th>
                            <th>Grupo</th>
                            <th>Día</th>
                            <th>Horario</th>
                            <th>Programa</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        if (isset($_SESSION['log'])) {
                            if ($requestCursos->num_rows > 0) {

                                while ($itemTem = $requestCursos->fetch_assoc()) {

                                    echo "<tr class='text-center'>
								<td>" . $itemTem['codigo_curso'] . "</td>
								<td>" . $itemTem['asignatura_curso'] . "</td>
								<td>" . $itemTem['grupo_curso'] . "</td>
                                <td>" . $itemTem['dia_curso'] . "</td>
                                <td>" . $itemTem['hora_curso'] . "</td>                               								
                                <td>" . $itemTem['nombre_programa'] . "</td>                                
                                <td>
                                    <form action='home.php' method='POST'>
                                        <input type='hidden' name='idCurso' value=" . $itemTem['id_curso'] . ">
                                        <input class='btn-ingresar' type='submit' name='irCurso' value='Entrar'><a href='home.php' class=''>
                                        </a></input>
                                    </form>
                                </td>
							</tr>";
                                }
                            }
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>