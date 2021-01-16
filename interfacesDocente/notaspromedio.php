<?php
session_start();
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= NotasPromedio.xls");


require '../conextion2.php';

$sql3 = "SELECT * FROM notas INNER JOIN  matricula
    ON matricula.id_matricula = notas.id_matricula INNER JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante
    WHERE matricula.id_curso = " . $_SESSION['curso']['id_curso'] . " AND matricula.estado=1";
$requestNotas = $mysqli->query($sql3) or die($mysqli->error);

echo "<table id='example' class='table table-striped table-bordered' style='width:100%' border='1'>
                                    <thead>
                                        <tr style='text-align:center'>
                                            
                                            <th>Promedio primer parcial (20%)</th>
                                            <th>Promedio segundo parcial(20%)</th>
                                            <th>Promedio tercer parcial(25%)</th>
                                            <th>Promedio proyecto integrador(20%)</th>
                                            <th>promedio notas adicionales(15%)</th>
                                            <th>Promedio nota final</th>
                                      
                                        </tr>
                                    </thead>
                                    <tbody>";

if ($requestNotas->num_rows > 0) {
    $promp1 = 0;
    $promp2 = 0;
    $promp3 = 0;
    $prompi = 0;
    $promna = 0;
    $promnf = 0;

    while ($itemTem = $requestNotas->fetch_assoc()) {
        $pParcial = floatval($itemTem['primer_parcial']);
        $sParcial = floatval($itemTem['segundo_parcial']);
        $tParcial = floatval($itemTem['tercer_parcial']);
        $pIntegrador = floatval($itemTem['proyecto_integrador']);
        $nAdicionales = floatval($itemTem['notas_adicionales']);
        $notaFinal = ($pParcial * 0.2) + ($sParcial * 0.2) + ($tParcial * 0.25) + ($pIntegrador * 0.2) + ($nAdicionales * 0.15);
        $promp1 += $pParcial;
        $promp2 += $sParcial;
        $promp3 += $tParcial;
        $prompi += $pIntegrador;
        $promna += $nAdicionales;
        $promnf += $notaFinal;
    }
    $promp1 /= $requestNotas->num_rows;
    $promp2 /= $requestNotas->num_rows;
    $promp3 /= $requestNotas->num_rows;
    $prompi /= $requestNotas->num_rows;
    $promna /= $requestNotas->num_rows;
    $promnf /= $requestNotas->num_rows;

    echo "<tr style='text-align:center'>
                                            <td>" . round($promp1, 1, PHP_ROUND_HALF_UP) . "</td>
                                            <td>" . round($promp2, 1, PHP_ROUND_HALF_UP) . "</td>
                                            <td>" . round($promp3, 1, PHP_ROUND_HALF_UP) . "</td>
                                            <td>" . round($prompi, 1, PHP_ROUND_HALF_UP) . "</td>
                                            <td>" . round($promna, 1, PHP_ROUND_HALF_UP) . "</td>
                                            <td>" . round($promnf, 1, PHP_ROUND_HALF_UP) . "</td>
                                            
                                        </tr>";
}
echo "                                 
                         </tbody>

                        </table>";