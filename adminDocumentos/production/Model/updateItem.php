<?php

session_start();
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
$items = "";

if ($_POST['opc'] == 1) {
    $_SESSION['objectl'][$_POST['pos']] = $_POST['desc'];
} else {
    unset($_SESSION['objectl'][$_POST['pos']]);
}

for ($i = 0; $i < count($_SESSION['objectl']); $i++) {
    if ($i == 0) {
        $items .= $_SESSION['objectl'][$i];
    } else {
        $items .= "," . $_SESSION['objectl'][$i];
    }
}
$query = "update subtitulo_conv set detalle = '" . $items . "' where id = " . $_POST['id'];
if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



