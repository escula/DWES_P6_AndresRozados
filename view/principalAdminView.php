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
    <form action="actualizarViviendaView.php" method="get" id="formularioParaActualizar"></form>
        <table id="tablaPrincipal">
        <thead id="cabecera">
        <tr >
            <th>ID</th>
            <th>Tipo de vivienda</th>
            <th>Zona</th>
            <th>Nº de dormitorios</th>
            <th>Tamaño</th>
            <th>Precio</th>
            <th>Fotos</th>
            <th>Acciones</th>
        </tr>
        </thead>
         <!--
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
        </tr> -->
        <!-- Añade más filas aquí -->
    </table>
    <div id="numerosPaginacion">
    
    </div>
    <form action="insertarViviendaView.php" method="get">
        <button type="submit">Insertar vivienda</button>
    </form>
    </main>
    </body>
    </html>
    <script >
    obtenerPagina(0);
//    obtenerPaginacion()
    function obtenerPagina(numero){
        fetch("../Api/obtenerPaginasViviendas.php?numeroPagina="+numero)
        .then(response => response.json())
        .then(function (data) {
            
            const numeroDeFilas=data.viviendas.length
            const tablaPrincipal=document.getElementById("tablaPrincipal");
           
          
            
            for (let i= 0;i<numeroDeFilas;i++){ //Recorremos el array al reves para mostrarlos descencientemente
                
                const idVivienda=data.viviendas[i].id
                const tipo=data.viviendas[i].tipo
                const zona=data.viviendas[i].zona
                const direccion=data.viviendas[i].direccion
                const ndormitorios=data.viviendas[i].ndormitorios
                const precio=data.viviendas[i].precio
                const tamano=data.viviendas[i].tamano
                const extras=data.viviendas[i].extras
                const observaciones=data.viviendas[i].observaciones
                const fechaAnuncio=data.viviendas[i].fecha_anuncio


                //recuperando las fotos y haciendo los anchor de la fila
                let fotosPorVivienda="";
                for (var x of data.fotosViviendas ) {
                  
                    
                    if(x.length !=0 && x[0].id_vivienda == parseInt(idVivienda)){
 
                        for (var foto of x) {
                           fotosPorVivienda=fotosPorVivienda+"<a href=../img/"+foto.foto+">imagen: "+foto.foto+"</a></br>"

                        }
                    }

                  
                }
                
                const fila = document.createElement("tr")
                fila.innerHTML= "<td class=idVivienda>"+idVivienda+"</td>" +
                                 "<td>"+tipo+"</td>"+
                                 "<td>"+zona+"</td>"+
                                 "<td>"+ndormitorios+"</td>"+
                                 "<td>"+tamano+"</td>"+
                                 "<td>"+precio+"€</td>"+
                                "<td>"+fotosPorVivienda+"</td>"+
                                 "<td>" +
                                        "<button class=button name=modificarIdVivienda value="+idVivienda+" form=formularioParaActualizar>Modificar</button>" +
                                         "<button class=button name=borrarIdVivienda value=idVivienda>Borrar</button>" +
                                 "</td>";
                
                tablaPrincipal.append(fila);
                
                const botones =document.querySelectorAll("button[name=borrarIdVivienda]")     
                botones[botones.length-1].addEventListener("click",borrarFila)   
                
                function borrarFila(){
                   eliminarVivienda(idVivienda);
                   obtenerPaginacion();
                   eliminacionCuerpoTabla()
                   setTimeout(obtenerPagina(0),200)
                   
                    
                }
    
            }
        })  
//        .catch(error => {
//            console.log(error)
//        });
    } 
    function obtenerPaginacion(){
        fetch("../Api/obtenerNumeroViviendas.php")
        .then(response => response.json())
        .then(function (data) {
            
            const numeroViviendas=data.numero_viviendas;
            const numeropaginas=numeroViviendas/4;
            const viviendasDeUltimaPagina= numeropaginas%4; //Si este es distinto de cero significa que abria que añadir una pagina más
            
            const numerosPaginacionDiv=document.getElementById("numerosPaginacion");
            numerosPaginacionDiv.innerHTML="";
//            if (viviendasDeUltimaPagina===2){
//                numeroTotalPaginas = numeropaginas;
//            }else{
//                numeroTotalPaginas = numeropaginas + 1;
//            }
            numeroTotalPaginas = numeropaginas;
            for (let i=0;i<numeroTotalPaginas;i++){
                const numeroPaginacion= document.createElement("button")
                numeroPaginacion.innerText= i+1;
      
                numeroPaginacion.addEventListener("click",function (event){
                eliminacionCuerpoTabla()
                obtenerPagina(i)
                })
                numerosPaginacionDiv.append(numeroPaginacion);
                
            } 
        })
    }
    function eliminacionCuerpoTabla(){
        const filasElimnar=document.querySelectorAll("tr>td")
        for(var i = 0; i < filasElimnar.length; i++) {
          filasElimnar[i].remove()
        }

    }
    function eliminarVivienda(idEliminarVivienda){
        fetch("../Api/borrarVivienda.php?idVivienda="+idEliminarVivienda)
        .then()
    }
    
    </script>';


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