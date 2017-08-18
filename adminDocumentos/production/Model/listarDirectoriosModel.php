<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");
  $directorios = array(); 
  
  $sql = "SELECT nom_directorio FROM tbl_directorios ORDER BY nom_directorio";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)>0) { 
   while ($campo = mysql_fetch_row($resultado3)){
      $kilometros=$campo[0];
    }
  }else{
	  $response = 2;
  }
 
  echo $response;

?>