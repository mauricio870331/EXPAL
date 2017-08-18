<?php
include ("../inclu3.php");
include("funciones_mysql.php");
$cedula = $_POST['cedula'];
$opt = $_POST['opt'];
$alta = $_POST['alta'];
$hoy = date("Y-m-d");
$conexion = Conexion::conectar("expresop_vultra");

if ($opt == 1) {
    $sql = "SELECT id, 
     nro_tiquete,
     origen, 
     destino, 
     fecha_viaje, 
     estado,
     solicitado
     from tbl_tiquetes WHERE cod_usuario = '" . $cedula . "'  order by fecha_viaje";

    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    if ($numfilas > 0) {
        ?>

        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td class="col-xs-2"><B>Tiquete</B></td>
                    <td class="col-xs-2"><B>Origen</B></td>       
                    <td class="col-xs-2"><B>Destino</B></td>
                    <td class="col-xs-2"><B>Fecha Viaje</B></td>
                    <td class="col-xs-2"><B>Premiado</B></td>
                    <td class="col-xs-2"><B>Estado tiquete</B></td>       
                </tr>
            </thead>
            <tbody>       
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <tr>

                        <td><?php echo $row->nro_tiquete; ?></td>       
                        <td><?php echo $row->origen; ?></td>        
                        <td><?php echo $row->destino; ?></td>
                        <td><?php echo $row->fecha_viaje; ?></td>
                        <td style="width: 0.5%; text-align: center;"><b><?php echo ($row->solicitado == 2) ? 'Si' : 'No'; ?></b></td>
                        <td>
                            <?php if ($row->estado == "V") { ?>
                                <span class="label label-success">Verificado</span>
                            <?php } else { ?>
                                <span class="label label-danger">Pendiente</span>
                                <a id="verificar<?php echo $row->nro_tiquete ?>" class="myIcons verificar" data-value="<?php echo $row->nro_tiquete; ?>" title="Verificar"  href="javascript:void(0)" >
                                    <i class="fa fa-check-circle" ></i></a>
                            <?php } ?>
                        </td>
                    </tr>  
                    <?php
                }
                ?> 
            </tbody>
        </table>
        <?php
    } else {
        echo '<div class="alert alert-warning">No hay tiquetes registrados para este cliente</div>';
    }
}
if ($opt == 2) {
    $sql = "SELECT a.cod_tiquete , c.ruta, c.destino, a.fechaPedido, a.fechaentregado, a.servicio
              FROM  tbl_usuarioTiquete a,  tbl_usuario b,  parametrosGanador c
              WHERE a.estado =  'Aceptado'
              AND a.cod_persona = b.cod_usuario and a.cod_persona = " . $cedula . "
              AND a.cod_tiquete = c.codigo and a.fechaentregado between '" . $alta . "' and '" . $hoy . "'";

    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    if ($numfilas > 0) {
        ?>

        <table class="table table-hover">
            <thead>
                <tr>     
                    <td class="col-xs-2"><B>Tiquete</B></td>       
                    <td class="col-xs-2"><B>Origen</B></td>       
                    <td class="col-xs-2"><B>Destino</B></td>
                    <td class="col-xs-2"><B>Solicitado</B></td>
                    <td class="col-xs-2"><B>Entregado</B></td>
                    <td class="col-xs-2"><B>Servicio</B></td>       
                </tr>
            </thead>
            <tbody>       
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <tr>

                        <td><?php echo $row->cod_tiquete; ?></td>       
                        <td><?php echo $row->ruta; ?></td>        
                        <td><?php echo $row->destino; ?></td>
                        <td><?php echo $row->fechaPedido; ?></td>
                        <td><?php echo $row->fechaentregado; ?></td>  
                        <td><?php echo $row->servicio; ?></td>   

                    </tr>  
                    <?php
                }
                ?> 
            </tbody>
        </table>
        <?php
    } else {
        echo '<div class="alert alert-warning">No hay tiquetes redimidos para este cliente</div>';
    }
}
if ($opt == 3) {
    $sql = "SELECT id_total_puntos,                     
                    origen, 
                    destino, 
                    total_puntos                   
     from tbl_total_puntos
     WHERE cod_usuario = '" . $cedula . "' order by origen";

    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    if ($numfilas > 0) {
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td class="col-xs-2" style="text-align:center"><B>O.D - D.O</B></td>
                    <td class="col-xs-4"><B>Origen</B></td>       
                    <td class="col-xs-4"><B>Destino</B></td>
                    <td class="col-xs-2" style="text-align:center"><B>Total Km</B></td>                
                </tr>
            </thead>
            <tbody>       
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <tr>
                        <td style="text-align:center"><span class="glyphicon glyphicon-transfer" style="font-size: 20px;color: #072c5e;" title="[Origen-Destino] - [Destino-Origen] "></span></td>       
                        <td><?php echo $row->origen; ?></td>        
                        <td><?php echo $row->destino; ?></td>
                        <td style="text-align:center"><?php echo $row->total_puntos; ?></td> 
                    </tr>  
                    <?php
                }
                ?> 
            </tbody>
        </table>
        <?php
    } else {
        echo '<div class="alert alert-warning">No hay Kilometros acumulados para este cliente</div>';
    }
}
$stmt = null;
$conexion = null;
?>

