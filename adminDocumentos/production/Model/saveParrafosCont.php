<?php

session_start();
$error = 0;
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
for ($i = 0; $i < count($_SESSION['objectP']); $i++) {
    $query = "Insert into parrafos_conv (numero, descripcion, id_convenio) "
            . "values (" . $_SESSION['objectP'][$i]['cons'] . ","
            . "\"" . $_SESSION['objectP'][$i]['desc'] . "\",'" . $_SESSION['objectP'][$i]['conv'] . "')";
//    echo $query . '<br>';
    if ($conexion->execQuery($query) < 1) {
        $error++;
    }
}
unset($_SESSION['objectP']);
if ($error < 1) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



