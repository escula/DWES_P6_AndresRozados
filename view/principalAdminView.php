<?php
session_start();
if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario']==='admin'){
        echo '
    <!DOCTYPE html>
    <html lang="ES">
    <head>
        <title>Mi Página Web</title>
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
        </style>
    </head>
    <body>
    <header class="header">';
        if(isset($_COOKIE['ultimaSession'])){
            echo '<p>Ultima conexion:'.$_COOKIE['ultimaSession'].'</p>';
        }
        echo '
        <p>'.$_SESSION['nombreUsuario'].'</p>';
        echo '
         <form action="./crearClienteView.php" method="get">
            <button class="logout-button">Crear un cliente</button>
        </form>
        <form action="../controller/logOutController.php" method="get">
            <button class="logout-button">Desloguearse</button>
        </form>
    </header>
    </body>
    </html>';


//---------------Si no tiene antiene la session---------------
}else{
    echo '
    <!DOCTYPE html>
<html lang="ES">
<head>
    <title>Mi Página Web</title>
    <style>
        .menu {
            width: 300px;
            padding: 20px;
            margin: 0 auto;
            background-color: #f8f9fa;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .menu button {
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
    </style>
</head>
<body>
    <div class="menu">
        <h2>¡Hola!</h2>
        <p>Para continuar, por favor inicia sesión.</p>
        <form action="login.php" method="get">
            <button >Volver a login</button>
        </form>
        
    </div>
</body>
</html>
    ';
}






