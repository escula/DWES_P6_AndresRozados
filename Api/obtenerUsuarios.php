<?php
include_once ('../Model/Usuario.php');
header('Content-Type: application/json');

$usuarios=Usuario::obtenerUsuariosMenosAdmin();

echo json_encode($usuarios);
