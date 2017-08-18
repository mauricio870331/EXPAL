<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_POST["cedula"]) && !empty($_POST["cedula"])) {
    $cedula = $_POST["cedula"];
    $oldcedula = $_POST["oldcedula"];
    $opc = $_POST["opc2"];
    $msj = "";
    include ("funciones_mysql.php");
    $conexion = conectar("expresop_vultra");
    $sql = "SELECT *  FROM  tbl_users_anulados WHERE cod_usuario  = " . $cedula . "";
    $resultado = ejecutar($sql, $conexion);
    //$cant = mysql_num_rows($resultado);
    if (mysql_num_rows($resultado) == 0) {
        if ($opc == "C") {
            $sql2 = "INSERT INTO tbl_users_anulados VALUES (" . $cedula . ")";
            $msj = "Cedula Creada";
        } else {
            $sql2 = "UPDATE tbl_users_anulados SET cod_usuario = " . $cedula . " WHERE cod_usuario = " . $oldcedula . "";
            $msj = "Cedula Actualizada";
        }
        $resultado2 = ejecutar($sql2, $conexion);
    } else {
        $msj = "La Cedula # $cedula ya existe";
    }
}
echo '<script>
       location.href="../MenuUltraRestriccion.php";
       alert("' . $msj . '");
       </script>'
?>