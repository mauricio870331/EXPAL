<?php
session_cache_limiter('nocache,private');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.html');
}
$hoy = date("Y-m-d h:m:s");
$entrega = strtotime('+15 day', strtotime($hoy));
$entrega = date('Y-m-j', $entrega);
$Valores = $_GET['Accion'];
//echo $Valores;die;
$porciones2 = explode("-", $Valores);
include ("funciones_mysql.php");
$sercode = null;
$conexion = Conexion::conectar("expresop_vultra");
$idTotalPuntos = $porciones2[0];
$sqlc = "SELECT codigo, kilometros from parametrosGanador where ruta ='" . $porciones2[2] . "' and destino = '" . $porciones2[3] . "'";
$stmt = $conexion->prepare($sqlc);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $codigo = $row->codigo;
    $kmtotales = $row->kilometros;
}
$sqlRutA = "SELECT cod_ruta, kilometros from tbl_kilometros where origen ='" . $porciones2[2] . "' and destino = '" . $porciones2[3] . "'";
$stmt = $conexion->prepare($sqlRutA);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $codRuta = $row->cod_ruta;
    $restKm = $row->kilometros;
}
$users = "SELECT nombre, apellido, telefono, correo, ciudad  from tbl_usuario where cod_usuario ='" . $porciones2[1] . "'";
$stmt = $conexion->prepare($users);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
$row = $stmt->fetch(PDO::FETCH_OBJ);
if ($numfilas > 0) {
    $nombre = $row->nombre;
    $apellido = $row->apellido;
    $telefono = $row->telefono;
    $correo = $row->correo;
    $ciudad = $row->ciudad;
}
/* SELECT CASE WHEN ( (select total_puntos FROM tbl_total_puntos WHERE id_total_puntos=" . $idTotalPuntos . "
  and total_puntos >=(SELECT kilometros FROM parametrosGanador WHERE codigo=" . $codigo . ")) IS NULL )
  THEN cast(1 as binary) ELSE (select total_puntos FROM tbl_total_puntos WHERE cod_usuario='" . $porciones2[1] . "' and
  total_puntos >= (SELECT kilometros FROM parametrosGanador WHERE codigo=" . $codigo . ")) END */
$sql3 = "SELECT CASE WHEN  (select total_puntos FROM tbl_total_puntos WHERE id_total_puntos=" . $idTotalPuntos . "
         and total_puntos >=(SELECT kilometros FROM parametrosGanador WHERE codigo=" . $codigo . ")) IS NULL 
        THEN cast(1 as binary) ELSE (select total_puntos FROM tbl_total_puntos WHERE id_total_puntos=" . $idTotalPuntos . "
        and total_puntos >=(SELECT kilometros FROM parametrosGanador WHERE codigo=" . $codigo . ")) END as kilometros";
$stmt = $conexion->prepare($sql3);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $kilometros = $row->kilometros;
}
//echo $kilometros;
if ($kilometros == 1) {
    if ($_SESSION['usuario'] == 'admin') {
        echo '<script> alert("No tiene suficientes kilometros");  location.href="../MenuUltraAdmon1.php";
 
</script>';
    } else {
        echo '<script> alert("No tiene suficientes kilometros");  location.href="../MenuUltraconsulta.php";
 
</script>';
    }
} else {
    $time = time();
    $fecha = date("Y-m-d", $time);
    $sql = "INSERT INTO tbl_usuarioTiquete  values (0, '" . $porciones2[1] . "'," . $codigo . ",'Pendiente','" . $fecha . "','0000-00-00'," . $codRuta . ", '" . $sercode . "')";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $sql4 = "update tbl_total_puntos set total_puntos=total_puntos-" . $kmtotales . " where id_total_puntos=" . $idTotalPuntos;
    $stmt = $conexion->prepare($sql4);
    $stmt->execute();


    $count = 0;
    while ($count < $kmtotales) {
        $count = $count + $restKm;
        $sqlSelct = "Select id from tbl_tiquetes WHERE solicitado = 0 AND 
        cod_usuario = '" . $porciones2[1] . "' 
        AND ((origen ='" . $porciones2[2] . "' and destino = '" . $porciones2[3] . "') 
            OR (destino ='" . $porciones2[2] . "' and origen = '" . $porciones2[3] . "')) Limit 1";
        $stmt = $conexion->prepare($sqlSelct);
        $stmt->execute();
        $numfilas = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($numfilas > 0) {
            $id = $row->id;
        }
        $sqlupdateTiq = "UPDATE tbl_tiquetes SET solicitado = 1 WHERE id = " . $id . " ";
        $stmt = $conexion->prepare($sqlupdateTiq);
        $stmt->execute();
    }
    $destino = "clientesultra@expresopalmira.com.co, desarrollo1@expresopalmira.com.co, " . $correo;
    $asunto = "Solicitud Tiquetes Expreso palmira";
    $cabecera = 'MIME-Version: 1.0' . "\r\n";
    $cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $cabecera .= 'From: ' . $nombre . ' <' . $correo . '>' . "\r\n";
    $cuerpo = "El Cliente " . $nombre . " " . $apellido . " ha solicitado un tiquete. <br>" .
            "Número de cédula: " . $porciones2[1] . "<br>" .
            "Correo: " . $correo . "<br>" .
            "Fecha Solicitud: " . $hoy . "<br>" .
            "Fecha estimada de Entrega: " . $entrega."<br>".
            "Teléfono: ".$telefono."<br>".
            "Ciudad: ".$ciudad."<br>".
            "Ruta del Tiquete Solicitado: ".$porciones2[2]."-".$porciones2[3];
    mail($destino, $asunto, $cuerpo, $cabecera);
    $stmt = null;
    $conexion = null;
    if ($_SESSION['usuario'] == 'admin') {
        echo '<script>  alert("Cuando su tiquete se encuentre disponible en la agencia de su ciudad se le enviara un correo informandole.\nle recordamos que son 15 dias habiles  previas validaciones y verificaciones  para el envio.");  location.href="../MenuUltraAdmon1.php"; 
           </script>';
    } else {
        echo '<script>  alert("Cuando su tiquete se encuentre disponible en la agencia de su ciudad se le enviara un correo informandole.\nle recordamos que son 15 dias habiles  previas validaciones y verificaciones  para el envio."); location.href="../MenuUltraconsulta.php"; </script>';
    }
}
?>