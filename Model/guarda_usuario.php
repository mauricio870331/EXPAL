<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_POST["cedula"]) && !empty($_POST["cedula"])) {
    $nombrepart = "";
    $nombre = $_POST['Nombre'];
    if (isset($_POST['Apellidos'])) {
        $apellido = $_POST['Apellidos'];
    } else {
        $nombrepart = explode(" ", $nombre);
        if (count($nombrepart) > 1) {
            $nombre = $nombrepart[0];
            $apellido = $nombrepart[1];
        }else{          
            $apellido = "--"; 
        }
    }
    $cedula = $_POST['cedula'];
    $telefono = $_POST['Telefono'];
    $correo = $_POST['Correo_Electronico'];
    $sexo = $_POST['sexo'];
    $ciudad = $_POST['ciudad'];
    $opc = $_POST['opc'];
    $nacimiento = $_POST['nacimiento'];
    $hoy = date("Y-m-d h:m:s");

    function generaPass() {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);
        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 6;
        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);
            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    $clave = "";
    if (isset($_POST["clave_registro"]) && !empty($_POST["clave_registro"])) {
        $clave = $_POST['clave_registro'];
    }
    include ("funciones_mysql.php");
    include ("encriptar.php");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://190.85.141.28:6530/expal/consultausuarios.php?param1=' . $cedula . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch) or die(curl_error($ch));
    curl_close($ch);
    $array = json_decode($output, true);
    $cod_persona = "";
    $cambio_clave = "";

    $conexion = Conexion::conectar("expresop_vultra");
    $sql = "SELECT cod_usuario FROM tbl_users_anulados WHERE cod_usuario = '" . $cedula . "'";
    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();

    if ($numfilas == 0) {
        $cod_persona = $array[0]["cod_persona"];


        if ($cod_persona == '') {//||      
            if ($clave != "") {
                $clave_encriptada = Encrypter::encrypt($clave);
                $cambio_clave = "N";
            } else {
                $clave = generaPass();
                $clave_encriptada = Encrypter::encrypt($clave);
                $cambio_clave = "S";
            }
            $sql = "SELECT id FROM tbl_usuario WHERE cod_usuario = '" . $cedula . "'";
            $stmt = $conexion->prepare($sql);
            $rs = $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $numfilas = $stmt->rowCount();
            if ($numfilas == 0) {
                $status = 'INACTIVO';
                $landing = NULL;
                if (isset($_POST['lanPromo'])) {
                    $landing = ($_POST['lanPromo'] == 1) ? "Cupones" : "Promociones";
                    $status = 'ACTIVO';
                }
                $sql2 = "INSERT INTO tbl_usuario (cod_usuario, nombre, apellido, telefono, correo, clave, ciudad, fecha_creacion, Puntos, Rol, fecha_nac, Estado, cambio_clave, inscrito_desde)
                         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $stmt = $conexion->prepare($sql2);
                $rs = $stmt->execute(array($cedula, $nombre, $apellido, $telefono, $correo, $clave_encriptada, $ciudad, $hoy, 0, 'cliente', $nacimiento, $status, $cambio_clave, $landing));

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'http://190.85.141.28:6530/expal/insertUseUltraTofics.php?documento=' . $cedula . '&nombre=' . $nombre . '&apellido=' . $apellido . '&correo=' . $correo . '&telefono=' . $telefono . '');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch) or die(curl_error($ch));
                curl_close($ch);
                $r = json_decode($output, true);
                /*
                  $params = "documento=".$cedula."&nombre=".$nombre."&apellido=".$apellido."&correo=".$correo."&telefono=".$telefono."";
                  $ch2 = curl_init();                    // Initiate cURL
                  $url2 = 'http://190.85.141.28:6530/expal/insertUseUltraTofics.php'; // Where you want to post data
                  curl_setopt($ch2, CURLOPT_URL,$url2);
                  curl_setopt($ch2, CURLOPT_POSTFIELDS, $params);
                  curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
                  $output2 = curl_exec($ch2) or die(curl_error($ch2)); // Execute
                  curl_close ($ch2); // Close cURL handle
                  $r = json_decode($output2, true); */
                /* if ($r == 1) {
                  $destino = "desarrollo1@expresopalmira.com.co";
                  $asunto = "Info insert fics";
                  $cabeceras = "Content-type: text/html";
                  $cuerpo = "se registro el usario en fics Documento: " . $cedula . " " . $nombre . " " . $apellido . " " . $correo . " " . $telefono . " " . $r;
                  mail($destino, $asunto, $cuerpo, $cabeceras);
                  } elseif ($r == 2) {
                  $destino = "desarrollo1@expresopalmira.com.co";
                  $asunto = "Info insert fics";
                  $cabeceras = "Content-type: text/html";
                  $cuerpo = "No se inserto por que ya existia doc: " . $cedula . " " . $nombre . " " . $apellido . " " . $correo . " " . $telefono . " " . $r;
                  mail($destino, $asunto, $cuerpo, $cabeceras);
                  }
                  if ($r != 1 || $r != 2) {
                  $destino = "desarrollo1@expresopalmira.com.co";
                  $asunto = "Info insert fics";
                  $cabeceras = "Content-type: text/html";
                  $cuerpo = "Error al insertatr el usuario:" . $cedula . " " . $r;
                  mail($destino, $asunto, $cuerpo, $cabeceras);
                  } */

                $destino = $correo;
                $asunto = "Enviado desde la pagina Expreso palmira";
                $cabeceras = "Content-type: text/html";
                $cuerpo = "Gracias por registrarse $nombre $apellido<br>
                El usuario de ingreso es: $cedula<br>
                la contraseña es: $clave<br>
                Siga el enlace para activar su cuenta: <a href='http://www.expresopalmira.com.co/Model/activar_cuenta.php?user=$cedula'>http://www.expresopalmira.com.co/ViajesUltra/usuario.html</a><br>
                Gracias por registrarse...
                ";
                mail($destino, $asunto, $cuerpo, $cabeceras);
                if (isset($opc) && $opc == 1) {
                    ?>
                    <script>
                    <?php if (!isset($_POST['lanPromo'])) { ?>
                            location.href = '../index.php';
                        <?php
                    } else {
                        $_SESSION['usuario'] = $nombre . " " . $apellido;
                        $_SESSION['cod_usuario'] = $cedula;
                        if ($landing == 'Promociones') {
                            ?>
                                location.href = '../promo.php';
                        <?php } else { ?>
                                location.href = '../Cupones.php';
                            <?php
                        }
                    }
                    ?>
                        alert("usuario creado con exito, Se ha enviado un mensaje a la direccion: <?php echo $destino; ?>  para la activacón de la cuenta, si no ve el mensje por favor revise la carpeta de 'Spam' ");
                    </script>
                    <?php
                } else if (isset($opc) && $opc == 2) {
                    ?>
                    <script>
                        location.href = '../MenuUltraAdmon.php';
                        alert("usuario creado con exito, Se ha enviado un mensaje a la direccion: <?php echo $destino; ?>  para la activacón de la cuenta, si no ve el mensje por favor revise la carpeta de 'Spam' ");
                    </script>
                    <?php
                } else {
                    ?>  
                    <script>
                        location.href = '../cliente-ultra.php';
                        alert("usuario creado con exito, Se ha enviado un mensaje a la direccion: <?php echo $destino; ?> para la activacón de la cuenta, si no ve el mensje por favor revise la carpeta de 'Spam'  ");
                    </script>
                    <?php
                }
            } else {
                if (isset($opc) && $opc == 1) {
                    ?>
                    <script>
                        location.href = '../inscribete_2.php';
                        alert("Ya existe el usuario");
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        location.href = '../cliente-ultra.html';
                        alert("Ya existe el usuario");
                    </script>
                    <?php
                }
            }
        } else {
            if (isset($opc) && $opc == 1) {
                ?>
                <script>
                    location.href = '../inscribete.php';
                    alert("Los empleados no pueden participar");
                </script>
                <?php
            } else {
                ?>
                <script>
                    location.href = '../cliente-ultra.html';
                    alert("Los empleados no pueden participar");
                </script>
                <?php
            }
        }
    } else {
        if (isset($opc) && $opc == 1) {
            ?>
            <script>
                location.href = '../inscribete.php';
                alert("Tu no puedes participar");
            </script>
            <?php
        } else {
            ?>
            <script>
                location.href = '../cliente-ultra.html';
                alert("Tu no puedes participar");
            </script>
            <?php
        }
    }
} else {
    ?>
    <script>
        location.href = '../cliente-ultra.html';
        alert("Digite su" +<?php echo utf8_decode("cédula"); ?>);
    </script>
    <?php
}
?>