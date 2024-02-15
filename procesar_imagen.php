<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha seleccionado un archivo
    if (isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen'];

        // Directorio donde se guardarán las imágenes
        $directorio_destino = '/';

        // Ruta de destino del archivo
        $ruta_destino = $directorio_destino . $imagen['name'];

        // Mueve el archivo del directorio temporal al directorio de destino
        echo '<pre>';
        print_r($imagen);
        if (move_uploaded_file($imagen['tmp_name'], $imagen['name'])) {
            echo "La imagen se ha subido correctamente.";

            // Guardar la imagen en un fichero
            $fichero_guardar = 'fichero_imagenes.txt';
            $contenido_fichero = "Nombre de la imagen: " . $imagen['name'] . "\nRuta de la imagen: " . $ruta_destino . "\n\n";

            // Abre el fichero en modo de escritura, creándolo si no existe
            $manejador_fichero = fopen($fichero_guardar, 'a');

            // Escribe el contenido en el fichero
            fwrite($manejador_fichero, $contenido_fichero);

            // Cierra el fichero
            fclose($manejador_fichero);

            echo "La información de la imagen se ha guardado en el fichero.";
        } else {
            echo "Error al subir la imagen.";
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
    <input type="file" name="imagen" accept="image/*"><br><br>
    <input type="submit" value="Subir imagen">
</form>
</body>
</html>


