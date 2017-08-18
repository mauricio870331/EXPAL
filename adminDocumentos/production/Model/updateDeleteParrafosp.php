<?php

include ("Conex.php");
$conexion = new Conex("expresop_vultra");
if ($_POST['opc'] == 1) {
    if ($_POST['link'] == 'S') {
        $parrafo = "<a style=\'text-decoration:none;color:#0e9400;\' href=\'" . $_POST['url'] . "\' target=\'_blank\'>" . $_POST['parrafo'] . "</a>";
    } else {
        $parrafo = $_POST['parrafo'];
    }

    $query = "update parrafos_der_slide set numero = " . $_POST['orden'] . ", descripcion ='" . $parrafo . "',"
            . " id_convenio = '" . $_POST['convenio'] . "', link = '" . $_POST['link'] . "' where id = " . $_POST['idupdate'] . "";
} else {
    $query = "delete from parrafos_der_slide where id = '" . $_POST['idupdate'] . "'";
}
if ($conexion->execQuery($query) > 0) {
    echo 1;
} else {
    echo 0;
}
$conexion->desconectar();
?>



