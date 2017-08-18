<?php
include("funciones_mysql.php");

$id = $_POST['id'];
//echo '<td class="col-xs-2" >',($fila[$i]<=0) ? 0 : $fila[$i],'</td>';
$conexion = Conexion::conectar("expresop_vultra");

$sql = "SELECT t1.total_puntos, 
                    t2.kilometros,
                    CASE WHEN t2.kilometros-t1.total_puntos < 0 then 0 ELSE  t2.kilometros-t1.total_puntos END as puntos from tbl_total_puntos t1, parametrosGanador t2 
         where t1.id_total_puntos = " . $id . " and t1.origen = t2.ruta and t1.destino = t2.destino";

$stmt = $conexion->prepare($sql);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
$row = $stmt->fetch(PDO::FETCH_OBJ)
?>
<p style="font-size: 0.7em;"><b>Nota: </b>Requeridos son la cantidad de Km necesarios para solicitar un tiquete.. <br><b>"Es posible que aún hayan tiquetes pendientes por verificar, comuciquese con clientesultra@expresopalmira.com.co"</b></p>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Acumulados</th>
            <th>Requeridos</th>
            <th>Faltan</th>        
        </tr>
    </thead>
    <tbody>       
        <?php
        if ($numfilas > 0) {
            ?>
            <tr>
                <td><?php echo $row->total_puntos; ?></td>
                <td><?php echo $row->kilometros; ?></td>
                <td><?php echo $row->puntos; ?></td>
            </tr>  
            <?php
        } else {
            ?>	
            <tr>
                <td colspan="2">No hay resultados..</td>       
            </tr> 
            <?php
        }
        ?> 
    </tbody>
</table>