<?php

session_cache_limiter('nocache,private');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../cliente-ultra.php');
}
error_reporting(E_ERROR | E_WARNING | E_PARSE);

date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d h:m:s");
include ("funciones_mysql.php");
if (isset($_POST['tiquete']) && isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['datepicker']) && isset($_POST['verificar'])) {//if 1
    $temp = $_SESSION['cod_usuario'];
    $tiquete = $_POST['tiquete'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['datepicker'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $verificar = $_POST['verificar'];
    if ($_SESSION['cod_usuario'] == 'admin') {
        $_SESSION['cod_usuario'] = $cedula;
    }
    $estado = "V";
    $message = "";
    $new_tiquete = "";
    $newSucuremp = "No registra";
    $conexion = Conexion::conectar("expresop_vultra");
    $sql = "SELECT nro_tiquete FROM tbl_tiquetes_anulados WHERE nro_tiquete = '" . $tiquete . "'";
    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    if ($numfilas == 0) {//if 2
        if ($verificar == "S") {//if 3
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://201.234.242.21:6532/expal/consultatiquete.php?param1=' . $tiquete . '&param2=' . $origen . '&param3=' . $destino . '&param4=' . $fecha . '&param5=' . $_SESSION['cod_usuario']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch) or die(curl_error($ch));
            curl_close($ch);
            $array = json_decode($output, true);
            /* if (array_key_exists('form', $array[0]) && trim($array[0]['form']) == 'TstkMovStkTiket') {
              echo '<script>
              location.href="MenuUltra.php";
              alert("Los tiquetes generados manualmente no participan");
              </script>';
              } */
            if (count($array) > 0) {
                switch ($array[0]['cod']) {
                    case 'ND':
                        //for ($i = 0; $i < count($array); $i++) {
                        $new_tiquete = $array[0]["ResCod"];
                        $new_origen = $origen;
                        $new_destino = $destino;
                        $new_fecha = $array[0]["ResFecHor"];
                        $new_sercod = $array[0]["SerCod"];
                        $newSucuremp = $array[0]["Sucursal"];
                        // }
                        break;
                    case 'NOROUTE':
                        if ($temp == 'admin') {
                            echo '<script>
                                     location.href="../MenuUltraAdmon.php";
                                     alert("Esta ruta no participa");
                                   </script>';
                        } else {
                            echo '<script>               
                                    location.href="../MenuUltra.php";
                                    alert("Esta ruta no participa"); 
                                   </script>';
                        }
                        break;
                }
            } else {
                if ($temp == 'admin') {
                    echo '<script>
                             location.href="../MenuUltraAdmon.php";
                             alert("El tiquete no se pudo registrar. Revise las Siguientes Causas:\n1 - El ' . utf8_decode('número de cédula ') . 'impreso en el tiquete no coincide con el del usuario registrado.\n2 - El Origen y Destino son incorrectos.\n3 - La fecha de viaje es incorrecta.\n4 - El tiquete esta anulado.\n5 - El tiquete no existe.\nSi tiene alguna duda por favor comuniquese con sevicio al cliente.");
                            </script>';
                } else {
                    echo '<script>
                             location.href="../MenuUltra.php";
                              alert("El tiquete no se pudo registrar. Revise las Siguientes Causas:\n1 - El ' . utf8_decode('número de cédula ') . 'impreso en el tiquete no coincide con el del usuario registrado.\n2 - El Origen y Destino son incorrectos.\n3 - La fecha de viaje es incorrecta.\n4 - El tiquete esta anulado.\n5 - El tiquete no existe.\nSi tiene alguna duda por favor comuniquese con sevicio al cliente.");
                            </script>';
                }
            }
        } else {
            $new_tiquete = $tiquete;
            $new_origen = $origen;
            $new_destino = $destino;
            $new_fecha = $fecha;
            $new_sercod = "";
        }////fin if 3
        //Seleccionar cantidad de kilometros que gana en esta ruta        
        $sql3 = "SELECT kilometros FROM tbl_kilometros WHERE ( (origen = '" . $origen . "' AND destino = '" . $destino . "') or (origen = '" . $destino . "' AND destino = '" . $origen . "'))";
        $stmt = $conexion->prepare($sql3);
        $stmt->execute();
        $numfilas = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($numfilas > 0) {
            $kilometros = $row->kilometros;
        }

        //validar si el tiquete ya esta guardado

        $sql = "SELECT * FROM tbl_tiquetes WHERE nro_tiquete = '" . $tiquete . "'";
        $stmt = $conexion->prepare($sql);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();

        if ($new_tiquete != '') {//if 4
            if ($numfilas == 0) {//if 5
                //Validar si se encontraron valores         
                if ($_SESSION['cod_usuario'] == 'admin') {
                    $_SESSION['cod_usuario'] = $cedula;
                }
                if ($new_fecha == '0000-00-00' || $new_fecha == '1901-01-01') {
                    $date = new DateTime($hoy);
                } else {
                    $date = new DateTime($new_fecha);
                }

                $sql = "INSERT INTO tbl_tiquetes (nro_tiquete,
                                                   origen, 
                                                   destino, 
                                                   kilometros,
                                                   puntos,
                                                   fecha_viaje, 
                                                   cod_usuario,                                                     
                                                   Vijencia, 
                                                   cedula, 
                                                   Nombre, 
                                                   ser_code, 
                                                   estado, 
                                                   fecha_mod,
                                                   sucursal) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conexion->prepare($sql);

                $stmt->execute(array(trim($new_tiquete), $new_origen, $new_destino, $kilometros, $kilometros, $date->format('Y-m-d'), $_SESSION['cod_usuario'],
                    'S', ($cedula == null) ? '' : $cedula, ($nombre == null) ? '' : $nombre, $new_sercod, $estado, $hoy, $newSucuremp));
                $cant = $stmt->rowCount();
//              //************************
                $sql = "SELECT cod_usuario FROM tbl_total_puntos WHERE cod_usuario = '" . $_SESSION['cod_usuario'] . "' AND ((origen ='" . $new_origen . "' AND destino ='" . $new_destino . "') OR (origen ='" . $new_destino . "' AND destino ='" . $new_origen . "'))";
                $stmt = $conexion->prepare($sql);
                $rs = $stmt->execute();
                $existUserOrigenDestiny = $stmt->rowCount();

                if ($existUserOrigenDestiny > 0) {
                    $sql3 = "UPDATE tbl_total_puntos set total_puntos=total_puntos+" . $kilometros . " 
                     where cod_usuario ='" . $_SESSION['cod_usuario'] . "' AND ( (origen ='" . $new_origen . "' AND destino ='" . $new_destino . "') 
                                                                             OR (origen ='" . $new_destino . "' AND destino ='" . $new_origen . "') )";
                } else {
                    $sql3 = "INSERT INTO tbl_total_puntos (cod_usuario, origen, destino, total_puntos) VALUES ('" . $_SESSION['cod_usuario'] . "', '" . $new_origen . "', '" . $new_destino . "', " . $kilometros . ")";
                }
                $stmt = $conexion->prepare($sql3);
                $stmt->execute();
                $cant = $stmt->rowCount();
                $conexion = null;
                $stmt = null;
                $_SESSION['cod_usuario'] = $temp;
                if ($_SESSION['cod_usuario'] == 'admin') {
                    echo '<script>  location.href="../MenuUltraRegistroAdmon.php";  alert("Se registro correctamente el tiquete. ' . utf8_decode($message) . '");  </script>';
                } else {
                    echo '<script>  location.href="../MenuUltra.php";  alert("Se registro correctamente el tiquete. ' . utf8_decode($message) . '");  </script>';
                }
            } else {
                $_SESSION['cod_usuario'] = $temp;
                if ($_SESSION['cod_usuario'] == 'admin') {
                    echo '<script>
                               location.href="../MenuUltraRegistroAdmon.php";
                               alert("Ya tiene registrado ese tiquete");
                            </script>';
                } else {
                    echo' <script>
                            location.href="../MenuUltra.php";
                            alert("Ya tiene registrado ese tiquete");
                          </script>';
                }
                $_SESSION['cod_usuario'] = $temp;
            }////fin if 5
        } else {
            $_SESSION['cod_usuario'] = $temp;
            if ($_SESSION['cod_usuario'] == 'admin') {
                echo '<script>
                       location.href="../MenuUltraRegistroAdmon.php";
                       alert("Tiquete no valido");
                      </script>';
            } else {
                echo '<script>
                       location.href="MenuUltra.php";
                       alert("Tiquete no valido");
                     </script>';
            }
        }////fin if 4
    } else {
        $_SESSION['cod_usuario'] = $temp;
        if ($_SESSION['cod_usuario'] == 'admin') {
            echo '<script>
                   location.href="../MenuUltraRegistroAdmon.php";
                   alert("El tiquete no puede participar");
                  </script>';
        } else {
            echo '<script>
                   location.href="../MenuUltra.php";
                   alert("El tiquete no puede participar");
                  </script>';
        }
    }////fin if 2
}////fin if 1
?>