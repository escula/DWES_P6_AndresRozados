<?php
include_once ('../Model/Vivienda.php');

header('Content-Type: application/json');

$numeroViviendas= Vivienda::numeroDeViviendas();

echo json_encode($numeroViviendas);


