
<?php
session_start();
if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario']==='admin'){

    echo '
<!DOCTYPE html>
<html lang="ES">
<head>
    <style>
body {
  font-family: Arial, sans-serif;
}

form {
  margin: 0 auto;
  width: 300px;
}

label {
  font-weight: bold;
  display: block;
  margin-top: 20px;
}

input[type="text"], input[type="tel"], input[type="email"] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 10px 0;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  margin: 10px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

input[type="submit"]:hover {
  opacity: 0.8;
}
th {
  background-color: green;
  color: white;
}

tr:nth-child(even) {
  background-color: rgba(0, 128, 0, 0.5);
}
button {
    background-color: #008000;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}
button:hover {
    background-color: #004d00;
}
    </style>
</head>
<body>
<form action="../controller/borrarUsuarioController.php" method="get" id="formularioBorrar"></form>
    <table>
        <tr id="cabecera">
            <th>ID Usuario</th>
            <th>Acción</th>
        </tr>
    </table>
    <form action="../controller/crearUsuarioController.php" method="GET">
      <label for="id_usuario">id_usuario:</label>
      <input type="text" id="id_usuario" name="id_usuario" pattern="[A-Za-z0-9]{1,9}" title="Por favor, ingresa de 1 a 9 letras o números">
      <input type="submit" value="Crear usuario">
    </form>


';
if(isset($_SESSION['contrasenaUsuarioCreado'])){
    echo '<p>Contrasena usuario creado: '.$_SESSION['contrasenaUsuarioCreado'].'</p>';
}
}else{
    //No se ha probado este else
    header('Location: principalClienteView.php');
}
?>
<script>
    fetch("../Api/obtenerUsuarios.php")
        .then(response => response.json())
        .then(function (data) {
            const header = document.getElementById('cabecera');
            console.log(data.length)
            for (let i=0;i<data.length;i++){

                const elmentoAgregar=document.createElement('tr');
                const idUsuario= data[i].id_usuario;
                elmentoAgregar.innerHTML="<td>"+idUsuario+"</td>" +
                    `<td><button type='submit' form='formularioBorrar' name='idUsuarioBorrar'  value=${idUsuario}>borrar</button></td>`;

                header.after(elmentoAgregar);
            }

        })
        .catch(error => console.error("Error:", error));
</script>

<button onclick="location.href= '../controller/salirDecrearYeliminarUsuario.php'">Volver a pagina principal y piensatelo mejor</button>
<!--esto es lo mismo que hacer un anchor pero con button-->
</body>
</html>