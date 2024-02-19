
<?php
include_once '../Model/Vivienda.php'
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    $tipoVivienda = isset($_GET['tipo_vivienda']) ? $_GET['tipo_vivienda'] : "";
    $zona = isset($_GET['zona']) ? $_GET['zona'] : "";
    $dormitorios = isset($_GET['dormitorios']) ? $_GET['dormitorios'] : "";
    $precio = isset($_GET['precio']) ? $_GET['precio'] : "";
    $tamano = isset($_GET['tamano']) ? $_GET['tamano'] : "";

    $sentencia="SELECT * FROM viviendas WHERE";
    $sentenciaDEspuesDeWhere="";
    foreach ($_GET as $key => $value) {
        if (!$value == "") {
            $sentenciaDEspuesDeWhere=$sentenciaDEspuesDeWhere." and ".$value;
        }
    }
    $sentenciaDEspuesDeWhere = substr($sentenciaDEspuesDeWhere, 4);

    $sentencia=$sentencia.$sentenciaDEspuesDeWhere;
    echo $sentencia;

    $viviendadePagina =Vivienda::obtenerViviendaPaginaConFiltro($sentencia);
    $fotos=[];
    for($i = 0; $i < count($viviendadePagina); $i++) {
        array_push($fotos,Foto::obtenerFotoDeVivienda($viviendadePagina[$i]['id']));

    }
    $resultado=['viviendas'=>$viviendadePagina,'fotosViviendas'=>$fotos];
     $json=json_encode($resultado);
    echo substr($json, 6);

}