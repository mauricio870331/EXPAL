<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$Valores = $_GET['Accion'];
$porciones2 = explode("-", $Valores);
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

        <div id="mainint">
            <div class="unterciom">
                <h2>Información de Proceso</h2>
                <p style="text-align: justify;">En esta vista tenemos los tiquetes de la persona que realizo la solicitud, de esos tiquetes 
                    solo selecionamos los  que necesitemos para validar el tiquete a regalar el usuario identifiaco con la Cedula :
                    <b><?php echo $porciones2[1]; ?></b> cuenta con los siguientes kilometros acumulados hasta el momento</p>   

                <?php
                $datos = array();
                $datosUser = array();

                $sql = "SELECT ruta, destino FROM parametrosGanador WHERE codigo = " . $porciones2[4] . "";

                $stmt = $conexion->prepare($sql);
                $rs = $stmt->execute();
                $numfilas = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_OBJ);

                $sql = "SELECT origen, destino, total_puntos 
                                FROM tbl_total_puntos 
                                WHERE ( (origen = '" . $row->ruta . "' and destino = '" . $row->destino . "') or
                               (origen = '" . $row->destino . "' and destino = '" . $row->ruta . "')) AND cod_usuario = '" . $porciones2[1] . "'";


                $stmt = $conexion->prepare($sql);
                $rs = $stmt->execute();
                ?> 
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                            
                            <th><b>Origen</b></th>
                            <th>Destino</th>
                            <th>Kmts</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php
                        while ($row2 = $stmt->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>                              
                                <td><?php echo $row2->origen; ?></td>

                                <td><?php echo $row2->destino; ?></td>

                                <td><?php echo $row2->total_puntos; ?></td>

                            </tr>  
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="dosterciosm">
                <h2>Tiquetes Registrados</h2>
                <form name="nuevo" method="post" action="">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <?php                      
                        $datosUT = array();
                        if ($porciones2[2] == 1) {
                            $sql = "SELECT cod_usuario, nro_tiquete, origen, destino, kilometros 
                                FROM tbl_tiquetes WHERE ((origen = '" . $row->ruta . "' and destino = '" . $row->destino . "') or (origen = '" . $row->destino . "' and destino = '" . $row->ruta . "'))
                                AND cod_usuario = '" . $porciones2[1] . "' and solicitado = 1";
                            $stmt = $conexion->prepare($sql);
                            $rs = $stmt->execute();
                            ?>
                            <thead>
                                <tr>
                                    <th><b>Cédula</b></th>
                                    <th><b>Tiquete</b></th>
                                    <th><b>Origen</b></th>
                                    <th>Destino</th>
                                    <th>Kl</th> 
                                    <th><i class="fa fa-check-circle" ></i></th>
                                </tr>
                            </thead>                   
                            <tbody>
                                <?php
                                while ($row2 = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row2->cod_usuario; ?></td>                            
                                        <td><?php echo $row2->nro_tiquete; ?></td>
                                        <td><?php echo $row2->origen; ?></td>
                                        <td><?php echo $row2->destino; ?></td>              
                                        <td><?php echo $row2->kilometros; ?></td>            
                                        <td><input type="checkbox" id="<?php $row2->cod_usuario; ?>" data-km="<?php echo $row2->kilometros; ?>" onclick="Selecionar('<?php echo str_replace('-', '*', $row2->nro_tiquete); ?>',<?php echo $row2->kilometros; ?>,<?php echo $porciones2[0]; ?>)" ></td>
                                    </tr>  
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <button type="button" class="btn btn-default" onclick="Atras()">  
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> <B>Atras</B>
                    </button>
                    <button type="button" class="btn btn-default" onclick="Acept(<?php echo $porciones2[0]; ?>, '<?php echo $porciones2[3]; ?>', '<?php echo $porciones2[1]; ?>', '<?php echo $porciones2[2]; ?>', '<?php echo $porciones2[4]; ?>')" >
                        <span class="glyphicon glyphicon-floppy-saved"></span> <B>Guardar</B>
                    </button>
                    <?php
                } elseif ($porciones2[2] == 3) {
                    $sql1 = "update tbl_usuarioTiquete set estado='Rechazado' where codigooUsu=" . $porciones2[3];
                    //$sql2 = "update tbl_usuario set puntos=puntos+".$porciones2[0]." where cod_usuario=".$porciones2[1];
                    $resultado = ejecutar($sql1, $conexion);
                    // $resultad2o2 = ejecutar($sql2,$conexion);
                    $destino = "clienteultra@expresopalmira.com.co";
                    $asunto = "tiquetes Expreso palmira";
                    $cabeceras = "Content-type: text/html";
                    $cuerpo = "La persona de cedula " . $porciones2[1] . " ha sido rechazada para el premio del tiquete";
                    mail($destino, $asunto, $cuerpo, $cabeceras);
                    ?>
                    <table   cellspacing="0" width="100%">
                        <thead>
                            <tr style="height: 30px;">
                                <th><b>Mensaje</b></th>                                
                            </tr>
                        </thead>  
                        <tbody>
                            <tr>
                                <td>El señor <b><?php echo $porciones2[1]; ?></b> fue rechazado para un tiquete </td>
                            </tr> 
                            <tr>
                                <td>Se le informa por medio de correo </td>
                            </tr>  
                        </tbody>
                    </table>
                    <br><br>
                    <button type="button" class="btn btn-default" onclick="Atras()">  
                        <span class="glyphicon glyphicon-circle-arrow-left"></span> <B>Atras</B>
                    </button>
                    <?php
                }
                ?>                
            </div>
        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
