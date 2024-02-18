<?php
include_once ('../Model/Vivienda.php');
include_once ('../Model/Foto.php');
if(isset($_GET['numeroPagina'])){

    header('Content-Type: application/json');
    $viviendadePagina =Vivienda::obtenerViviendaPagina($_GET['numeroPagina']);
    $fotos=[];
    for($i = 0; $i < count($viviendadePagina); $i++) {
    array_push($fotos,Foto::obtenerFotoDeVivienda($viviendadePagina[$i]['id']));

    }
    $resultado=['viviendas'=>$viviendadePagina,'fotosViviendas'=>$fotos];
    echo json_encode($resultado);
}



