<?php
include_once '../Model/Vivienda.php';
include_once '../Model/Foto.php';
include_once '../utils/procesarImagen.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $tipo = $_POST['tipo_vivienda'];
    $zona = $_POST['zona'];
    $direccion = $_POST['direccion'];
    $ndormitorios = $_POST['dormitorios'];
    $precio = intval($_POST['precio']);
    $tamano = intval($_POST['tamano']);

    if(isset($_POST['extras'])){
        $extras="";

        for ($i=0;$i<count($_POST['extras']);$i++) {
            $extras=$extras.','.$_POST['extras'][$i];
        }
        //quitando la coma que se genera al principio
        $extras= substr($extras, 1);
    }else{
        $extras = '';
    }
    $observaciones = $_POST['observaciones'];


//    echo $tipo ;
//    echo '</br>';
//    echo $zona;
//    echo '</br>';
//    echo $direccion;
//    echo '</br>';
//    echo $ndormitorios;
//    echo '</br>';
//    echo $precio;
//    echo '</br>';
//    echo $tamano;
//    echo '</br>';
//    echo $extras;
//    echo '</br>';
//    echo $observaciones;
//    echo '</br>';
    $imagenesCache = $_FILES['imagenes'];

    $viviendaIntoducir= new Vivienda($tipo,$zona,$direccion,$ndormitorios,$precio,$tamano,$extras,$observaciones);
    $viviendaIntoducir->guardarVivienda();

    //Guardando foto en BBDD
    $ultimoIdVivienda=Vivienda::obtenerIdMasAlto();

    for ($i=0;$i<count($imagenesCache['name']);$i++){
        $imagenInsertar =new Foto(intval($ultimoIdVivienda['id_mas_alto']),$imagenesCache['name'][$i]);
        $imagenInsertar->guardarFoto();
    }

    //guardando foto en gestor de archivos del servidor
    ProcesarImagen::guardarImagenesEnFicheros('../img','imagenes');

    //decidiendo a que vista redirecciona el controlador
    session_start();
    if($_SESSION['nombreUsuario']==='admin'){
        header('Location: ../view/principalAdminView.php');

    }else{
        header('Location: ../view/principalClienteView.php');
    }
}
?>