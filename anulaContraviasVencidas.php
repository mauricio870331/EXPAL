<?php 
    include ("funciones_mysql.php");
    $conexion = conectar("expresop_convenios");
    $sql = "UPDATE tbl_registroContravias SET estado='Vencido' WHERE NOW() >= DATE_ADD(fecha,INTERVAL 90 DAY) and estado = 'Pendiente'";
    $resultado = ejecutar($sql,$conexion); 
    $numero = mysql_affected_rows();   
    if ($numero > 0 ) {                         
            $asunto= "Reporte Cron Job Anular tiquetes Contravias";
            $cabeceras = "Content-type: text/html";
            $destino = "desarrollo1@expresopalmira.com.co";
            $cuerpo ="Cron Job Anular tiquetes contravias Ejecutado con ".utf8_decode("éxito")." Registros afectados = ". $numero;
            mail($destino,$asunto,$cuerpo,$cabeceras);         
            
      } else{
            $asunto= "Reporte Cron Job Anular tiquetes Contravias";
            $cabeceras = "Content-type: text/html";
            $destino = "desarrollo1@expresopalmira.com.co";
            $cuerpo ="Cron Job Anular tiquetes contravias Ejecutado con ".utf8_decode("éxito")." No hay tiquetes vencidos";
            mail($destino,$asunto,$cuerpo,$cabeceras);  
      } 
   
?>