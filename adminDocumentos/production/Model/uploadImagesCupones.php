<?php

if (!empty($_FILES)) {
    include ("Conex.php");
    $conexion = new Conex("expresop_vultra");
    $action = $_POST['action'];
    $id_update = $_POST['update'];
    $hoy = date("Y-m-d h:m:s");
    $temp = $_FILES['file']['tmp_name'];
    $nombre = $_FILES['file']['name'];
    $tipo = $_FILES['file']['type'];
    $temp_n = explode('.', $nombre);
    $extension = end($temp_n);
    $size = $_FILES['file']['size'];
    $fp = fopen($temp, 'r+b');
    $data = fread($fp, filesize($temp));
    fclose($fp);

    if ($extension == "png" || $extension == "jpg" || $extension == "PNG" || $extension == "JPG") {
        if ($size > 100000) {
            echo json_encode(0);
        } elseif ($size == 0) {
            echo json_encode(3);
        } else {
            $peso = $size / 1024;
            $sql2 = "UPDATE convenios_ultra SET fecha_creado = '" . $hoy . "', fecha_mod = '" . $hoy . "', img = '" . base64_encode($data) . "', tipo_imagen = '" . $tipo . "', nomb_img = '" . $nombre . "', peso = '" . ceil($peso) . " Kb' WHERE nit = '" . $id_update . "'";
            $conexion->execQuery($sql2);
            echo json_encode(1);
            //echo $sql2;  
        }
    } else {
        echo json_encode(4);
    }
    $conexion->desconectar();
}
?>