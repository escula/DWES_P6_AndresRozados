<?php
if(isset($_GET['username'])){
    $contrasena=$_GET['username'];
    $password=$_GET['password'];

    $hashContra=password_hash($password,PASSWORD_ARGON2ID);

}