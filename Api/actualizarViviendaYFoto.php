<?php
include_once '../Model/Vivienda.php';
include_once '../Model/Foto.php';
include_once '../utils/procesarImagen.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
try{

    //declarando todas las variables
    $imagenesCache = $_FILES['imagenes'];
    $id_viviendaModificar = intval($_POST['id_vivienda']);
    $tipo = $_POST['tipo_vivienda'];
    $zona = $_POST['zona'];
    $direccion = $_POST['direccion'];
    $ndormitorios = $_POST['nDormitorios'];
    $precio = intval($_POST['precio']);
    $tamano = intval($_POST['tamano']);
    $extras =  $_POST['extras'];
    $observaciones =$_POST['observaciones'];
    print_r($imagenesCache);
    //Creando objeto vivienda para luego actualizrlo
    $viviendaActualizar = new Vivienda($tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras, $observaciones);
    $viviendaActualizar->ActualizarVivienda($id_viviendaModificar);

    //Guardando foto en BBDD
    for ($i=0;$i<count($imagenesCache['name']);$i++){
        $imagenInsertar =new Foto($id_viviendaModificar,$imagenesCache['name'][$i]);
        Foto::borrarFotosDeVivienda($id_viviendaModificar);
        $imagenInsertar->guardarFoto();
    }

    //guardando foto en gestor de archivos del servidor
    ProcesarImagen::guardarImagenesEnFicheros('../img','imagenes');

    //$tipo = "Casa";
    //$zona = "Este";
    //$direccion = "Calle Principal, 123";
    //$ndormitorios = 3;
    //$precio = 250000;
    //$tamano = 150;
    //$extras = "Jardín,Garaje,Piscina";
    //$observaciones = "Buena ubicación";

    // Crear un objeto Vivienda utilizando el constructor

    //echo json_encode($_FILES['images']);
    http_response_code(200);

}catch(Exception $a){

    http_response_code(400);
    echo json_decode("Error 400: Solicitud incorrecta");
}

