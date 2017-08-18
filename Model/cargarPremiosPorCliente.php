<?php
include("funciones_mysql.php");
$cedula = $_POST['cedula'];


$conexion = conectar("expresop_vultra");
$sql = "SELECT t1.nombre, t1.apellido, t2.fechaPedido, t2.fechaEntregado, t2.servicio,
                    t3.origen, t3.destino , t2.estado 
             FROM tbl_usuario t1,
                  tbl_usuarioTiquete t2,
                  tbl_kilometros t3
             WHERE t1.cod_usuario = t2.cod_persona AND t2.cod_ruta = t3.cod_ruta AND  t1.cod_usuario = '" . $cedula . "'";

$resultado = ejecutar($sql, $conexion);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha Solicitud</th>
            <th>Fecha Aceptado</th>
            <th>Servicio</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>       
<?php
if (mysql_num_rows($resultado) > 0) {
    while ($campo = mysql_fetch_row($resultado)) {
        ?>
                <tr>
                    <td><?php echo $campo[0] . " " . $campo[1]; ?></td>
                    <td><?php echo $campo[2]; ?></td>
                    <td><?php echo $campo[3]; ?></td>
                    <td><?php echo $campo[4]; ?></td>
                    <td><?php echo $campo[5]; ?></td>
                    <td><?php echo $campo[6]; ?></td>
                    <td><?php echo $campo[7]; ?></td>
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