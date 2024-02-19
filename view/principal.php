<?php
session_start();
if(isset($_SESSION['nombreUsuario'])){
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
    <body>';
include_once 'header.php';
echo'
    <main>
<form id="usarFiltro" method="post">
    <label for="tipo_vivienda">Tipo de vivienda:</label>
     <select id="tipo_vivienda" name="tipo_vivienda" >
                <option value="">Ninguna</option>
                <option value="tipo = Piso">Piso</option>
                <option value="tipo = Adosado">Adosado</option>
                <option value="tipo = Chalet">Chalet</option>
                <option value="tipo = Casa">Casa</option>
                
    </select>
    </br>
    <label for="zona">Zona:</label>
     <select id="zona" name="zona" >
                <option value="">Ninguno</option>
                <option value="zona = Centro">Centro</option>
                <option value="zona = Norte">Norte</option>
                <option value="zona = Sur">Sur</option>
                <option value="zona = Este">Este</option>
                <option value="zona = Oeste">Oeste</option>
    </select>
    </br>
    <label>Número de dormitorios:</label>
    <div style="display: flex">
        <label style="margin: 0" for="1">1</label>
        <input type="radio" id="1" name="dormitorios" value="ndormitorios = 1" >
    </div>

    <div style="display: flex">
        <label style="margin: 0" for="2">2</label>
        <input type="radio" id="2" name="dormitorios" value="ndormitorios = 2" >
    </div>

    <div style="display: flex">
        <label style="margin: 0" for="3">3</label>
        <input type="radio" id="3" name="dormitorios" value="ndormitorios = 3" >
    </div>

    <div style="display: flex">

        <label style="margin: 0" for="4">4</label>
        <input type="radio" id="4" name="dormitorios" value="ndormitorios = 4">
    </div>
    <div style="display: flex">
        <label style="margin: 0" for="5oMas">5 o más</label>
        <input type="radio" style="width: auto" id="5oMas" name="dormitorios" value="ndormitorios = 5 o más">
    </div>
    
    </br>
    <label>Precio:</label>
    <input type="radio" id="100000" name="precio" value="precio < 100000">
    <label for="100000" ><100,000</label>
    <input type="radio" id="100000" name="precio" value="precio > 100000 and precio < 200000">
    <label for="100000" ><100,000</label>
    <input type="radio" id="100000" name="precio" value="precio > 200000 and precio < 300000">
    <label for="100000" ><100,000</label>
    <input type="radio" id="100000" name="precio" value="precio > 300000">
    <label for="100000" ><100,000</label>
    
    </br>
    <label>Tamaño:</label>
    <input type="radio" id="100" name="tamano" value="tamano < 100">
    <label for="100" ><100,</label>
    <input type="radio" id="100" name="tamano" value="tamano > 100 and tamano < 200">
    <label for="100" ><100,</label>
    <input type="radio" id="100" name="tamano" value="tamano > 200 and tamano < 300">
    <label for="100" ><100,</label>
    <input type="radio" id="100" name="tamano" value="tamano > 300">
    <label for="100000" ><100,000</label>
    </br>
    
    <input type="submit" value="Buscar viviendas">
</form>

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
    obtenerPaginacion()
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
    

    </script>
    <script src="./filtro.js" async></script>';


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