<?php

    session_start();
    if(isset($_SESSION['nombreUsuario'])){

        setcookie('ultimaSession',$_SESSION['cuandoSeHaLogeado'],time()+3000000,'/');
        session_unset();
        header('Location: ../view/login.php');
    }


?>