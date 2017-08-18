<?php

//include ("funciones_mysql.php");
//
//$cedula = $_GET['cedula'];
//$validar = array();
//$verificados = array();
//$tiquetestemp = array();
//Obtener todos los tiquetes a validar de un cliente
//  $conexion = conectar("expresop_vultra");
//  $sql = "SELECT id, nro_tiquete, origen, destino, kilometros FROM tbl_tiquetes WHERE cod_usuario = '".$cedula."'";
//  $resultado = ejecutar($sql,$conexion);
//  while ($campo = mysql_fetch_row($resultado)){
//      $validar[]=$campo;
//  }
//echo '<pre>';print_r($validar);echo '</pre><br>';
// se obtienen los datos de los tiquetes que coinciden en la tabla reservas del nodum, por ahora solo Nodum, queda pendiente
// la validacion en la tabla gps
//  for ($i=0; $i < count($validar); $i++) { 
//    $ch = curl_init();    
//    curl_setopt($ch, CURLOPT_URL,'http://190.85.141.28:6530/expal/consultaValidaSendMail.php?param1='.$validar[$i][1]);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $output = curl_exec($ch) or die (curl_error ($ch));
//    curl_close($ch);
//    $array = json_decode($output, true); 
//    $tiquetestemp[]=$array;   
// }
//echo '<pre>';print_r($tiquetestemp);echo '</pre>'; 
// Si el documento del usuario no coincide con el documento que se obtiene de la consulta  de nodum
// se eliminan los puntos del usuario 
//for ($i=0; $i <  count($tiquetestemp) ; $i++) { 
//    if ($tiquetestemp[$i][0]['PasCod'] != (int) $cedula) {          
//        $sqlDelete = "DELETE  FROM tbl_tiquetes WHERE id = ".$validar[$i][0];
//        $resultado = ejecutar($sqlDelete,$conexion);
//        if ($resultado) {
//           $quitarpuntos = $validar[$i][4];
//           $sqlUpdate = "UPDATE tbl_total_puntos SET total_puntos = (total_puntos-$quitarpuntos) WHERE cod_usuario = '".$cedula."' AND origen = '".$validar[$i][2]."' AND destino = '".$validar[$i][3]."'";
//           $resultadoU = ejecutar($sqlUpdate,$conexion);
//        }
//    }else{
//       $sqlUpdate = "UPDATE tbl_tiquetes SET estado = 'V' WHERE id = ".$validar[$i][0];
//       $resultadoU = ejecutar($sqlUpdate,$conexion);
//       if ($resultadoU){
//           $verificados[] = $validar[$i];
//       }
//       unset($validar[$i]); //enviar correo diciendo que ya se verificaron
//    }
//}
//
//  // se obtiene el correo del usuario para enviarle el mensaje 
// if (count($validar)>0){
//  $sqlUser = "SELECT correo FROM tbl_usuario WHERE cod_usuario = '".$cedula."'";
//  $resultado = ejecutar($sqlUser,$conexion);
//  if ($campo = mysql_fetch_row($resultado)){
//      $correo=$campo[0];
//  }
//
//      $asunto= "Registro Tiquetes  Clientes ultra";
//      $cabeceras = "Content-type: text/html";
//      $destino = "desarrollo1@expresopalmira.com.co,".$correo."";
//      $cuerpo ="Sr.  Usuario  realizando la  ".utf8_decode('validación')." de los tiquetes que  usted registro como Cliente Ultra,  encontramos que los tiquetes  relacionados  a ".utf8_decode('continuación')." no   fueron  validados por el sistema,  ya que  no ".utf8_decode('están')." acordes a los ".utf8_decode('términos')." y condiciones del plan.<br><br>
//       <table border='1'>
//        <tr>
//        <td><b>Causal</b></td>
//        <td><b>Motivo</b></td>
//      </tr>
//       
//         <tr>
//          <td><b>01</b></td>
//          <td>".utf8_decode('Número')." de tiquete no coincide  con nuestros registros de tiquetes  sistematizados.</td>       
//         </tr>
//         <tr>         
//          <td><b>02</b></td>
//          <td>La ".utf8_decode('cédula')." impresa en el tiquete no coincide con  el ".utf8_decode('número')." de ".utf8_decode('cédula')." del usuario registrado.  <b>Recuerde</b> que es responsabilidad del inscrito validar que el tiquete tenga su ".utf8_decode('número')." de ".utf8_decode('identificación').", nombres y apellidos, de no ser ".utf8_decode('así').", el cliente debe informar la inconsistencia antes del viaje, ya que de lo contrario no ".utf8_decode('podrá')." inscribir el tiquete para acumular ".utf8_decode('kilómetros').".</td>
//         </tr>
//          <tr>
//          <td><b>03</b></td>
//          <td>El  origen o el destino del tiquete no participan</td>       
//         </tr>
//           <tr>
//          <td><b>04</b></td>
//          <td>El origen o el destino del tiquete no coinciden con el tiquete impreso</td>       
//         </tr>
//          <tr>
//          <td><b>05</b></td>
//          <td>Tiquetes con fecha de ".utf8_decode('expedición')." mayor o igual a un ".utf8_decode('año')."</td>       
//         </tr>        
//       </table>
//       <br>
//           
//       <table border='1'>
//        <tr>
//          <td><b>No. Tiquete</b></td>
//          <td><b>Causal de ".utf8_decode('Anulación')."</b></td>
//        </tr> ";
//        for ($i=0; $i < count($validar); $i++) {       
//        $cuerpo.= "<tr>
//                <td>".$validar[$i][1]."</td>
//                <td>02</td>
//              </tr>";   
//      
//        }  
//        $cuerpo.= "<br> <h4>Tiquetes Verificados:</h4><br>";
//       if (count($verificados)>0){     
//       $cuerpo.="<table border='1'>
//        <tr>
//          <td><b>No. Tiquete</b></td>
//          <td>Estado</b></td>
//        </tr> ";
//        for ($i=0; $i < count($verificados); $i++) {       
//        $cuerpo.= "<tr>
//                <td>".$verificados[$i]."</td>
//                <td>Verificado</td>
//              </tr>";   
//      
//        }  
//        $cuerpo.= "</table>
//        <br>
//      Cualquier inquietud  por favor ".utf8_decode('comuníquese')." con nosotros al correo; clientesultra@expresopalmira.com.co o revise el link <a href='http://www.expresopalmira.com.co/cliente-ultra.html'>http://www.expresopalmira.com.co/cliente-ultra.html</a> e ingrese al ".utf8_decode('botón')." ".utf8_decode('términos')." y condiciones.";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: Your name <info@address.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
echo mail('mherrerra10@misena.edu.co', 'prueba', 'prueba', $headers);
//    }

