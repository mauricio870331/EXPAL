<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $perfil = $_POST['perfil'];  
  $Update = $_POST['Update'];  

  $response = 0; 
  $sql = "UPDATE tbl_utemp SET pass = '".$Update."' WHERE id_utemp = ".$perfil;

  $resultado = ejecutar($sql,$conexion);
  if (mysql_affected_rows()>0) {     
      $response = 1;   
  }
  echo $response;

?>