<?php


session_start();
if(!isset($_SESSION['nombreUsuario'])){ // si no existe la session
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .login-container {
                width: 300px;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            }

            .login-container h2 {
                margin-bottom: 20px;
                text-align: center;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-weight: bold;
            }

            .form-group input[type="text"],
            .form-group input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .form-group button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                color: #fff;
                cursor: pointer;
            }

            .form-group button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="../controller/loginController.php" method="GET" >
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required pattern="[a-zA-Z0-9]{1,9}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required pattern="[a-zA-Z0-9]{4,255}">
            </div>
            <div class="form-group">
                <button type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </div>
    </body>
    </html>';
}else{
    // si no se mete a significa que estabas logueado te manda a la pagina principal
    if($_SESSION['nombreUsuario']==='admin'){
        header('Location: ../view/principalAdminView.php');

    }else{
        header('Location: ../view/principalClienteView.php');
    }

}
