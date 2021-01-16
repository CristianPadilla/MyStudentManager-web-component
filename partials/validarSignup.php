<?php
$completo = true;
$completoMensaje = '';
if (isset($_POST['click'])) {
    if (empty($nombre)) {
        $completoMensaje = "<br/>
            <p>debe ingresar el nombre de usuario</p>";
        $completo = false;
    }
    if (empty($correo)) {
        $completoMensaje = "<br/>
            <p>debe ingresar el correo electronico</p>";
        $completo = false;
    }
    if (empty($nombreUsuario)) {
        $completoMensaje = "<br/>
            <p>debe ingresar el nombre de usuario</p>";
        $completo = false;
    }
    if (empty($documento)) {
        $completoMensaje = "<br/>
            <p>debe ingresar su numero de documento de identidad</p>";
        $completo = false;
    }
}