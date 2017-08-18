<?php
session_start();
$cedula = $_POST['cedula'];
include ("funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
 $sql3 = "SELECT t.id_total_puntos, 
                                t.origen,
                                t.destino,
                                t.total_puntos,
                                CASE WHEN (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.origen AND `destino` LIKE t.destino)
                                is null then  (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.destino AND `destino` LIKE t.origen)
                                else (SELECT Kilometros FROM parametrosGanador WHERE ruta LIKE t.origen AND `destino` LIKE t.destino) end kilometros,
                               (select sum(kilometros) from tbl_tiquetes WHERE Vijencia = 'S' AND estado = 'V' AND solicitado = 0 
                                AND ((origen = t.origen AND destino = t.destino) OR (origen = t.destino AND destino = t.origen)) 
                                AND cod_usuario = '" . $cedula . "') reales     
                                FROM tbl_total_puntos t WHERE cod_usuario = '" . $cedula . "'";  

$stmt = $conexion->prepare($sql3);
$rs = $stmt->execute();
?>
<p style="font-size:11px;"><b>Nota: </b>Requeridos son la cantidad de  Kilometros necesarios para reclamar el tiquete gratis en esa ruta.</p>
<table class="table table-hover">
    <thead>
        <tr>
            <td class="col-xs-2"><B>Origen</B></td>
            <td class="col-xs-2"><B>Destino</B></td>
            <td class="col-xs-2"><B>Total</B></td>
            <td class="col-xs-2"><B>Requeridos</B></td>
            <td class="col-xs-2"><B>Faltan</B></td>        
            <td class="col-xs-2"></td>
        </tr>
    </thead>
    <tbody>       
        <?php
         while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
                <td><?php echo $row->origen; ?></td>
                <td><?php echo $row->destino; ?></td>
                <td><?php echo $row->total_puntos; ?></td>
                <td><?php echo $row->kilometros; ?></td>        
                <td><?php echo ($row->kilometros-$row->total_puntos <= 0) ? 0 : $row->kilometros-$row->total_puntos; ?></td>
                <td>
                    <?php
                    if ($row->reales >= $row->kilometros) {
                        ?> 
                        <a href="#" id="rq<?php echo $row->id_total_puntos; ?>" data-origen="<?php echo $row->origen; ?>" data-destino="<?php echo $row->destino; ?>" onclick="setId2('<?php echo $row->id_total_puntos; ?>', '<?php echo $cedula ?>');"  data-toggle="modal" data-target="#requestTiquet">
                            <span style="cursor: pointer" class="glyphicon glyphicon-tag" title="Solicitar Tiquete">
                            </span>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="#"  data-toggle="modal" data-target="#requestNoTiquet">
                            <span style="cursor: pointer" class="glyphicon glyphicon-tag" title="Solicitar Tiquete">
                            </span>
                        </a>
                        <?php
                    }
                    ?>
                </td>        
            </tr>  
            <?php
        }
        $stmt = null;
        $conexion = null;
        ?> 
    </tbody>
</table>