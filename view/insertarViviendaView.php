
<!DOCTYPE html>
<html lang="ES">
    <head>
        <title>Insertar vivienda</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            form {
                width: 300px;
                margin: 0 auto;
            }
            label {
                display: block;
                margin-top: 10px;
                color: #006400;
            }
            input, select, textarea {
                width: 100%;
                padding: 5px;
                margin-top: 2px;
                border: 2px solid #006400;
            }
            input[type="submit"] {
                background-color: #006400;
                color: white;
            }
            label[type="radio"]{
                display: inline;
            }
            label[type="radio"]:before{
                display: inline;
            }
        </style>
    </head>
    <body>

        <form action="../controller/crearViviendaController.php" method="POST" enctype="multipart/form-data">
            <label for="tipo_vivienda">Tipo de vivienda:</label>
            <select id="tipo_vivienda" name="tipo_vivienda" required>
                <option value="Piso">Piso</option>
                <option value="Adosado">Adosado</option>
                <option value="Chalet">Chalet</option>
                <option value="Casa">Casa</option>
            </select>

            <label for="zona">Zona:</label>
            <select id="zona" name="zona" required>
                <option value="Centro">Centro</option>
                <option value="Norte">Norte</option>
                <option value="Sur">Sur</option>
                <option value="Este">Este</option>
                <option value="Oeste">Oeste</option>
            </select>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required>

            <label>Número de dormitorios:</label>
                <div style="display: flex">
                    <label style="margin: 0" for="1">1</label>
                    <input type="radio" id="1" name="dormitorios" value="1" required>
                </div>

                <div style="display: flex">
                    <label style="margin: 0" for="2">2</label>
                    <input type="radio" id="2" name="dormitorios" value="2" required>
                </div>

                <div style="display: flex">
                    <label style="margin: 0" for="3">3</label>
                    <input type="radio" id="3" name="dormitorios" value="3" required>
                </div>

                <div style="display: flex">

                    <label style="margin: 0" for="4">4</label>
                    <input type="radio" id="4" name="dormitorios" value="4">
                </div>
                <div style="display: flex">
                    <label style="margin: 0" for="5oMas">5 o más</label>
                    <input type="radio" style="width: auto" id="5oMas" name="dormitorios" value="5 o más">
                </div>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" max="9999999999" min="0" step="1" required>

                <label for="tamaño">Tamaño:</label>
                <input type="number" name="tamano" id="tamaño" max="9999999999" min="0" step="1" required>
            <label>¿Tiene extras?</label>
            <div  style="display: flex">

                <label style="margin: 0" for="piscina">Piscina</label>
                <input type="checkbox" id="piscina" name="extras[]" value="Piscina">

                <label style="margin: 0" for="jardin">Jardin</label>
                <input type="checkbox" id="jardin" name="extras[]" value="Jardín">

                <label style="margin: 0" for="garaje">Garaje</label>
                <input type="checkbox" id="garaje" name="extras[]" value="Garaje">
            </div>

            <label for="imagenes">Fotos:</label>
            <input type="file" id="imagenes" accept="image/*" name="imagenes[]" multiple required>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones"></textarea>

            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
