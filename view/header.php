<?php
echo '
<header class="header">';
        if(isset($_COOKIE['ultimaSession'])){
            echo '<p>Ultima conexion:'.$_COOKIE['ultimaSession'].'</p>';
        }
        echo '
        <p>'.$_SESSION['nombreUsuario'].'</p>';

if($_SESSION['nombreUsuario']==='admin'){
echo'   
    <form action="./crearYborrarUsuarioView.php" method="get">
            <button class="logout-button">Crear un usuario</button>
    </form>';
}
  echo'      
    <form action="../controller/logOutController.php" method="get">
        <button class="logout-button">Desloguearse</button>
    </form>
</header>';