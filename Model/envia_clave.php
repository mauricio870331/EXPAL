<?php
include("funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$cedula = $_POST["cedula_correo"];
$sql = ("SELECT * FROM tbl_usuario where cod_usuario = '" . $cedula . "'");
$stmt = $conexion->prepare($sql);
$rs = $stmt->execute();
$numfilas = $stmt->rowCount();

if ($numfilas > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $nombre = $row->nombre;
        $apellido = $row->apellido;
        $correo = $row->correo;
        $clave = $row->clave;
    }
    include ("encriptar.php");
    $texto_original = Encrypter::decrypt($clave);
    $correo = $correo . ",desarrollo1@expresopalmira.com.co";
    $asunto = "Recordatorio clave Expreso Palmira";
    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'From: Cliente Ultra <desarrollo1@expresopalmira.com.co>' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cuerpo = "Recordatorio de clave: <br>
          Usuario: $cedula<br>
          Clave: $texto_original <br>
          Siga el enlace para ingresar: <a href='http://www.expresopalmira.com.co/cliente-ultra.php'>http://www.expresopalmira.com.co/cliente-ultra.html</a>";
    mail($correo, $asunto, $cuerpo, $cabeceras);
    ?>
    <script>
        alert("Se envio el correo a la <?php echo utf8_decode('dirección') . ': ' ?><?php echo $correo ?> por favor revise su cuenta es posible que se encuentre como correo no deseado");
        location.href = '../cliente-ultra.php';
    </script>
<?php } else {
    ?>
    <script>
        alert("El Documento no existe");
        location.href = '../cliente-ultra.php';
    </script>
    <?php
}
?>
