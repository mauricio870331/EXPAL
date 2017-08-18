<html>
    <head>
        <link rel="icon" type="image/png" href="../base/favicon.png" />
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Ingrese Documento:<input type="text" name="clave" style="width: 200px;"/>
            <input type="submit" name="send" value="Desencriptar">
        </form>
        <?php
        include ("funciones_mysql.php");
        $conexion = Conexion::conectar("expresop_vultra");
        include ("encriptar.php");
        if (isset($_POST['send'])) {

            $sqlc = "SELECT clave from tbl_usuario where cod_usuario = '" . $_POST['clave'] . "'";
//    echo $sqlc;
            $stmt = $conexion->prepare($sqlc);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);

            if (isset($_POST['clave']) && !empty($_POST['clave'])) {
                echo "la clave es: <b>" . $texto_original = Encrypter::decrypt($row->clave) . "<b>";
            }
        }
//vPfrGud2hGYmV9AiygbXnor6Zqu7r+h8PNjIr3hPdWs=
        ?>
    </body>
</html>


