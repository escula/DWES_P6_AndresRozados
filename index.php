<?php
if($_SESSION['nombreUsuario']){

}else{
    header('Location: view/login.php');
}