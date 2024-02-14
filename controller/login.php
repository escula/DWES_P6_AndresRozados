<?php
if(isset($_GET['username'])){
    include_once ('../Model/Usuario.php');
    $contrasena=$_GET['username'];
    $password=$_GET['password'];

    =new Usuario();
    $hashContra=password_hash($password,PASSWORD_ARGON2ID);

}