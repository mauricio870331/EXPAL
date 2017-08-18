<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $perfil = $_POST['perfil'];  
  $response = 1; 
  $sql = "SELECT * FROM  tbl_utemp WHERE descripcion = '".$perfil."'";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)==0) { 
      $sql2 = "INSERT INTO tbl_utemp (descripcion) 
                       VALUES ('".$perfil."')";
	  $resultado2 = ejecutar($sql2,$conexion); 
    if(!$resultado2){
      $response = 0;
    }  
  }else{
	  $response = 2;
  }
 
  echo $response;

?>