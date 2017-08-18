<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");
$query = "update categorias_cupones set categoria = '" . $_POST['categoria'] . "' where id_categoria = '" . $_POST['id'] . "'";
if ($_POST['opc'] == 2) {
    $query = "delete from categorias_cupones where id_categoria = '" . $_POST['id'] . "'";
}

if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



