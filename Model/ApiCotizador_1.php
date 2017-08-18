<?php

header('Access-Control-Allow-Origin: *');


//$contenido = $_POST['contenido'];
//$idProducto = $_POST['idProducto'];
//$idPoblacionOrigen = $_POST['idPoblacionOrigen'];
//$idPoblacionDestino = $_POST['idPoblacionDestino'];
//$pesoMedido = $_POST['pesoMedido'];
//$ValorDeclarado = $_POST['ValorDeclarado'];
//$TotalPiezas = $_POST['TotalPiezas'];
//$fpago = $_POST['fpago'];
//$fpagot = $_POST['fpagot'];
//$tipo_servicio_text = $_POST['tipo_servicio_text'];
//$origent = $_POST['origent'];
//$destinot = $_POST['destinot'];
//$contenidot = $_POST['contenidot'];


$contenido = 2;
$idProducto = 2;
$idPoblacionOrigen = '76001';
$idPoblacionDestino = '11001';
$pesoMedido = 55;
$ValorDeclarado = 200000;
$TotalPiezas = 1;
$fpago = 'contado';
$fpagot = 'Contado';
$tipo_servicio_text = 'Mensajería nacional';
$origent = 'Bogota';
$destinot = 'Cali';
$contenidot = 'Documento';
$ancho = 15;
$alto = 10;
$largo = 10;

$fpagot = explode("(", $fpagot);


//if (isset($_POST['ancho']) && isset($_POST['alto']) && isset($_POST['largo'])) {
//    $ancho = $_POST['ancho'];
//    $alto = $_POST['alto'];
//    $largo = $_POST['largo'];
//    if (getPesoReal($largo, $ancho, $alto) > $pesoMedido) {
//        $pesoMedido = getPesoReal($largo, $ancho, $alto);
//    }
//}

/* if (($idProducto == 2 || $idProducto == 3) && $contenido == 2 && $pesoMedido > 5) {
  echo 1;
  return;
  }else */

/* else if (($idProducto == 4) && $contenido == 2 && $pesoMedido <= 5) {
  echo 4;
  return;
  }

  else if (($idProducto == 4) && $contenido == 2 && $pesoMedido > 50) {
  echo 4;
  return;
  }

  else if (($idProducto == 1 || $idProducto == 2 || $idProducto == 3 || $idProducto == 5) && $ValorDeclarado < 10000) {
  echo 5;
  return;
  }

  else if (($idProducto == 4) && ($ValorDeclarado < 200000 || $ValorDeclarado > 1500000)) {
  echo 6;
  return;
  }

 */

//if (($idProducto == 1 || $idProducto == 2 || $idProducto == 3 || $idProducto == 5) && $contenido == 1 && $pesoMedido > 5) {
//    echo 0;
//    return;
//} else if (($idProducto == 4) && $contenido == 1 && $pesoMedido <= 5) {
//    echo 2;
//    return;
//} else if (($idProducto == 2 || $idProducto == 3) && $contenido == 2 && $pesoMedido > 50) {
//    echo 3;
//    return;
//} else if (($idProducto == 1 || $idProducto == 5) && $contenido == 2 && $pesoMedido > 5) {
//    echo 0;
//    return;
//} else {
    $pesoVol = "false";
    $moreParams = "";

    if ($contenido == 2) {
        $pesoVol = "true";
        $moreParams = "&alto=" . $alto . "&ancho=" . $ancho . "&largo=" . $largo;
    }
    $params = "idProducto=" . $idProducto . "&idCliente=0&idPoblacionOrigen=" . $idPoblacionOrigen . "";
    $params .= "&idPoblacionDestino=" . $idPoblacionDestino . "&pesoMedido=" . $pesoMedido . "&esPesoVolumen=" . $pesoVol . "&ValorDeclarado=" . $ValorDeclarado . "&TotalPiezas=" . $TotalPiezas . "";
    $params .= $moreParams;
