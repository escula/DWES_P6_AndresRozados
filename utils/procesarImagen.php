<?php
class ProcesarImagen
{
    static public function guardarImagenesEnFicheros($rutaDondeGuar,$nombreParametro='imagenes'){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica si se ha seleccionado un archivo
            if (isset($_FILES[$nombreParametro])) {

                $imagenes = $_FILES[$nombreParametro];

                // Directorio donde se guardarán las imágenes, hay que tener en cuenta que la ruta relativa empieza en donde se ejecute el fichero que tenga este codigo
                $rutaDondeGuardar= $rutaDondeGuar;
                $numeroRepeticiones=count($imagenes['name']);

                    for ($numeroImgen=0; $numeroImgen<$numeroRepeticiones; $numeroImgen++) {
                        echo $numeroImgen;
                        if (move_uploaded_file($imagenes['tmp_name'][$numeroImgen], $rutaDondeGuardar . '/' . $imagenes['name'][$numeroImgen])) { // esto es lo que te hace que se guarde la imagen
                            echo "La imagen'.$numeroImgen.' se ha subido correctamente.";
                        } else {
                            echo "Error al subir la imagen.";
                        }
                    }

                } else {
                    echo "No se ha seleccionado ninguna imagen.";
                }
            } else {
                echo "No se recibieron datos.";
            }

    }

}
?>

