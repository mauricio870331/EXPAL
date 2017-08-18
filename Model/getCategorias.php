<?php

include 'Conex.php';
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("categorias_cupones");
$array = array();
foreach ($object as $value) {
    if ($value->id_categoria != "todas") {
        $array[] = $value->id_categoria;
    }
}
$conexion->desconectar();
echo json_encode($array);


