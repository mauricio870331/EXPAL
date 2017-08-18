<?php
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if ($_POST['opc'] == 1) {
    $query = "update subtitulo_conv set descripcion = '" . $_POST['desc'] ."' where id = " . $_POST['id'] . "";
} else {
    $query = "delete from subtitulo_conv where id = " . $_POST['id'] . "";   
}

if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



