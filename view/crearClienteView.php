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
</style>
<title>Crear Cliente</title>
</head>
<body>

<form action="../controller/crearClienteController.php" method="GET">
  <label for="dni">DNI:</label>
  <input type="text" id="dni" name="dni">
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre">
  <label for="apellidos">Apellidos:</label>
  <input type="text" id="apellidos" name="apellidos">
  <label for="telefono">Teléfono:</label>
  <input type="tel" id="telefono" name="telefono">
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <input type="submit" value="Enviar">
</form>

</body>
</html>
';
}else{
    //No se ha probado este else
    header('Location: principalClienteView.php');
}