<?php

////SUSTITUIR POR LA KEY DE GOOGLE
//$nweApiKey = "AIzaSyDLea5eRuIPqzCgV32C4T83Uya9uSHB7bw";
//$apiKeyLocalhost = "AIzaSyAPIlA-pb3Kylm_NmU4UI7MtlZ9r9MYT1w";
$key = "ABQIAAAA8oi6A4iKXhUjpk2wffFmZxRlEaP6bDbtL4JKrqarvKd0TI57ABQOHM3TEAOxBNebWNfzPPIb4SfudQ";
//$key = "AIzaSyAPIlA-pb3Kylm_NmU4UI7MtlZ9r9MYT1w";
//$key = "AIzaSyDLea5eRuIPqzCgV32C4T83Uya9uSHB7bw";
$gm = new EasyGoogleMap($key);
$gm->SetMapZoom(7);
$gm->SetAddress("");

//$gm->SetAddress("Terminal de Transporte, Arménia, Quindio, Colombia");
//$gm->SetInfoWindowText("Cali - Arménia<BR>Horarios: 20:30, 22:00<BR>Distancia: 428kms<BR>Duración aprox: 8horas");

$gm->mScale = true;
$gm->mInset = false;
$origen = (isset($_POST['origen'])) ? trim($_POST['origen']) : "";
$destino = (isset($_POST['destino'])) ? trim($_POST['destino']) : "";
$servicio = (isset($_POST['servicio'])) ? trim($_POST['servicio']) : "Selecciona";
$_SESSION['origen'] = $origen;
$_SESSION['destino'] = $destino;
$_SESSION['servicio'] = $servicio;
$fecha = (isset($_POST['datepicker'])) ? trim($_POST['datepicker']) : "";
$hora = (isset($_POST['hora'])) ? trim($_POST['hora']) : "";

if ($origen == '') {
    $_SESSION['origen'] = $origen = 'Cali';
}
if ($destino == '') {
    $_SESSION['destino'] = $destino = 'Bogota';
}
if ($servicio == '') {
    $_SESSION['servicio'] = $servicio = 'Selecciona';
}
$time = time();
if ($fecha == '') {
    $fecha = date("Y-m-d", $time);
}
if ($hora == '') {
    $horaF = date("H:i:s", $time);
} else {
    $horaF = $Hora . ":00";
}

if ($origen == 'Cali') {
    $origen = '7600101';
} elseif ($origen == 'Bogota') {
    $origen = '1100101';
} elseif ($origen == 'Buga') {
    $origen = '7611101';
} elseif ($origen == 'Ibagué') {
    $origen = '7300101';
} elseif ($origen == 'Manizales') {
    $origen = '1700101';
} elseif ($origen == 'Palmira') {
    $origen = '7652001';
} elseif ($origen == 'Pereira') {
    $origen = '6600101';
} elseif ($origen == 'Sevilla') {
    $origen = '7673601';
} elseif ($origen == 'Tuluá') {
    $origen = '7683401';
} elseif ($origen == 'Armenia') {
    $origen = '6300101';
}

if ($destino == '') {
    $destino = '1700101';
} elseif ($destino == 'Cali') {
    $destino = '7600101';
} elseif ($destino == 'Bogota') {
    $destino = '1100101';
} elseif ($destino == 'Buga') {
    $destino = '7611101';
} elseif ($destino == 'Ibagué') {
    $destino = '7300101';
} elseif ($destino == 'Manizales') {
    $destino = '1700101';
} elseif ($destino == 'Palmira') {
    $destino = '7652001';
} elseif ($destino == 'Pereira') {
    $destino = '6600101';
} elseif ($destino == 'Sevilla') {
    $destino = '7673601';
} elseif ($destino == 'Tuluá') {
    $destino = '7683401';
}





if ($origen == '7600101') {
    $origen = 'Terminal de Transporte, Cali - Valle del Cauca, Colombia';
} elseif ($origen == '1100101') {
    $origen = 'Terminal de transporte, Ciudad Salitre, Bogotá - Bogotá D.C., Colombia';
} elseif ($origen == '7611101') {
    $origen = 'Terminal De Transportes Buga, Buga - Valle Del Cauca, Colombia';
} elseif ($origen == '7300101') {
    $origen = 'Terminal De Transporte, Ibagué - Tolima, Colombia';
} elseif ($origen == '1700101') {
    $origen = 'Terminal De Transporte, Manizales - Caldas, Colombia';
} elseif ($origen == '7652001') {
    $origen = 'Calle 29 # 33-60, Palmira - Valle Del Cauca, Colombia';
} elseif ($origen == '6600101') {
    $origen = 'Terminal De Transporte, Pereira - Risaralda, Colombia';
} elseif ($origen == '7673601') {
    $origen = 'Calle 53 53, Sevilla - Valle Del Cauca, Colombia';
} elseif ($origen == '7683401') {
    $origen = 'Carrera 40 # 35, Tuluá - Valle Del Cauca, Colombia';
} elseif ($origen == 'Caicedonia') {
    $origen = 'Carrera 16 # 8-9, Caicedonia, Quindío, Colombia';
}



if ($destino == '7600101') {
    $destino = 'Terminal de Transporte, Cali - Valle del Cauca, Colombia';
} elseif ($destino == '1100101') {
    $destino = 'Terminal de transporte, Ciudad Salitre, Bogotá - Bogotá D.C., Colombia';
} elseif ($destino == '7611101') {
    $destino = 'Terminal De Transportes Buga, Buga - Valle Del Cauca, Colombia';
} elseif ($destino == '7300101') {
    $destino = 'Terminal De Transporte, Ibagué - Tolima, Colombia';
} elseif ($destino == '1700101') {
    $destino = 'Terminal De Transporte, Manizales - Caldas, Colombia';
} elseif ($destino == '7652001') {
    $destino = 'Calle 29 # 33-60, Palmira - Valle Del Cauca, Colombia';
} elseif ($destino == '6600101') {
    $destino = 'Terminal De Transporte, Pereira - Risaralda, Colombia';
} elseif ($destino == '7673601') {
    $destino = 'Calle 53 53, Sevilla - Valle Del Cauca, Colombia';
} elseif ($destino == '7683401') {
    $destino = 'Carrera 40 # 35, Tuluá - Valle Del Cauca, Colombia';
} elseif ($destino == 'Caicedonia') {
    $destino = 'Carrera 16 # 8-9, Caicedonia, Quindío, Colombia';
}
?>

