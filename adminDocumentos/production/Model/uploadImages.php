<?php

if (!empty($_FILES)) {
    include ("funciones_mysql.php");
    $conexion = conectar("expresop_convenios");
    $opc = $_POST['opcH'];
    $pos = $_POST['pos'];
    $action = $_POST['action'];

    $id_update = $_POST['update'];
    $hoy = date("Y-m-d h:m:s");


    $temp = $_FILES['file']['tmp_name'];
    $nombre = $_FILES['file']['name'];
    $tipo = $_FILES['file']['type'];
    $extension = end(explode('.', $nombre));
    $size = $_FILES['file']['size'];
    $fp = fopen($temp, 'r+b');
    $data = fread($fp, filesize($temp));
    fclose($fp);

    if ($extension == "png" || $extension == "jpg" || $extension == "PNG" || $extension == "JPG") {
        if ($size > 1000000) {
            echo json_encode(0);
        } elseif ($size == 0) {
            echo json_encode(3);
        } else {
            if ($action == "create") {
                if (($opc != '' && $opc != null) && ($pos != '' && $pos != null)) {
                    $peso = $size / 1024;
                    $sql2 = "INSERT INTO imagenesEP (imagen, tipo_imagen, nombre, lugar, posicion, peso)
             	              VALUES ('" . base64_encode($data) . "','" . $tipo . "','" . $nombre . "','" . $opc . "','" . $pos . "','" . ceil($peso) . " Kb')";
                    $resultado2 = ejecutar($sql2, $conexion);
                    echo json_encode(1);
                } else {
                    echo json_encode(2);
                }
            } else {
                $peso = $size / 1024;
                $sql2 = "UPDATE imagenesEP SET imagen = '" . base64_encode($data) . "', tipo_imagen = '" . $tipo . "', nombre = '" . $nombre . "', peso = '" . ceil($peso) . " Kb' WHERE id = " . $id_update;
                $resultado2 = ejecutar($sql2, $conexion);
                echo json_encode(1);
            }                       //echo $sql2;  
        }
    } else {
        echo json_encode(4);
    }

    mysql_close($conexion);
}
?>