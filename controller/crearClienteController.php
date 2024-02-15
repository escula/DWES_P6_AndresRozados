<?php
include_once '../Model/Cliente.php';
session_start();

if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario']==='admin'){
    if(isset($_GET['dni'])){
        $clienteParaInsertar=new Cliente($_GET['dni'],$_GET['nombre'],$_GET['apellidos'],$_GET['telefono'],$_GET['email']);
        print_r($clienteParaInsertar->insertarCliente());
        if($clienteParaInsertar->insertarCliente()){
                echo 'bien';
//            header('Location: ../view/principalAdminView.php');
        }else{
            echo 'mal';
//            header('Location: ../view/crearClienteView.php');
        }
    }
}else{
    header('Location ../view/principalClienteView.php');
}