<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");


if ((isset($_GET['fechaini']) && !empty($_GET['fechaini'])) && (isset($_GET['fechafin']) && !empty($_GET['fechafin']))) {
    $sql = "SELECT distinct k.origen, k.destino, u.ciudad FROM tbl_usuarioTiquete t "
            . "left join tbl_kilometros k on t.cod_ruta = k.cod_ruta "
            . "left join tbl_usuario u on u.cod_usuario = t.cod_persona where u.ciudad = '" . $_GET['ciudad'] . "' "
            . "AND t.fechaPedido BETWEEN '" . $_GET['fechaini'] . " 00:00:00' and '" . $_GET['fechafin'] . " 23:59:59'";
} else {
    $sql = "SELECT distinct k.origen, k.destino, u.ciudad FROM tbl_usuarioTiquete t "
            . "left join tbl_kilometros k on t.cod_ruta = k.cod_ruta "
            . "left join tbl_usuario u on u.cod_usuario = t.cod_persona where u.ciudad = '" . $_GET['ciudad'] . "'";
}

$stmt = $conexion->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu2.php'); ?>

    </head>
    <body>
        <?php include('header2.html'); ?>

        <div id="slider-sombra"></div>

        <div id="mainint2">
            <div class="statics">
                <h2>EN QUE RUTAS REDIMEN LOS USUARIOS DE LA CIUDAD : <?php echo $_GET['ciudad'] ?></h2>                
                <br> 
                <div id="rs">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Origen</b></th>
                                <th><b>Destino</b></th> 
                                <th><b>Cantidad de Clientes que Redimen</b></th> 
                            </tr>
                        </thead>                   
                        <tbody > 
                            <?php while ($row = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                <tr>
                                    <td><?php echo $row->origen; ?></td>
                                    <td><?php echo $row->destino; ?></td>
                                    <td>
                                        <?php
//                                        echo "select cuantosRedimen('".$row->origen."','".$row->destino."','" . $_GET['ciudad'] . "') cantidad";die;
                                        if ((isset($_GET['fechaini']) && !empty($_GET['fechaini'])) && (isset($_GET['fechafin']) && !empty($_GET['fechafin']))) {
                                            $sql2 = "select cuantosRedimenFechas('" . $row->origen . "','" . $row->destino . "','" . $_GET['ciudad'] . "','" . $_GET['fechaini'] . " 00:00:00','" . $_GET['fechafin'] . " 23:59:59') cantidad";
                                        } else {
                                            $sql2 = "select cuantosRedimen('" . $row->origen . "','" . $row->destino . "','" . $_GET['ciudad'] . "') cantidad";
                                        }
                                        $stmt2 = $conexion->prepare($sql2);
                                        $stmt2->execute();
                                        $cant = $stmt2->fetch(PDO::FETCH_OBJ);
                                        echo $cant->cantidad;
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            $stmt = null;
                            $stmt2 = null;
                            $conexion = null;
                            ?>
                        </tbody>
                    </table>   
                </div>
            </div>


        </div>
<?php include('footer.html'); ?>
    </body>
</html>