//login 
    $clave = rc4("cl2014", "desarrollador2");
    $ch = curl_init();                    // Initiate cURL
    $url = 'http://ibis.dynalias.net:5000/Servidor.Web/core/COSeguridad/ValidarUsuario'; // Where you want to post data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);  // Tell cURL you want to post something
    curl_setopt($ch, CURLOPT_POSTFIELDS, "login=sistemas&clave=$clave"); // Define what you want to post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); headers
    $output = curl_exec($ch); // Execute
    curl_close($ch); // Close cURL handle
    $array = json_decode($output, true);
    //echo "<pre>"; print_r($array); echo"</pre>";
    $token = $array['tokenServicios'];
    //echo $token;

    $headers = array(
        'Authorization-User: sistemas',
        'Authorization-Token: ' . $token . ''
    );
    //print_r($headers);
    //echo $params."<br>";
    $ch2 = curl_init();                    // Initiate cURL
    $url2 = 'http://ibis.dynalias.net:5000/Servidor.Web/dominio/envios/EnEnvios/LiquidarEnvio'; // Where you want to post data
    curl_setopt($ch2, CURLOPT_URL, $url2);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers); //headers

    $output2 = curl_exec($ch2); // Execute
    curl_close($ch2); // Close cURL handle
    $array2 = json_decode($output2, true);

    var_dump($array2);	
    $datos = array();
    $datos['valorTotal'] = ($fpago == "contra") ? $array2['valorTotal'] + 3300 : $array2['valorTotal'];
    $datos['valorDeclarado'] = $array2['valorDeclarado'];
    $datos['valorSeguro'] = $array2['valorSeguro'];
    $datos['valorCostoFlete'] = $array2['valorCostoFlete'];
    $datos['valorKiloInicial'] = $array2['valorKiloInicial'];
    $datos['valorKiloAdicional'] = $array2['valorKiloAdicional'];
    $datos['impuestos'] = $array2['impuestos'];

    //echo json_encode($datos);
    if ($fpago == "contra") {
        $result = "Nota: El Calculo Contra Entrega Solo Aplica Para Empresas..!<br><br>";
        $result .= "<div style='background-color: #F2F2F2;padding: 3px 5px;font-size:15px;'><div style='display:inline-block;width:53%;'>Tipo de Servicio:</b>&nbsp;" . $tipo_servicio_text . "</div><div style='display:inline;width:47%;'>Forma de Pago: " . trim($fpagot[0]) . "</div></div>";
    } else {
        $result = "<div style='background-color: #F2F2F2;padding: 3px 5px;font-size:15px;'><div style='display:inline-block;width:53%;'>Tipo de Servicio:&nbsp;" . $tipo_servicio_text . "</div><div style='display:inline;width:47%;'>Forma de Pago: " . trim($fpagot[0]) . "</div></div>";
    }
    $result .= "<div style='padding: 3px 5px;font-size:15px;'><div style='display:inline-block;width:53%;'>Origen:&nbsp;" . $origent . " </div><div style='display:inline;width:47%;'>Destino:&nbsp;" . $destinot . " </div></div>";
    $result .= "<div style='background-color: #F2F2F2;padding: 3px 5px;font-size:15px;'><div style='display:inline-block;width:53%;'>Peso Real:&nbsp;" . $pesoMedido . " Kgs </div><div style='display:inline;width:47%;'>Contenido:&nbsp;" . $contenidot . " </div></div>";
    $result .= "<br>";
    $result .= "<div style='background-color:#FAFAFA;padding: 3px 5px;font-size:15px;'><b>Total:&nbsp;$" . number_format($datos['valorTotal']) . "</b> </div>";

    echo $result;
//}

//---------------------Funciones-------------------------------------------
function getPesoReal($l, $a, $h) {
    $pesoVol = ($l * $a * $h) / 2500;
    return ceil($pesoVol);
}

function mb_chr($char) {
    return mb_convert_encoding('&#' . intval($char) . ';', 'UTF-8', 'HTML-ENTITIES');
}

function mb_ord($char) {
    $result = unpack('N', mb_convert_encoding($char, 'UCS-4BE', 'UTF-8'));

    if (is_array($result) === true) {
        return $result[1];
    }
    return ord($char);
}

function rc4($key, $str) {
    if (extension_loaded('mbstring') === true) {
        mb_language('Neutral');
        mb_internal_encoding('UTF-8');
        mb_detect_order(array('UTF-8', 'ISO-8859-15', 'ISO-8859-1', 'ASCII'));
    }

    $s = array();
    for ($i = 0; $i < 256; $i++) {
        $s[$i] = $i;
    }
    $j = 0;
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + mb_ord(mb_substr($key, $i % mb_strlen($key), 1))) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
    }
    $i = 0;
    $j = 0;
    $res = '';
    for ($y = 0; $y < mb_strlen($str); $y++) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;

        $res .= mb_chr(mb_ord(mb_substr($str, $y, 1)) ^ $s[($s[$i] + $s[$j]) % 256]);
    }
    return $res;
}
?>


