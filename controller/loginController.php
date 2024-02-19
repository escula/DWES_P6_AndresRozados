<?php


include_once '../Model/Usuario.php';
if(session_status()===PHP_SESSION_DISABLED){
    session_start();
}
if(!isset($_SESSION['nombreUsuario'])){ // si no existe la session

    if(isset($_GET['username'])){
        include_once ('../Model/Usuario.php');
        $contrasenaForm=$_GET['username'];
        $passwordForm=$_GET['password'];
        $hashContra=password_hash($passwordForm,PASSWORD_ARGON2ID);

        $usuarioBD =Usuario::obtenerUsuario($_GET['username']);
        if($usuarioBD){
            $passwordBDHash=$usuarioBD->getPassword();

            if(password_verify($passwordForm,$passwordBDHash)){
                session_start();
                $_SESSION['nombreUsuario']=$_GET['username'];
                $_SESSION['cuandoSeHaLogeado']=date('Y-m-d H:i:s');
            }else{
                header('Location: ../view/loginMalIntroducidoView.php');
            }
        }else{
            header('Location: ../view/loginMalIntroducidoView.php');
        }
    }

    header('Location: ../view/principal.php');
}

// si no se mete a ningun header al final llega aquí o si a salido la verificación correctamente



