<?php
$confirmMessage = '';

require 'conextion2.php';
if (isset($_POST['click'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $documento = $_POST['documento'];

    // $documentoSeguro = password_hash($documento, PASSWORD_BCRYPT);

    include('partials/validarSignup.php');
    if ($completo) {
        $rol = $_POST['rol'];
        $sqlaux = "SELECT  id_rol FROM rol WHERE nombre_rol = '$rol'";
        $requestAux = $mysqli->query($sqlaux) or die($mysqli->error);
        while ($itemTemp = $requestAux->fetch_assoc()) {
            $idRol = $itemTemp['id_rol'];
        }



        $sql = "INSERT INTO usuarios (nombre,nombre_usuario,correo_electronico,documento_identidad, id_rol) 
        VALUES ('$nombre','$nombreUsuario','$correo','$documento','$idRol')";
        if ($mysqli->query($sql)) {
            $confirmMessage = "se realizó el registro correctamente";
        } else {
            $confirmMessage = $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Registrarse</title>
</head>

<body>
    <?php require 'partials/header.php' ?>
    <span><a href="login.php">o ingresa a la aplicacion</a></span>
    <form action="signup.php" method="POST">
        <?php
        include('partials/validarSignup.php');
        if (!empty($completoMensaje)) {
            echo $completoMensaje;
        }
        ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Nombre completo</label>
                <input name="nombre" type="text" class="form-control">

            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Correo electronico</label>
                <input name="correo" type="email" class="form-control" id="inputEmail4">

            </div>
        </div>
        <div class="form-group">
            <label for="inputCity">Nombre de usuario</label>
            <input name="nombreUsuario" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="inputPassword4">Documento de identidad</label>
            <input name="documento" type="number" class="form-control" id="inputPassword4">
        </div>
        <div class="form-group">
            <select name="rol" class="form-control">
                <option value="estudiante">estudiante</option>
                <option value="profesor">profesor</option>
            </select>
        </div>
        <button name="click" type="submit" class="btn btn-primary">registrarse</button>
        <?php if (!empty($confirmMessage)) {
            echo $confirmMessage;
            # code...
        } ?>
    </form>

</body>

</html>