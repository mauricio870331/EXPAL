<?php
include ("funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$Valores = $_GET['Accion'];
$porciones = explode("-", $Valores);
$time = time();
$fecha = date("Y-m-d", $time);
$servicio = array();
$prueba = array();
$sumkm = 0;
$val_aux = 0;
$array_tiquetes = array();

//print_r($Valores);
//die;

$sql = "SELECT ruta, destino FROM parametrosGanador WHERE codigo = " . $porciones[4] . "";

$stmt = $conexion->prepare($sql);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
$row2 = $stmt->fetch(PDO::FETCH_OBJ);



/* while () {
  echo $row2->ruta." ".$row2->destino;
  } */

if ($porciones[2] == 1) {
    $sql = "SELECT cod_usuario, nro_tiquete, origen, destino, kilometros,ser_code 
       FROM tbl_tiquetes WHERE ((origen = '" . $row2->ruta . "' and destino = '" . $row2->destino . "') or (origen = '" . $row2->destino . "' and destino = '" . $row2->ruta . "'))
            AND cod_usuario = '" . $porciones[1] . "' and solicitado = 1";
    $stmt_tiquete = $conexion->prepare($sql);
    $rs = $stmt_tiquete->execute();

    /* Realiza la comparación de la cantidad de kilometros y la cantidad de kilometros que tiene el cliente
      para reclamar tiquete
     */
    while ($fila = $stmt_tiquete->fetch(PDO::FETCH_OBJ)) {
        $servicio[] = $fila->ser_code;
        $sumkm += $fila->kilometros;
        $array_tiquetes[] = $fila->nro_tiquete;
        if ($sumkm == $porciones[0]) {
            break;
        } else {
            $sumkm += 0;
        }
    }

    /*
      Realiza la compración de los kilometros necesarios para reclamar el tiquete
      si es menor a la cantidad requerida alerta al usuario

     */
    if ($sumkm < $porciones[0]) {
        ?>
        <script type="text/javascript">
            alert("Hacen falta tiquetes, la suma de Km debe ser igual a " +<?php echo $porciones[0]; ?>);
            location.href = '../MenuUltraAdmon.php';
        </script>

        <?php
    } else {
        foreach ($servicio as $key => $value) {
            if (!array_key_exists($value, $prueba)) {
                $prueba[$value] = 1;
            } else {
                $prueba[$value] = $prueba[$value] + 1;
            }
        }

        // $maxValue = max($prueba);
        $maxIndex = array_search(max($prueba), $prueba);

        /* echo("Max calif  ".$maxIndex." Puntos: ".$maxValue );          
          echo '<br>';
          print_r($prueba);die; */


        /*
          Cantidad de kilometros coinciden acutaliza en la tabla tbl_usuarioTiquete estado ACEPTADO
         */
        $sql6 = "update tbl_usuarioTiquete set estado='Aceptado', servicio= ?"
                . ",fechaEntregado = ? where codigooUsu = ? "
                . " AND cod_persona= ?";

        $stmt = $conexion->prepare($sql6);
        $stmt->execute(array($maxIndex, $fecha, $porciones[3], str_replace('*', '-', $porciones[1])));
        $cant = $stmt->rowCount();

        for ($i = 0; $i < count($array_tiquetes); $i++) {
            $sql1 = "update tbl_tiquetes set solicitado = 2  where nro_tiquete= ?";
            $stmt = $conexion->prepare($sql1);
            $stmt->execute(array($array_tiquetes[$i]));
            $cant = $stmt->rowCount();
        }
        ?>

        <script type="text/javascript">
            alert("El tiquete fue aceptado con éxito");
            window.location.href = "../MenuUltraAdmon.php";
        </script>

        <?php
    }

    /*
     * acutaliza en la tabla tbl_usuarioTiquete estado RECHAZADO
     */
} elseif ($porciones[2] == 3) {
    $sql1 = "update tbl_usuarioTiquete set estado='Rechazado' where codigooUsu=" . $porciones[3];
    //$sql2 = "update tbl_usuario set puntos=puntos+".$porciones2[0]." where cod_usuario=".$porciones2[1];

    $stmt = $conexion->prepare($sql1);
    $stmt->execute();
    $destino = "clienteultra@expresopalmira.com.co";
    $asunto = "tiquetes Expreso palmira";
    $cabeceras = "Content-type: text/html";
    $cuerpo = "La persona de cedula " . $porciones[1] . " ha sido rechazada para el premio del tiquete";
    mail($destino, $asunto, $cuerpo, $cabeceras);
    //echo "<script>window.location.href = '../MenuUltraAdmon.php';</script>";   
}


// echo $sumkm;
//echo "<br>".$sumkm+$val_aux;die;
?>

<script type="text/javascript">
    alert("El tiquete fue rechazado");
    window.location.href = "../MenuUltraAdmon.php";
</script>