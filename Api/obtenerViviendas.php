<?php
include_once ('../Model/Vivienda.php');
if(isset($_GET['numeroPagina'])){
    header('Content-Type: application/json');
    $viviendadePagina =Vivienda::obtenerViviendaPagina($_GET['numeroPagina']);
//    echo '<pre>';
//    print_r($viviendadePagina);
    echo json_encode($viviendadePagina);
}


if(isset($_get['numeroDeViviendas'])){
    header('Content-Type: application/json');

    $numeroViviendas=Vivienda::numeroDeViviendas();

    echo json_encode($numeroViviendas);

}
