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
             body {
                font-family: Arial, sans-serif;
            }
            table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            color: #333;
            }
            th, td {
                border: 1px solid #999;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #2d5a8c;
                color: #fff;
            }
            tr:nth-child(even) {
                background-color: #e8f2fc;
            }
            .button {
                background-color: #2d5a8c;
                border: none;
                color: white;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 2px 2px;
                cursor: pointer;
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
         <form action="./crearYborrarUsuarioView.php" method="get">
            <button class="logout-button">Crear un usuario</button>
        </form>
        <form action="../controller/logOutController.php" method="get">
            <button class="logout-button">Desloguearse</button>
        </form>
    </header>
    <main>
    <form action="modificar" method="get" id="formularioParaModificar"></form>
        <table id="tablaPrincipal">
        <tr id="cabecera">
            <th>ID</th>
            <th>Tipo de vivienda</th>
            <th>Zona</th>
            <th>Nº de dormitorios</th>
            <th>Tamaño</th>
            <th>Precio</th>
            <th>Fotos</th>
            <th>Acciones</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Casa</td>
            <td>Centro</td>
            <td>3</td>
            <td>120m²</td>
            <td>€200,000</td>
            <td>
                <a href="#">Foto 1</a>,
                <a href="#">Foto 2</a>,
                <a href="#">Foto 3</a>
            </td>
            <td>
                <button class="button">Modificar</button>
                <button class="button">Borrar</button>
            </td>
        </tr>
        <!-- Añade más filas aquí -->
    </table>
    <script >
        fetch("obtenerViviendas.php")
    .then(response => response.json())
    .then(function (data) {
        const cabeceraTabla=document.getElementById("cabecera");
        const numeroDeFilas=data.length
        const tablaPrincipal=document.getElementById("tablaPrincipal");
        
        for (let i= 0-1;i<numeroDeFilas;i++){ //Recorremos el array al reves para mostrarlos descencientemente
            const idVivienda=data[i].id
            const tipo=data[i].tipo
            const zona=data[i].zona
            const direccion=data[i].direccion
            const ndormitorios=data[i].ndormitorios
            const precio=data[i].precio
            const tamano=data[i].tamano
            const extras=data[i].extras
            const observaciones=data[i].observaciones
            const fechaAnuncio=data[i].fecha_anuncio
            
            
            const fila= document.createElement("tr")
            fila.innerHTML= "<td>"+idVivienda+"</td>" +
                             "<td>"+tipo+"</td>"+
                             "<td>"+zona+"</td>"+
                             "<td>"+direccion+"</td>"+
                             "<td>"+ndormitorios+"</td>"+
                             "<td>"+precio+"</td>"+
                             "<td>"+tamano+"</td>"+
                             "<td>"+extras+"</td>"+
                             "<td>"+observaciones+"</td>"+
                             "<td>"+fechaAnuncio+"</td>" +
                             "<td>" +
                                    "<button class=`button` name=`modificarIdVivienda`value=`idVivienda` form=`formularioParaModificar`>"+Modificar+"</button>" +
                             "<td>";
            
            tablaPrincipal.append(fila);
            const buttonBorrar=document.createElement("button");
            
            buttonBorrar.addEventListener("click",borrarFila)
                             
            function borrarFila(event){
                console.log(event.parentNode.parentNode);
            }
            
            
            const ultimoBotonModificar=document.querySelector(".modificarIdVivienda:last-of-type");
            ultimoBotonModificar.after(buttonBorrar)
        }
    })
    .catch(error => console.error("Error:", error));
    </script>
    </main>
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






