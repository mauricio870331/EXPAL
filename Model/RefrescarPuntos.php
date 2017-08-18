<?php
include ("funciones_mysql.php");
$conexion = conectar("expresop_vultra");

$sqlp = "SELECT sum(kilometros) from tbl_tiquetes where cod_usuario='" . $_POST['cedula'] . "' and estado='V' ";
$resultadoP = ejecutar($sqlp, $conexion);
if ($campoP = mysql_fetch_row($resultadoP)) {
    $sum = $campoP[0];
} else {
    $sum = 0;
}
?>

<button 						  
    style="background: linear-gradient( to bottom, #ffff00,#ffff00);
    font-size:10px;color:black;"
    type="button" onclick="Refrescar('<?php echo  $_POST['cedula'] ?>');">
    <b>Actualizar</b></button>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><b>Origen</b></th>
            <th><b>Destino</b></th>
            <th><b>Km</b></th>
            <th style="text-align:center;" ><i style="color:brown;" class="fa fa-gift" aria-hidden="true"></i></th>

        </tr>
    </thead>                   
    <tbody>
        <?php
        $sqlp = "SELECT sum(kilometros) from tbl_tiquetes where cod_usuario='" . $_POST['cedula'] . "' and estado='V' and Vijencia = 'S' ";
        $resultadoP = ejecutar($sqlp, $conexion);
        if ($campoP = mysql_fetch_row($resultadoP)) {
            $sum = $campoP[0];
        } else {
            $sum = 0;
        }
        $sql3 = "SELECT t1.id_total_puntos,
                                        t1.origen, 
                                        t1.destino, 
                                        t1.total_puntos, 
                                        t2.kilometros 
                                from tbl_total_puntos t1, parametrosGanador t2 
                           where t1.cod_usuario='" . $_POST['cedula'] . "' 
                           and t1.origen = t2.ruta and t1.destino = t2.destino";
        $resultado3 = ejecutar($sql3, $conexion);

        while ($campo = mysql_fetch_row($resultado3)) {
            ?><tr>
                <td><?php echo $campo[1]; ?></td>
                <td><?php echo $campo[2]; ?></td>
                <td><?php echo $campo[3]; ?></td> 
                <td>
                    <?php
                    if ($sum >= $campo[4]) {
                        echo '
                                        
                                          <button  data-toggle="modal" data-target="#requestTiquet" 
                                             id="rq' . $campo[0] . '" data-origen="' . $campo[1] . '" data-destino="' . $campo[2] . '"
										 style="background: linear-gradient( to bottom, #ffff00,#ffff00);
										 font-size:10px;color:black;"
										 type="button" onclick="setId(' . $campo[0] . ');" title="Redimir Tiquete">
										<b>Redimir Tiquete</b></button>				        	          
				        	          ';
                    } else {
                        echo '
                                          <button data-toggle="modal" data-target="#myModalPuntos" 
										 style="background: linear-gradient( to bottom, #ffff00,#ffff00);
										 font-size:10px;color:black;"
										 type="button" onclick="verMisPuntos(' . $campo[0] . ');">
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