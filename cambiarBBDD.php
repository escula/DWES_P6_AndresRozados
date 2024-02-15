<?php
include_once 'BBDD.php';

$bd=new BBDD();

$conexion=$bd->getConexion();
$pr=$conexion->prepare("UPDATE usuarios SET password = :passwordhash WHERE id_usuario = 'admin'");

$passwordHash=password_hash('1234',PASSWORD_ARGON2ID);

$pr->bindParam(':passwordhash', $passwordHash, PDO::PARAM_STR);

$pr->execute();

//if(password_verify('1234',$passwordHash)){
//    echo "dentro";
//}
