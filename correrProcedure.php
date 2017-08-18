<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://190.85.141.28:6530/expal/cargarRodWS.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch) or die(curl_error($ch));
    curl_close($ch);
    $array = json_decode($output, true);    
    if($array[0]>0){
      $msn = "Exito al subir, cantidad de viajes: ".$array[0];
      $destino = "desarrollo1@expresopalmira.com.co";
	  $asunto = "Insert desde Php";
	  $cabeceras = "Content-type: text/html";
	  $cuerpo =$msn;
	  mail($destino, $asunto, $cuerpo, $cabeceras);
    }/*else{
      $msn = "ejecutado viajes: ".$array[0];
      $destino = "desarrollo1@expresopalmira.com.co";
	  $asunto = "Insert desde Php";
	  $cabeceras = "Content-type: text/html";
	  $cuerpo =$msn;
	  mail($destino, $asunto, $cuerpo, $cabeceras);
    }*/
   ?>