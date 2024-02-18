<?php
include_once '../Model/Vivienda.php';
include_once '../Model/Foto.php';

if(isset($_GET['id_vivienda'])){
    header('Content-Type: application/json');
    $resultado=[];
    $resultado["vivienda"]=Vivienda::obtenerVivienda($_GET['id_vivienda']);
    $resultado["fotoVivienda"]=Foto::obtenerFotoDeVivienda($_GET['id_vivienda']);

    echo json_encode($resultado);
}
