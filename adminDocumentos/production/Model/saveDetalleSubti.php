<?php

session_start();
$items = "";
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
for ($i = 0; $i < count($_SESSION['objectl']); $i++) {
    if ($i == 0) {
        $items .= $_SESSION['objectl'][$i];
    } else {
        $items .= "," . $_SESSION['objectl'][$i];
    }
}

$query = "update subtitulo_conv set detalle = '".$items."' where id = ".$_SESSION['id'];
unset($_SESSION['objectP']);
unset($_SESSION['id']);
if ($conexion->execQuery($query)>0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



