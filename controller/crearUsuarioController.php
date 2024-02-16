<?php
include_once '../Model/Usuario.php';
include_once '../utils/generarContrasenaRandom.php';
session_start();

if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario']==='admin'){
    if(isset($_GET['id_usuario'])){

        $contrasenaSinHash = generarContrasenaRandom();
        $passwordHash=password_hash($contrasenaSinHash,PASSWORD_ARGON2ID);
        $usuarioParaInsertar=new Usuario($_GET['id_usuario'],$passwordHash);
        if($usuarioParaInsertar->guardarUsuario()){
            $_SESSION['contrasenaUsuarioCreado']=$contrasenaSinHash;
            header('Location: ../view/crearYborrarUsuarioView.php');
        }else{
            header('Location: ../view/errorOperacion.php');
        }
    }
}else{
    header('Location ../view/principalClienteView.php');
}