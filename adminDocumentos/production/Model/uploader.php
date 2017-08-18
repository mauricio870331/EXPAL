<?php

if (!empty($_FILES)) {
    include ("Conex.php");
    $conexion = new Conex("expresop_vultra");
    $id_convenio = $_POST['convenio'];
    $object = $conexion->findById("img_slides_conv", "id_convenio", $id_convenio);


    if ($conexion->getTotalFilas() < 3) {
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
        $ruta = "imgs/elastislide\slides";
        $dir_separator = DIRECTORY_SEPARATOR;
        $destino_path = dirname(__FILE__) . $dir_separator . $ruta . $dir_separator;
        $destino_path = str_replace("/", "\\", $destino_path);
        $target_path = str_replace("adminDocumentos\production\Model\\", "", $destino_path) . $nombre;
        if ($extension == "png" || $extension == "jpg" || $extension == "PNG" || $extension == "JPG") {
            if ($size > 150000) {
                echo json_encode(0);
            } elseif ($size == 0) {
                echo json_encode(3);
            } else {
                if (move_uploaded_file($temp, $target_path)) {
                    $peso = $size / 1024;
                    $sql2 = "INSERT INTO img_slides_conv (img,peso,nombre,id_convenio) values ('imgs/elastislide/slides/" . $nombre . "','" . ceil($peso) . "Kb','" . $nombre . "','" . $id_convenio . "')";
//                    echo $sql2;
                    $conexion->execQuery($sql2);
                    echo json_encode(1);
                } else {
                    echo json_encode(6);
                }
            }
        } else {
            echo json_encode(4);
        }
    } else {
        echo json_encode(5);
    }
    $conexion->desconectar();
}



