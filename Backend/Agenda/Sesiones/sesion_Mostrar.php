<?php


session_name('Aerolinea');
session_start();

if (!(isset($_SESSION['ArregloVal']))) {
    echo ("El atributo arregloValores no existe en sesion, por favor ejecutar el archivo php que la crea<br>");
}else{
    echo ("El atributo arregloValores existe en sesion, se procede a mostrar<br><br>");
    $arreglo = $_SESSION['ArregloVal']; // obtiene el dato de la sesión
    print_r($arreglo);
}

echo("<br><br>Estado de la sesión :".session_status());
echo("<br>ID de la sesión :".session_id() );