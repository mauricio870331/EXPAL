<?php
include("funciones_mysql.php");
$cedula = $_POST['cedula'];

$conexion = Conexion::conectar("expresop_vultra");

$sql = "SELECT nro_tiquete, 
                    origen,
                    destino, 
                    kilometros, 
                    fecha_viaje, 
                    DATE_ADD(fecha_viaje,INTERVAL 1 YEAR) as vence,
                    DATEDIFF(DATE_ADD(fecha_viaje,INTERVAL 1 YEAR),CURDATE()) as dias,
                    estado
                    FROM  tbl_tiquetes WHERE cod_usuario = '" . $cedula . "' AND Vijencia = 'S' AND solicitado = 0 order by nro_tiquete";

$stmt = $conexion->prepare($sql);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>No. Tiquete</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Puntos</th>
            <th>Fecha</th>
            <th>Vence</th>            
            <th>Dias Restantes</th>
        </tr>
    </thead>
    <tbody>       
        <?php
        if ($numfilas > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                ?>
                <tr>
                    <td><?php echo $row->nro_tiquete; ?></td>
                    <td><?php echo $row->origen; ?></td>
                    <td><?php echo $row->destino; ?></td>
                    <td><?php echo $row->kilometros; ?></td>
                    <td><?php echo $row->fecha_viaje; ?></td>
                    <td><b><?php echo $row->vence; ?></b></td>                  
                    <td style="text-align:center;" >
                        <?php if ($row->dias >= 10) { ?>
                            <span class="label label-success"><?php echo $row->dias ?></span>
                        <?php } else { ?>
                            <span class="label label-danger"><?php echo $row->dias ?></span>
                        <?php } ?>
                    </td>
                </tr>  
                <?php
            }
        } else {
            ?>	
            <tr>
                <td colspan="5">No hay resultados..</td>       
            </tr> 
            <?php
        }
        ?> 
    </tbody>
</table>