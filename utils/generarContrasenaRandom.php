<?php
function generarContrasenaRandom() {
    $longitud = rand(4, 20); // Genera una longitud aleatoria entre 4 y 20
    $letras = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; // Letras posibles
    $cadena = '';
    for ($i = 0; $i < $longitud; $i++) {
        $indiceAleatorio = rand(0, strlen($letras) - 1); // Genera un índice aleatorio
        $cadena .= $letras[$indiceAleatorio]; // Añade la letra aleatoria a la cadena
    }
    return $cadena;
}