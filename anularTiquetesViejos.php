<?php
date_default_timezone_set('America/Bogota');
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$hoy = date("Y-m-d h:m:s");

$sql = "update tbl_tiquetes set Vijencia = 'S', fecha_viaje = fecha_mod WHERE fecha_viaje in ('1900-01-01', '0000-00-00')";
$stmt = $conexion->prepare($sql);
$stmt->execute();
//$numfilas = $stmt->rowCount();


$sqlm = "SELECT nro_tiquete, cod_usuario, origen, destino, kilometros FROM  tbl_tiquetes  "
        . "WHERE CURDATE() >= DATE_ADD(fecha_viaje ,INTERVAL 1 YEAR) AND Vijencia = 'S' and solicitado = 0";
$stmtm = $conexion->prepare($sqlm);
$stmtm->execute();
while ($row = $stmtm->fetch(PDO::FETCH_OBJ)) {   
    $sql = "UPDATE tbl_total_puntos SET total_puntos = total_puntos-".$row->kilometros." "
          . "WHERE cod_usuario = '".$row->cod_usuario."' and ((origen = '".$row->origen."'"
            . " and destino = '".$row->destino."') or (origen = '".$row->destino."' and destino = '".$row->origen."'))";
    $stmt3 = $conexion->prepare($sql);
    $stmt3->execute();
}

$sql = "UPDATE tbl_tiquetes SET Vijencia = 'N', solicitado = 2, fecha_mod = '".$hoy."'"
        . " WHERE CURDATE() >= DATE_ADD(fecha_viaje ,INTERVAL 1 YEAR) AND Vijencia = 'S' and solicitado = 0";
$stmt = $conexion->prepare($sql);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();

if ($numfilas > 0) {
//    $sql2 = "SELECT puntos, origen, destino, cod_usuario FROM  tbl_tiquetes  WHERE Vijencia =  'N'";
//    $stmt = $conexion->prepare($sql2);
//    $stmt->execute();
//    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
//        $puntos = $row->puntos;
//        $origen = $row->origen;
//        $destino = $row->destino;
//        $user = $row->cod_usuario;
//        $sql3 = "UPDATE tbl_total_puntos SET total_puntos = (total_puntos-$puntos) WHERE cod_usuario = '" . $user . "' AND total_puntos > 0 AND ((origen ='" . $origen . "' AND destino ='" . $destino . "') OR (origen ='" . $destino . "' AND destino ='" . $origen . "'))";
//        $stmt = $conexion->prepare($sql3);
//        $stmt->execute();
//    }
//    $filas_afectadas = $stmt->rowCount();
    $asunto = "Reporte Cron Job Anular tiquetes";
    $cabeceras = "Content-type: text/html";
    $destino = "desarrollo1@expresopalmira.com.co";
    $cuerpo = "Cron Job Anular tiquetes Ejecutado con " . utf8_decode("éxito") . " Registros afectados = " . $numfilas;
    mail($destino, $asunto, $cuerpo, $cabeceras);
} else {
    $asunto = "Reporte Cron Job Anular tiquetes";
    $cabeceras = "Content-type: text/html";
    $destino = "desarrollo1@expresopalmira.com.co";
    $cuerpo = "Cron Job Anular tiquetes Ejecutado con " . utf8_decode("éxito") . " No hay tiquetes vencidos";
    mail($destino, $asunto, $cuerpo, $cabeceras);
}
$conexion = null;
?>