<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if ($_POST['opc'] == 1) {
    $query = "update parrafos_conv set numero = " . $_POST['orden'] . ", "
            . "descripcion = '" . $_POST['desc'] . "', id_convenio = '" . $_POST['conv'] . "' where id = '" . $_POST['id_parrafo'] . "'";
} else {
    $query = "delete from parrafos_conv where id = '" . $_POST['id_parrafo'] . "'";   
}

if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



