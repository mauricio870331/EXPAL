<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (isset($_GET['Accion']) && !empty($_GET['Accion'])) {    
include ("funciones_mysql.php");
$conexion = conectar("expresop_vultra");
$sql2 = "DELETE FROM tbl_users_anulados WHERE cod_usuario = ".$_GET['Accion']."";
$resultado2 = ejecutar($sql2,$conexion);
}	
?>
<script>
location.href='../MenuUltraRestriccion.php';
alert("Cedula Eliminada");
</script>
