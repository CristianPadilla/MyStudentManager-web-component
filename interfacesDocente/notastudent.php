<?php
session_start();
$name=null;
if(isset($_POST['nombre'])){
 $name=$_POST['nombre'];   
}

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= Notas ".$name.".xls");
//header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//header("Content-Disposition: attachment; filename=notas.xls");  //File name extension was wrong
//header("Cache-Control: max-age=0");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Cache-Control: private",false);

require '../conextion2.php';

$sql="SELECT * FROM notas INNER JOIN  matricula
ON matricula.id_matricula = notas.id_matricula INNER JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante
WHERE notas.id_notas = " . $_POST['idnotas'];

$sql3 = "SELECT * FROM notas 
    WHERE notas.id_notas = " . $_POST['idnotas'];
    $requestNotas = $mysqli->query($sql) or die($mysqli->error);

    echo "<table id='example' class='table table-striped table-bordered text-center' style='width:100%' border='1'>
                                    <thead>
                                        <tr style='text-align:center'>
                                            <th>Nombre</th>
                                            <th>P1 (20%)</th>
                                            <th>P2 (20%)</th>
                                            <th>P3 (25%)</th>
                                            <th>P.I (20%)</th>
                                            <th>N.A (15%)</th>
                                            <th>N.F</th>                                     
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    $fila = $requestNotas->fetch_array(MYSQLI_ASSOC);


                                if ($requestNotas->num_rows > 0) {
                                    $pParcial = floatval($fila['primer_parcial']);
                                    $sParcial = floatval($fila['segundo_parcial']);
                                    $tParcial = floatval($fila['tercer_parcial']);
                                    $pIntegrador = floatval($fila['proyecto_integrador']);
                                    $nAdicionales = floatval($fila['notas_adicionales']);
                                    $notaFinal = ($pParcial * 0.2) + ($sParcial * 0.2) + ($tParcial * 0.25) + ($pIntegrador * 0.2) + ($nAdicionales * 0.15);

                                    echo "<tr style='text-align:center'>
                                            <td>" . $fila['nombre'] . "</td>
                                            <td>" . $fila['primer_parcial'] . "</td>
                                            <td>" . $fila['segundo_parcial'] . "</td>
                                            <td>" . $fila['tercer_parcial'] . "</td>
                                            <td>" . $fila['proyecto_integrador'] . "</td>
                                            <td>" . $fila['notas_adicionales'] . "</td>
                                            <td>" .round($notaFinal, 1, PHP_ROUND_HALF_UP). "</td>                                            
                                        </tr>";                            
                                    echo"                                 
                                        </tbody>
                                    </table>";
                                }   
                                                                                    
?>