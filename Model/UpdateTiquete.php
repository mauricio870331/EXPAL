<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_POST["tiquete"]) && !empty($_POST["tiquete"])) {
    $tiquete = $_POST["tiquete"];
    $oldTiquete = $_POST["oldTiquete"];
    $opc = $_POST["opc"];
    $msj = "";
    include ("funciones_mysql.php");
    $conexion = conectar("expresop_vultra");
    $sql = "SELECT *  FROM  tbl_tiquetes_anulados WHERE nro_tiquete  = '" . $tiquete . "'";
    $resultado = ejecutar($sql, $conexion);
    //$cant = mysql_num_rows($resultado);
    if (mysql_num_rows($resultado) == 0) {
        if ($opc == "C") {           
            $sql2 = "INSERT INTO tbl_tiquetes_anulados VALUES ('" . $tiquete . "')";
            $msj = "Tiquete Creado";
        } else {          
            $sql2 = "UPDATE tbl_tiquetes_anulados SET nro_tiquete = '" . $tiquete . "' WHERE nro_tiquete = '" . $oldTiquete . "'";
            $msj = "Tiquete Actualizado";
        }
        $resultado2 = ejecutar($sql2, $conexion);
    } else {
        $msj = "El Tiquete # $tiquete ya existe";
    }
}
echo '<script>
       location.href="../MenuUltraRestriccion.php";
       alert("' . $msj . '");
       </script>'
?>

