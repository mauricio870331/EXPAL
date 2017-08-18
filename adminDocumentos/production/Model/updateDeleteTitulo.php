<?php
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if ($_POST['opc'] == 1) {
    $query = "update header_detalle_dcto set numero = " . $_POST['orden'] . ", "
            . "descripcion = '" . $_POST['desc'] . "', id_convenio = '" . $_POST['conv'] . "' where id = " . $_POST['id'] . "";
} else {
    $query = "delete from header_detalle_dcto where id = " . $_POST['id'] . "";   
}

if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



