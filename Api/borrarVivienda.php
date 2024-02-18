<?php
include_once '../Model/Vivienda.php';
if(isset($_GET['idVivienda'])){
    Vivienda::borrarVivienda($_GET['idVivienda']);
}