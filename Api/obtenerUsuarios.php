<?php
include_once ('../Model/Usuario.php');
header('Content-Type: application/json');

print_r(Usuario::obtenerUsuariosMenosAdmin());

//echo json_encode($usuarios);
