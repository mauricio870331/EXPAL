<?php
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $perfil = $_POST['perfil']; 
  $res = 1;
  try {   

      $sql = "SELECT * FROM tbl_documentos_utemp WHERE id_utemp =".$perfil;
      $resultado = ejecutar($sql,$conexion);
      if (mysql_num_rows($resultado)>0){          
        $sql2 = "DELETE FROM tbl_documentos_utemp WHERE id_utemp =".$perfil;
        $resultado2 = ejecutar($sql2,$conexion);   
      }    
      $sql2 = "DELETE FROM  tbl_utemp WHERE id_utemp =".$perfil;
      $resultado2 = ejecutar($sql2,$conexion);  
  } catch (Exception $e) {	  	 	
	  	 $res = 0;
  }	  		
       
  echo  $res;

?>
