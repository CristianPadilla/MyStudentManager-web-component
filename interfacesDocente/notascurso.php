<?php
session_start();
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= Notas.xls");
//header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//header("Content-Disposition: attachment; filename=notas.xls");  //File name extension was wrong
//header("Cache-Control: max-age=0");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Cache-Control: private",false);

require '../conextion2.php';

$sql3 = "SELECT * FROM notas INNER JOIN  matricula
    ON matricula.id_matricula = notas.id_matricula INNER JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante
    WHERE matricula.id_curso = " . $_SESSION['curso']['id_curso'] . " AND matricula.estado=1";
$requestNotas = $mysqli->query($sql3) or die($mysqli->error);

echo "<table id='example' class='table table-striped table-bordered' style='width:100%' border='1'>
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

if ($requestNotas->num_rows > 0) {

    while ($itemTem = $requestNotas->fetch_assoc()) {
        $pParcial = floatval($itemTem['primer_parcial']);
        $sParcial = floatval($itemTem['segundo_parcial']);
        $tParcial = floatval($itemTem['tercer_parcial']);
        $pIntegrador = floatval($itemTem['proyecto_integrador']);
        $nAdicionales = floatval($itemTem['notas_adicionales']);
        $notaFinal = ($pParcial * 0.2) + ($sParcial * 0.2) + ($tParcial * 0.25) + ($pIntegrador * 0.2) + ($nAdicionales * 0.15);
        echo "<tr style='text-align:center'>
                                            <td>" . $itemTem['nombre'] . "</td>
                                            <td>" . $itemTem['primer_parcial'] . "</td>
                                            <td>" . $itemTem['segundo_parcial'] . "</td>
                                            <td>" . $itemTem['tercer_parcial'] . "</td>
                                            <td>" . $itemTem['proyecto_integrador'] . "</td>
                                            <td>" . $itemTem['notas_adicionales'] . "</td>
                                            <td>" . round($notaFinal, 1, PHP_ROUND_HALF_UP) . "</td>                                            
                                        </tr>";
    }
}
echo "                                 
                         </tbody>
                        </table>";