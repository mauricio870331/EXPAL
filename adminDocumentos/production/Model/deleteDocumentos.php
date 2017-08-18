<?php
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $directorio = $_POST['directorio'];  
  $directorio =  substr($directorio, 0, -1);
  $documento = $_POST['documento'];  
  
  $res = 1;

  try {            
	  if (file_exists($directorio."/".$documento)) {
         chmod($directorio."/".$documento, 0755);
         if (!unlink($directorio."/".$documento)) {
           $res = 0;  
         }else{
            $sql = "SELECT id_doc FROM tbl_documentos WHERE nombre_doc = '".$documento."' AND ruta = '".$directorio."'";
            $resultado = ejecutar($sql,$conexion);            
               if ($campo = mysql_fetch_row($resultado)){
                   $id_doc=$campo[0];
                    $sql2 = "DELETE FROM tbl_documentos_utemp WHERE id_doc = ".$id_doc."";
                    $resultado2 = ejecutar($sql2,$conexion);
                   if($resultado2){
                     $sql3 = "DELETE FROM tbl_documentos WHERE id_doc = ".$id_doc."";
                     $resultado3 = ejecutar($sql3,$conexion); 
                   } 
               } 
            
         } 	 
		}	else{
      $res = 2;
    }		 
	} catch (Exception $e) {	  	 	
	  	 
  }	        
  echo  $res;

?>