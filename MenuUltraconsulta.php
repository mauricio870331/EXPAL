<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu2.php'); ?>

    </head>
    <body>
        <?php include('header3.php'); ?>

        <div id="slider-sombra"></div>

        <div id="mainint">
            <div class="unterciom">
                <h2>Kilometros Acumulados</h2>
                <!--<button 						  
                    style="background: linear-gradient( to bottom, #ffff00,#ffff00);
                    font-size:10px;color:black;"
                    type="button" onclick="Refrescar('<?php //echo $_SESSION['cod_usuario']         ?>');">
                    <b>Actualizar</b></button>-->
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><b>Origen</b></th>
                            <th><b>Destino</b></th>
                            <th><b>Km</b></th>
                            <th style="text-align:center;" >
                                <i style="color:brown;" class="fa fa-gift" aria-hidden="true"></i></th>

                        </tr>
                    </thead>                   
                    <tbody>
                        <?php
                        $sql3 = "SELECT t.id_total_puntos, 
                                t.origen,
                                t.destino,
                                t.total_puntos,
                                CASE WHEN (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.origen AND `destino` LIKE t.destino)
                                is null then  (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.destino AND `destino` LIKE t.origen)
                                else (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.origen AND `destino` LIKE t.destino) end kilometros,
                               (select sum(kilometros) from tbl_tiquetes WHERE Vijencia = 'S' AND estado = 'V' AND solicitado = 0 
                                AND ((origen = t.origen AND destino = t.destino) OR (origen = t.destino AND destino = t.origen)) 
                                AND cod_usuario = '" . $_SESSION['cod_usuario'] . "') reales     
                                FROM tbl_total_puntos t WHERE cod_usuario = '" . $_SESSION['cod_usuario'] . "'";     

//                        echo $sql3;die;

                        $stmt = $conexion->prepare($sql3);
                        $rs = $stmt->execute();


                        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                            ?><tr>
                                <td><?php echo $row->origen; ?></td>
                                <td><?php echo $row->destino; ?></td>
                                <td><?php echo $row->total_puntos; ?></td> 
                                <td>
                                    <?php
                                    if ($row->reales  >= $row->kilometros) {
                                        echo '                                        
          <button  data-toggle="modal" data-target="#requestTiquet" 
             id="rq' . $row->id_total_puntos . '" data-origen="' . $row->origen . '" data-destino="' . $row->destino . '"
                                                 style="background: linear-gradient( to bottom, #ffff00,#ffff00);
                                                 font-size:10px;color:black;"
                                                 type="button" onclick="setId(' . $row->id_total_puntos . ');" 
                                                     title="Redimir Tiquete">
                                                <b>Redimir Tiquete</b></button>				        	          
                          ';
                                    } else {
                                        echo '
          <button data-toggle="modal" data-target="#myModalPuntos" 
                                                 style="background: linear-gradient( to bottom, #ffff00,#ffff00);
                                                 font-size:10px;color:black;"
                                                 type="button" onclick="verMisPuntos(' . $row->id_total_puntos . ');">
                                                <b>Redimir Tiquete</b></button>				        	          
                          ';
                                    }
                                    ?>
                                </td>
                            </tr>  
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="dosterciosm">
                <h2>Tiquetes Registrados</h2>                
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><b>Tiquete</b></th> 
                            <th><b>Origen</b></th>
                            <th>Destino</th>                           
                            <th>Fecha</th>
                            <th>Km</th>
                            <th>Estado</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php
                        $kilom = 0;
                        $sql = "SELECT nro_tiquete,
                                       origen,
                                       destino,
                                       fecha_viaje,
                                       kilometros,
                                       case when estado='V' then 'Verificado'
                                      when estado='P' then 'Pendiente' end as estado
                                FROM tbl_tiquetes 
                                where cod_usuario ='" . $_SESSION['cod_usuario'] . "' AND Vijencia = 'S' AND solicitado = 0";
                        $stmt2 = $conexion->prepare($sql);
                        $stmt2->execute();

                        $sql2 = "SELECT sum(kilometros) kilometros FROM tbl_tiquetes where cod_usuario = '" . $_SESSION['cod_usuario'] . "'";
                        $stmt3 = $conexion->prepare($sql2);
                        $stmt3->execute();

                        while ($row3 = $stmt3->fetch(PDO::FETCH_OBJ)) {
                            $kilom = $row3->kilometros;
                        }

                        while ($row2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                            ?><tr>
                                <td><?php echo $row2->nro_tiquete; ?></td>
                                <td><?php echo $row2->origen; ?></td>
                                <td><?php echo $row2->destino; ?></td>
                                <td><?php echo $row2->fecha_viaje; ?></td>
                                <td><?php echo $row2->kilometros; ?></th>
                                <td><?php echo $row2->estado; ?></td>                                
                            </tr>  
                            <?php
                        }
                        $conexion = null;
                        $stmt = null;
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- modal solicitar tiquete -->
            <div id="requestTiquet" class="modal fade" tabindex="-1" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- dialog body -->
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            ¿Desea solicitar un tiquete?
                            <?php
                            echo '<form name="rquest" method="post" id="rquest" > </form>';
                            ?> 
                            <hr>
                            <label> Seleccione la ruta:</span>
                                <div class="radio">
                                    <label><input type="radio" id="opciones_1" name="optradio" checked><span id="r1"></span></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" id="opciones_2" name="optradio"><span  id="r2"></span></label>
                                </div>	
                        </div> 
                        <!-- dialog buttons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="ValidarKilometros('<?php echo $_SESSION['cod_usuario'] ?>')">Si</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
                        </div>

                    </div>
                </div>
            </div>
            <!--fin Modal inscribete-->

            <!-- Modal DATOS CLIENTE--> 
            <div id="myModalPuntos" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:500px;height:250px;">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Mis Kilometros</h4>
                        </div>
                        <div class="modal-body">
                            <div id="responsePuntos"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>	
            <!-- FIN MODAL DATOS CLIENTE-->

        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
