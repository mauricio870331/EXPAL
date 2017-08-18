<?php
include("funciones_mysql.php");
$conexion = conectar("expresop_vultra");
$cedula = $_POST['cedula'];
$activar = $_POST['activar'];

if ($activar) {
    $sqlu = "UPDATE tbl_usuario SET Estado = 'ACTIVO' WHERE cod_usuario = '" . $cedula . "'";
    $resultadoU = ejecutar($sqlu, $conexion);
}


$sql = "SELECT nombre, apellido, telefono, correo, ciudad, Estado FROM tbl_usuario WHERE cod_usuario = '" . $cedula . "'";
$resultado = ejecutar($sql, $conexion);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Ciudad</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>       
        <?php
        if ($campo = mysql_fetch_row($resultado)) {
            ?>
            <tr>
                <td><?php echo $campo[0] . " " . $campo[1]; ?></td>
                <td><?php echo $campo[2]; ?></td>
                <td><?php echo $campo[3]; ?></td>
                <td><?php echo $campo[4]; ?></td>
                <td><?php echo ($campo[5] == "ACTIVO") ? $campo[5] : "<button style='background: linear-gradient( to bottom, #ffff00,#ffff00);font-size:12px;color:black;'
                                                                  type='button' onclick='consultarCliente(1)'><b>Activar</b></button>";
            ?>
                </td>
            </tr>  
            <?php
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