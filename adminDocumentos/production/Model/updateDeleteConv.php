<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if ($_POST['opc'] == 1) {
    $query = "update convenios_ultra set nit = '" . $_POST['nit'] . "', "
            . "nombre = '" . $_POST['nombre'] . "', prefijo = '" . $_POST['prefijo'] . "', "
            . "class = '" . $_POST['cat'] . "', orden = " . $_POST['orden'] . " where nit = '" . $_POST['oldnit'] . "'";
} else {
    $query = "delete from convenios_ultra where nit = '" . $_POST['nit'] . "'";
}

if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



