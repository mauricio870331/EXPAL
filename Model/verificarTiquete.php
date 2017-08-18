<?php
include("funciones_mysql.php");
$conexion = conectar("expresop_vultra");
$tiquete = $_POST['tiquete'];
$response = 0;
$sqlu = "UPDATE tbl_tiquetes SET estado = 'V' WHERE nro_tiquete = '" . $tiquete . "'";
$resultadoU = ejecutar($sqlu, $conexion);
if (mysql_affected_rows()>0) {
   $response = 1; 
}
echo $response ;



