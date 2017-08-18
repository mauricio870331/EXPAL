<?php
include ("funciones_mysql.php");
include_once('../inclu2.php');

if ((isset($_POST['fechaini']) && !empty($_POST['fechaini'])) && (isset($_POST['fechafin']) && !empty($_POST['fechafin']))) {
    $sql = "select DISTINCT case WHEN u.ciudad = '' then 'NO REGISTRA' else u.ciudad end ciudad,"
            . " (select count(ciudad) from tbl_usuario where ciudad = u.ciudad"
            . " and fecha_creacion between '" . $_POST['fechaini'] . " 00:00:00'"
            . " and '" . $_POST['fechafin'] . " 23:59:59') cantidad from tbl_usuario u"
            . " where u.fecha_creacion between '" . $_POST['fechaini'] . " 00:00:00' and '" . $_POST['fechafin'] . " 23:59:59'";

    $inscritos = "Cantidad de Inscritos entre: " . $_POST['fechaini'] . " y " . $_POST['fechafin'];
    $redimen = "Redimen entre: " . $_POST['fechaini'] . " y " . $_POST['fechafin'];
} else {
    $sql = "select DISTINCT case WHEN u.ciudad = '' then 'NO REGISTRA' else u.ciudad end ciudad,"
            . " (select count(ciudad) from tbl_usuario where ciudad = u.ciudad) cantidad from tbl_usuario u";
    $inscritos = "Cantidad";
    $redimen = "Redimen";
}
$conexion = Conexion::conectar("expresop_vultra");
$stmt = $conexion->prepare($sql);
$stmt->execute();
?>
<table id = "example" class = "table table-striped table-bordered" cellspacing = "0" width = "100%">
    <thead>
        <tr>
            <th><b>Pertenecen a la Ciudad</b></th>
            <th><b><?php echo $inscritos; ?></b></th>
            <th><b><?php echo $redimen; ?></b></th>
            <th><b>Acciones</b></th>
        </tr>
    </thead>
    <tbody >
        <?php
        $count = 0;
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
                <td><?php echo $row->ciudad; ?></td>
                <td><?php echo $row->cantidad; ?></td>
                <td>
                    <?php
                    if ((isset($_POST['fechaini']) && !empty($_POST['fechaini'])) && (isset($_POST['fechafin']) && !empty($_POST['fechafin']))) {
                        $sql2 = "select cuantosRedimenXciudadfechas('" . $row->ciudad . "', '" . $_POST['fechaini'] . " 00:00:00', '" . $_POST['fechafin'] . " 23:59:59') cantidad";
                    } else {
                        $sql2 = "select cuantosRedimenXciudad('" . $row->ciudad . "') cantidad";
                    }
                    $stmt2 = $conexion->prepare($sql2);
                    $stmt2->execute();
                    $cant = $stmt2->fetch(PDO::FETCH_OBJ);
                    echo $cant->cantidad;
                    ?>
                </td>
                <td>
                    <?php if ($cant->cantidad > 0) { ?>
                        <a target="_blank" href="rsXCiudad.php?ciudad=<?php echo $row->ciudad; ?>&fechaini=<?php echo $_POST['fechaini'] ?>&fechafin=<?php echo $_POST['fechafin'] ?>">Ver</a>
                    <?php } ?>

                </td>

            </tr>
            <?php
            $count += 1;
        }
        $stmt = null;
        $stmt2 = null;
        $conexion = null;
        ?>
    </tbody>
</table>



