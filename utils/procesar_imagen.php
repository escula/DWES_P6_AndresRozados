<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha seleccionado un archivo
    if (isset($_FILES['imagen'])) {

        //Obteniendo la imagen esto tiene el siguiente array ->
        /*
         * Array
(
    [name] => Array
        (
            [0] => Vector.png
            [1] => logo header.png
            [2] => admin.jpg
        )

    [full_path] => Array
        (
            [0] => Vector.png
            [1] => logo header.png
            [2] => admin.jpg
        )

    [type] => Array
        (
            [0] => image/png
            [1] => image/png
            [2] => image/jpeg
        )

    [tmp_name] => Array
        (
            [0] => C:\xampp\tmp\phpD35D.tmp
            [1] => C:\xampp\tmp\phpD35E.tmp
            [2] => C:\xampp\tmp\phpD35F.tmp
        )

    [error] => Array
        (
            [0] => 0
            [1] => 0
            [2] => 0
        )

    [size] => Array
        (
            [0] => 203
            [1] => 8044
            [2] => 16627
        )

)
         */
        $imagenes = $_FILES['imagen'];

        // Directorio donde se guardarán las imágenes, hay que tener en cuenta que la ruta relativa empieza en donde se ejecute el fichero que tenga este codigo
        $rutaDondeGuardar= '../img/';
        $numeroRepeticiones=count($imagenes['name']);

            for ($numeroImgen=0; $numeroImgen<$numeroRepeticiones; $numeroImgen++) {
                echo $numeroImgen;
                if (move_uploaded_file($imagenes['tmp_name'][$numeroImgen], $rutaDondeGuardar . '' . $imagenes['name'][$numeroImgen])) { // esto es lo que te hace que se guarde la imagen
                    echo "La imagen'.$numeroImgen.' se ha subido correctamente.";

                    /************************************************************
                     * Lo siguiente comentado es si quieres hacer un log
                     * **********************************************************
                     */
                    //            $fichero_guardar = 'fichero_imagenes.log';
                    //            $contenido_fichero = "Nombre de la imagen: " . $imagen['name'] . "\nRuta de la imagen: " . $ruta_destino . "\n\n";
                    //
                    //            // Abre el fichero en modo de escritura, creándolo si no existe
                    //            $manejador_fichero = fopen($fichero_guardar, 'a');
                    //
                    //            // Escribe el contenido en el fichero
                    //            fwrite($manejador_fichero, $contenido_fichero);
                    //
                    //            // Cierra el fichero
                    //            fclose($manejador_fichero);
    //
    //                echo '</br>';
    //                echo "La información de la imagen se ha guardado en el fichero.";

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



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir imágenes</title>
</head>
<body>
<h2>Subir imagen</h2>
<form action="procesar_imagen.php" method="post" enctype="multipart/form-data">
    <input type="file" name="imagen[]" accept="image/*" multiple><br><br>
<!--    Imortante que el name tengo un [] para que mande al servidor un array-->
    <input type="submit" value="Subir imagen">
</form>
</body>
</html>