/*   $asunto= "Registro Tiquetes  Clientes ultra";
  $cabeceras = "Content-type: text/html";
  $destino = "desarrollo1@expresopalmira.com.co, leonardo.hernandez@correo.policia.gov.co";
  $cuerpo ="Sr.  Usuario  realizando la  ".utf8_decode('validación')." de los tiquetes que  usted registro como Cliente Ultra,  encontramos que los tiquetes  fueron  validados por el sistema,  ya que  no ".utf8_decode('están')." acordes a los ".utf8_decode('términos')." y condiciones del plan.<br><br>
  <table border='1'>
  <tr>
  <td><b>Causal</b></td>
  <td><b>Motivo</b></td>
  </tr>

  <tr>
  <td><b>01</b></td>
  <td>".utf8_decode('Número')." de tiquete no coincide  con nuestros registros de tiquetes  sistematizados.</td>
  </tr>
  <tr>
  <td><b>02</b></td>
  <td>La ".utf8_decode('cédula')." impresa en el tiquete no coincide con  el ".utf8_decode('número')." de ".utf8_decode('cédula')." del usuario registrado.  <b>Recuerde</b> que es responsabilidad del inscrito validar que el tiquete tenga su ".utf8_decode('número')." de ".utf8_decode('identificación').", nombres y apellidos, de no ser ".utf8_decode('así').", el cliente debe informar la inconsistencia antes del viaje, ya que de lo contrario no ".utf8_decode('podrá')." inscribir el tiquete para acumular ".utf8_decode('kilómetros').".</td>
  </tr>
  <tr>
  <td><b>03</b></td>
  <td>El  origen o el destino del tiquete no participan</td>
  </tr>
  <tr>
  <td><b>04</b></td>
  <td>El origen o el destino del tiquete no coinciden con el tiquete impreso</td>
  </tr>
  <tr>
  <td><b>05</b></td>
  <td>Tiquetes con fecha de ".utf8_decode('expedición')." mayor o igual a un ".utf8_decode('año')."</td>
  </tr>
  </table>
  <br>

  Causal : <b>02</b><br>
  Por favor consulte el codigo de la causa en la tabla anterior..



  <br>
  Cualquier inquietud  por favor ".utf8_decode('comuníquese')." con nosotros al correo; clientesultra@expresopalmira.com.co o revise el link <a href='http://www.expresopalmira.com.co/cliente-ultra.html'>http://www.expresopalmira.com.co/cliente-ultra.html</a> e ingrese al ".utf8_decode('botón')." ".utf8_decode('términos')." y condiciones.";
  mail($destino,$asunto,$cuerpo,$cabeceras);


 */
?>