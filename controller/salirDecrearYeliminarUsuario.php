<?php
session_start();

if (isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] === 'admin' && isset($_SESSION['contrasenaUsuarioCreado'])) {

    unset($_SESSION['contrasenaUsuarioCreado']);

}
header('Location: ../view/principal.php');
