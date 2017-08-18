<?php

include 'Conex.php';
$conexion = new Conex("expresop_vultra");
$object = $conexion->findById("img_slides_conv", "id_convenio", $_POST['id']);
$object2 = $conexion->findById("parrafos_conv", "id_convenio", $_POST['id']);
$object3 = $conexion->findById("condiciones_conv", "id_convenio", $_POST['id']);
$object4 = $conexion->findById("parrafos_der_slide", "id_convenio", $_POST['id']);
$object5 = $conexion->findById("header_detalle_dcto", "id_convenio", $_POST['id']);
$array = array();
$imgs = array();
$parrafos = array();
$condiciones = array();
$parraf_slides = array();
$header_detalle = array();
$subtitulos = array();
foreach ($object as $value) {
    $imgs[] = $value->img;
}
foreach ($object2 as $value) {
    $parrafos[] = $value->descripcion;
}
foreach ($object3 as $value) {
    $condiciones[] = $value->descripcion;
}
foreach ($object4 as $value) {
    $parraf_slides[] = $value->descripcion;
}
foreach ($object5 as $value) {
    $header_detalle[] = array("id" => $value->id, "desc" => $value->descripcion, "subtitulo" => $value->tiene_subtitulo);
}


$array['imagenes'] = $imgs;
$array['parrafos'] = $parrafos;
$array['condiciones'] = $condiciones;
$array['parraf_slides'] = $parraf_slides;
$array['titulos'] = $header_detalle;

for ($index = 0; $index < count($array['titulos']); $index++) {
    $object6 = $conexion->findById("subtitulo_conv", "id_header", $array['titulos'][$index]['id']);
    foreach ($object6 as $value) {
        $subtitulos[$index][] = array("id"=>$value->id, "desc"=>$value->descripcion, "id_titulo"=>$value->id_header, "detalle"=>json_encode(explode(",",$value->detalle)));
    }
}

$array['subtitulos'] = $subtitulos;


$conexion->desconectar();
echo json_encode($array);
//echo $array['titulos'][0]['id'] . " -- " . $subtitulos[0][0][0];


//echo '<pre>';
//
//print_r($array);
//
//echo '</pre>';



