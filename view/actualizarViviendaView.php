
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Insertar vivienda</title>
    <style>
        .header {
            width: 100%;
            height: 50px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 20px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .logout-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
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
        button[class="salir"], input, select, textarea {
            width: 100%;
            padding: 5px;
            margin-top: 2px;
            border: 2px solid #006400;
        }
        button[class="salir"], input[type="submit"] {
            background-color: #006400;
            color: white;
        }
        button[class="salir"], input[type="submit"]:hover{
            cursor: pointer;
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

<?php
session_start();
include_once 'header.php';
?>
<form id="actualizarViviendaYFoto" method="POST" enctype="multipart/form-data">
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
            <input type="radio" id="4" name="dormitorios" value="4" required>
        </div>
        <div style="display: flex">
            <label style="margin: 0" for="5 o más">5 o más</label>
            <input type="radio" style="width: auto" id="5 o más" name="dormitorios" value="5 o más" required>
        </div>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" id="precio" max="9999999999" min="0" step="1" required>

    <label for="tamano">Tamaño:</label>
    <input type="number" name="tamano" id="tamano" max="9999999999" min="0" step="1" required>
    <label>¿Tiene extras?</label>
    <div  style="display: flex">

        <label style="margin: 0" for="piscina">Piscina</label>
        <input type="checkbox" id="piscina" name="extras" value="Piscina">

        <label style="margin: 0" for="jardin">Jardin</label>
        <input type="checkbox" id="jardin" name="extras" value="Jardín">

        <label style="margin: 0" for="garaje">Garaje</label>
        <input type="checkbox" id="garaje" name="extras" value="Garaje">
    </div>

    <label for="imagenes">Fotos:</label>
    <input type="file" id="imagenes" accept="image/*" name="imagenes[]" multiple required>

    <label for="observaciones">Observaciones:</label>
    <textarea id="observaciones" name="observaciones"></textarea>

    <input type="submit" value="Enviar">
    <button type ="button" class="salir" onclick="location.href= '../controller/salirDecrearYeliminarUsuario.php'">Volver a pagina principal</button>

</form>
<script>
    var urlCompleta = window.location.href; // obtienes la URL de la página actual
    var objetoUrl = new URL(urlCompleta);
    var idVivienda = objetoUrl.searchParams.get("modificarIdVivienda");

    fetch("../Api/obtenerViviendaYFotoVivienda.php?id_vivienda="+idVivienda)
        .then(response => response.json())
        .then(function (data) {
            const idVivienda=data.vivienda.id
            const tipo=data.vivienda.tipo
            const zona=data.vivienda.zona
            const direccion=data.vivienda.direccion
            const ndormitorios=data.vivienda.ndormitorios
            const precio=data.vivienda.precio
            const tamano=data.vivienda.tamano
            const extras=data.vivienda.extras
            const observaciones=data.vivienda.observaciones


            document.getElementById('tipo_vivienda').value=tipo;
            document.getElementById('zona').value=zona;
            document.getElementById('direccion').value=direccion;
            document.getElementById(ndormitorios.toString()).checked=true;
            document.getElementById('precio').value=precio;
            document.getElementById('tamano').value=tamano;
            //chekeando todos los checked de extras
            extrasElegidos=extras.split(',');
            for (const extra of extrasElegidos) {

                switch (extra) {
                    case 'Piscina':
                        document.getElementById('piscina').checked = true
                        break;
                    case "Jardín":
                        document.getElementById('jardin').checked = true
                        break;
                    case "Garaje":
                        document.getElementById('garaje').checked = true
                        break;
                }
            }
            document.getElementById('observaciones').value=observaciones;


        });

    document.getElementById('actualizarViviendaYFoto').addEventListener('submit',(e) =>{
        e.preventDefault();

        let paraEnviar = new FormData();


        //introduciendo las imagenes
        let files= document.getElementById('imagenes').files;
        for (let i = 0; i < files.length; i++) {
            paraEnviar.append('imagenes[]', files[i]);
        }
        paraEnviar.append('id_vivienda',idVivienda);
        paraEnviar.append('tipo_vivienda',document.getElementById('tipo_vivienda').value);
        paraEnviar.append('zona',document.getElementById('zona').value);
        paraEnviar.append('direccion',document.getElementById('direccion').value);
        paraEnviar.append('nDormitorios',document.querySelector('input[name="dormitorios"]:checked').value);
        paraEnviar.append('precio',document.getElementById('precio').value);
        paraEnviar.append('tamano',document.getElementById('tamano').value);

        //recogiendo los valores de las cosas extras seleccionadas y convirtiendolas a string
        let valorExtrasSeleccionados="";
        let extras = document.querySelectorAll('input[name="extras"]:checked');
        for (const extra of extras) {
            valorExtrasSeleccionados=valorExtrasSeleccionados+","+extra.value;
        }
        valorExtrasSeleccionados = valorExtrasSeleccionados.substring(1);
        paraEnviar.append('extras',valorExtrasSeleccionados);

        paraEnviar.append('observaciones',document.getElementById('observaciones').value);

        fetch('../Api/actualizarViviendaYFoto.php', {
            method: 'POST', // o 'PUT'
            body: paraEnviar, // datos a enviar
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error`);
            }
            window.history.back();

        })
        .catch(error  => {
            window.location.href = "errorOperacion.php";
        })
    })
</script>
</body>
</html>
