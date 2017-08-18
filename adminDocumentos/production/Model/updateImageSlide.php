<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

if (!empty($_FILES)) {
    include ("Conex.php");
    $conexion = new Conex("expresop_vultra");
    $id = $_POST['update'];  
    $temp = $_FILES['file']['tmp_name'];
    $nombre = $_FILES['file']['name'];
    $tipo = $_FILES['file']['type'];
    $temp_n = explode('.', $nombre);
    $extension = end($temp_n);
    $size = $_FILES['file']['size'];
    $fp = fopen($temp, 'r+b');
    $data = fread($fp, filesize($temp));
    fclose($fp);
    $target_path =  "../../img_slides_conv/".$nombre;
    if ($extension == "png" || $extension == "jpg" || $extension == "PNG" || $extension == "JPG") {
        if ($size > 150000) {
            echo json_encode(0);
        } elseif ($size == 0) {
            echo json_encode(3);
        } else {
            if (move_uploaded_file($temp, $target_path)) {
                $peso = $size / 1024;
                $sql2 = "update img_slides_conv set img = 'adminDocumentos/img_slides_conv/" . $nombre . "', peso ='" . ceil($peso) . "Kb', nombre ='" . $nombre . "' where id =" . $id . "";
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

    $conexion->desconectar();
}



