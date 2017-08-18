<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (isset($_GET['Accion']) && !empty($_GET['Accion'])) {
    include ("funciones_mysql.php");
    $conexion = conectar("expresop_vultra");
    $sql2 = "DELETE FROM tbl_tiquetes_anulados WHERE nro_tiquete = '" . $_GET['Accion'] . "'";
    $resultado2 = ejecutar($sql2, $conexion);
}
?>
<script>
    location.href = '../MenuUltraRestriccion.php';
    alert("Tiquete Eliminado");
</script>
