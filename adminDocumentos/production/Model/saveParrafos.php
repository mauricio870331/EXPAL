<?php

session_start();
$error = 0;
include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if (isset($_SESSION['objectP']) && count($_SESSION['objectP']) > 0) {
    for ($i = 0; $i < count($_SESSION['objectP']); $i++) {

        if ($_SESSION['objectP'][$i]['link'] == 'S') {
            $parrafo = "<a style=\'text-decoration:none;color:#0e9400;\' href=\'" . $_SESSION['objectP'][$i]['url'] . "\' target=\'_blank\'>" . $_SESSION['objectP'][$i]['desc'] . "</a>";
        } else {
            $parrafo = $_SESSION['objectP'][$i]['desc'];
        }

        $query = "Insert into parrafos_der_slide (numero, descripcion, id_convenio, link) "
                . "values (" . $_SESSION['objectP'][$i]['cons'] . ",'" . $parrafo . "','" . $_SESSION['objectP'][$i]['conv'] . "','" . $_SESSION['objectP'][$i]['link'] . "')";
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
} else {
    echo 2;
}
$conexion->desconectar();
?>



