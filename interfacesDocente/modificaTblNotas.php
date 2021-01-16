<?php
require '../conextion2.php';
if (isset($_POST['btnModificar'])) {

    $pp = $_POST['primer_parcial'];
    $sp = $_POST['segundo_parcial'];
    $tp = $_POST['tercer_parcial'];
    $na = $_POST['notas_adicionales'];
    $pi = $_POST['proyecto_integrador'];
    $idNotas = $_POST['id_notas'];
    $sql = "UPDATE notas  SET primer_parcial= '$pp', segundo_parcial= '$sp', tercer_parcial= '$tp',
    notas_adicionales= '$na', proyecto_integrador= '$pi' WHERE id_notas = '$idNotas'";
    $update = $mysqli->query($sql) or die($mysqli->error);
    header('location:notas.php');
} 

// else if (!isset($_POST['btnModificar'])) {
//     header('location:notas.php');
// }