<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");

$conexion->findById("convenios_ultra", "nit", $_POST['nit']);
if ($conexion->getTotalFilas() > 0) {
    echo 2;
} else {
    $hoy = date("Y-m-d h:m:s");
    $query = "INSERT INTO convenios_ultra (nit,nombre,prefijo,consecutivo,clave,estado,class,fecha_creado,orden) "
            . "VALUES('" . $_POST['nit'] . "','" . $_POST['name'] . "','" . $_POST['prefix'] . "-',"
            . "0,'1234','A','" . $_POST['cat'] . "','" . $hoy . "'," . $_POST['orden'] . ")";
    $conexion->execQuery($query);
    if ($conexion->getTotalFilas() > 0) {
        echo 1;
    } else {
        echo 0;
    }
    $conexion->desconectar();
}





