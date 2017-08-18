<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");
$hoy = date("Y-m-d h:m:s");
$query = "INSERT INTO categorias_cupones (id_categoria,categoria,class) "
        . "VALUES('" . $_POST['id'] . "','" . $_POST['cat'] . "','li_mnu')";
//echo $query;
$conexion->execQuery($query);
if ($conexion->getTotalFilas() > 0) {
    echo 1;
} else {
    echo 0;
}


