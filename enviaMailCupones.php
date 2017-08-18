<?php
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$sqlc = "CALL contarCupones()";
$stmt = $conexion->prepare($sqlc);
$rs = $stmt->execute();
$destino = "ventas.institucionales@expresopalmira.com.co, desarrollo1@expresopalmira.com.co";
$asunto = "Total Cupones Descargados Por Convenio";
$cabecera = 'MIME-Version: 1.0' . "\r\n";
$cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabecera .= 'From: ' . 'Mauricio Herrera' . ' <desarrollo1@expresopalmira.com.co>' . "\r\n";
$tabla = "<table style='width:40%' border='1'>
  <tr>
     <td><b>Convenio</b></td>
    <td><b>Cantidad Descargas</b></td>   
  </tr>";
$m = 0;
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $color = "#F0EEEE";
    if ($m % 2 == 0) {
        $color = "#FFFFFF";
    }
    $tabla .= "<tr style='background: $color;'>
<td>$row->id_convenio</td>
<td>$row->cantidad</td>
</tr >";
    $m++;
}
$tabla .= "</table>";
mail($destino, $asunto, $tabla, $cabecera);
$stmt = null;
$conexion = null;
?>