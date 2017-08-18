<?php 
 include ("funciones_mysql.php");
 
    $tiquetesMatch = array();   

    $conexion = conectar("expresop_vultra");
    $sql = "SELECT t.nro_tiquete FROM tbl_tiquetes t, tbl_tiquetes_anulados ta WHERE t.nro_tiquete = ta.nro_tiquete LIMIT 30";
    $resultado = ejecutar($sql,$conexion);  
    while ($campo = mysql_fetch_row($resultado)){
        $tiquetesMatch[]=$campo[0];       
    }   
    if (count($tiquetesMatch)>0) {
      for ($i=0; $i < count($tiquetesMatch); $i++) {      
          $sql2 = "DELETE FROM tbl_tiquetes  WHERE nro_tiquete = '".$tiquetesMatch[$i]."'";
          $resultado2 = ejecutar($sql2,$conexion); 
      }
    }

     if (mysql_affected_rows()>0) {
            $asunto= "Tiquetes Anulados Eliminados";
            $cabecera  = 'MIME-Version: 1.0' . "\r\n";
            $cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabecera .= 'From: Expreso Palmira Crone Job <desarrollo1@expresopalmira.com.co>' . "\r\n";            
            $destino = 'desarrollo1@expresopalmira.com.co';
            $cuerpo = "Se han eliminado los siguientes tiquetes \r\n";
            for ($i=0; $i < count($tiquetesMatch); $i++) {  
               $cuerpo .= $tiquetesMatch[$i]. "\r\n";
            }
            mail($destino,$asunto,$cuerpo,$cabecera);              
      } else{
            $asunto= "Tiquetes Anulados Eliminados";
            $cabecera  = 'MIME-Version: 1.0' . "\r\n";
            $cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabecera .= 'From: Expreso Palmira Crone Job <desarrollo1@expresopalmira.com.co>' . "\r\n";            
            $destino = 'desarrollo1@expresopalmira.com.co';
            $cuerpo = "No se han eliminado tiquietes";
            mail($destino,$asunto,$cuerpo,$cabecera);
      }


    
   
?> 





