<?php

    session_start();
    if(isset($_SESSION['nombreUsuario'])){
        setcookie('ultimaSession',date('Y-m-d H:i:s'),time()+3000000,'/');
        session_unset();
        header('Location: ../view/login.php');
    }


?>