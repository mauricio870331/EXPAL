<?php
$fechaI = $_POST['fecINI'];
$fechaF = $_POST['fecFin'];
include('../inclu2.php'); 
include ("funciones_mysql.php");
$conexion = conectar("expresop_vultra");
$kilom = 0;
?>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><b>Cédula</b></th>
            <th><b>Nombre</b></th>
            <th><b>Origen</b></th>
            <th>Destino</th>
            <th>Fecha</th>
            <th>Servicio</th>            
        </tr>
    </thead>                   
    <tbody>
        <?php
        $sql = "SELECT a.codigooUsu,b.cod_usuario, b.nombre, c.ruta, c.destino, a.fechaentregado, a.servicio
              FROM  tbl_usuarioTiquete a,  tbl_usuario b,  parametrosGanador c
              WHERE a.estado =  'Aceptado'
              AND a.cod_persona = b.cod_usuario
              AND a.cod_tiquete = c.codigo and a.fechaentregado between '" . $fechaI . "' and '" . $fechaF . "'";
        $resultado = ejecutar($sql, $conexion);
        if (mysql_num_rows($resultado) > 0) {
            while ($campo = mysql_fetch_row($resultado)) {
                ?><tr>
                    <td><?php echo $campo[1]; ?></td>
                    <td><?php echo $campo[2]; ?></td>
                    <td><?php echo $campo[3]; ?></td>
                    <td><?php echo $campo[4]; ?></td>
                    <td><?php echo $campo[5]; ?></th>
                    <th><?php echo $campo[6]; ?></td>            
                </tr>  
                <?php
            }
            ?>

        </tbody>
    </table> 
    <?php
} else {
    echo '<div class="alert alert-warning">No hay premios para entregar en el rango de fechas seleccionado</div>';
}

?>