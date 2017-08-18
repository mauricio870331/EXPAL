<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_GET["user"]) && !empty($_GET["user"])) {

    $user = $_GET["user"];
    include ("funciones_mysql.php");
    $conexion = Conexion::conectar("expresop_vultra");
    $sql3 = "SELECT cod_usuario, Estado FROM  tbl_usuario WHERE cod_usuario =  '" . $user . "'";

    $stmt = $conexion->prepare($sql3);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_OBJ);  
    
   
    if ($row->Estado == "ACTIVO") {
        echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        return;
    }

    if ($numfilas > 0) {
        $sql = "UPDATE  tbl_usuario SET  Estado = 'ACTIVO' WHERE cod_usuario = '" . $user . "'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        ?>
        <script>
            location.href = '../cliente-ultra.php';
            alert("la cuenta se activo con éxito, inicie sesión para continuar");
        </script>
        <?php

    } else {
        ?>
        <script>
            location.href = '../index.php';
            alert("Error de activación de cuenta, es posible que el usuario no este registrado");
        </script>
        <?php

    }
}
?>