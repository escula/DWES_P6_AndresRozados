<?php

include_once '../Model/Usuario.php';
include_once '../utils/generarContrasenaRandom.php';
session_start();

if (isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] === 'admin') {
    if (isset($_GET['idUsuarioBorrar'])) {
        if (Usuario::borrarUsuario($_GET['idUsuarioBorrar'])) {

            header('Location: ../view/crearYborrarUsuarioView.php');
        } else {
            header('Location: ../view/errorOperacion.php');
        }
    }
} else {
    header('Location ../view/principalClienteView.php');
}