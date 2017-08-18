<?php
session_start();
include('../inclu2.php');
include("funciones_mysql.php");
$fecINI = $_POST['fecINI'];
$fecFin = $_POST['fecFin'];
$opc = $_POST['opc'];
$_SESSION['fecha_inicial'] = $fecINI;
$_SESSION['fecha_final'] = $fecFin;
$conexion = conectar("expresop_vultra");
$and = "";
$d = "";
$tbl = "";
if ($opc == "ganador") {
   $d = "distinct";
   $and = "and u.cod_usuario = t.cod_usuario";
   $tbl = ", tbl_tiquetes_hero t";
}

?>

<?php 
if ($opc != "t_ultra") { ?>  
    <a href="Model/clientUltraToExcel.php?opc=<?php echo $opc ?>" style="text-decoration:none;" title="Exportar Clientes a Excel" target="_blank"><span class="glyphicon glyphicon-floppy-save"></span>&nbspListado de clientes</a>
    <br>
 <?php } ?>
<a href="Model/tiquetesUltraToExcel.php?opc=<?php echo $opc ?>" style="text-decoration:none;" title="Exportar Tiquetes a Excel" target="_blank"><span class="glyphicon glyphicon-floppy-save"></span>&nbspTiquetes Registrados</a>
<br>
<br>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><b>Cédula</b></th>
            <th><b>Nombre</b></th>
            <th><b>Telefono</b></th>
            <th><b>E-mail</b></th>
            <th><b>Ciudad</b></th>
            <th><b>Fecha Alta</b></th>
            <th><b>Activo</b></th>   
            <th></th>  
        </tr>
    </thead>                   
    <tbody>
        <?php
        if ($opc != "t_ultra") { 
        $sql = "SELECT ".$d." u.cod_usuario, 
                    u.nombre,
                    u.apellido, 
                    u.telefono, 
                    u.correo, 
                    u.ciudad,
                    u.fecha_creacion,
                    u.Estado
            from tbl_usuario u ".$tbl." WHERE u.fecha_creacion BETWEEN '" . $fecINI . " 00:00:00' AND  '" . $fecFin . " 23:59:59' 
            AND u.Rol = 'cliente' ".$and." order by u.fecha_creacion";
        }else{
             $sql = "SELECT u.cod_usuario, 
                    u.nombre,
                    u.apellido, 
                    u.telefono, 
                    u.correo, 
                    u.ciudad,
                    u.fecha_creacion,
                    u.Estado
            from tbl_usuario u, tbl_tiquetes t  WHERE t.fecha_mod BETWEEN '" . $fecINI . " 00:00:00' AND  '" . $fecFin . " 23:59:59' 
            AND u.Rol = 'cliente' and u.cod_usuario = t.cod_usuario order by t.fecha_mod";
        }

        $resultado = ejecutar($sql, $conexion);
        while ($campo = mysql_fetch_row($resultado)) {
            ?>
            <tr>
                <td class="mini"><?php echo $campo[0] ?></td>
                <td class="mini"><?php echo $campo[1] . " " . $campo[2]; ?></td>       
                <td class="mini"><?php echo $campo[3]; ?></td>        
                <td class="mini"><?php echo $campo[4]; ?></td>
                <td class="mini"><?php echo $campo[5]; ?></td>
                <td class="mini"><?php echo $campo[6]; ?></td>
                <td class="mini"><?php if ($campo[7] == "ACTIVO") { ?>
                        <span class='label label-success'>Si</span>
                    <?php } else { ?>
                        <span class='label label-danger'>No</span> 
                    <?php } ?>
                </td> 
                <td class="mini">
                    <span style="cursor:pointer"  data-toggle="modal" data-target="#modalDetalleCliente" onclick="cleanModalDetalle(); setCedula(<?php echo $campo[0] ?>, '<?php echo substr($campo[6], 0, -9) ?>');" class="glyphicon glyphicon-list" title="Ver más" aria-hidden="true"></span>
                </td>      
            </tr>  
            <?php
        }
        ?>

    </tbody>
</table> 





