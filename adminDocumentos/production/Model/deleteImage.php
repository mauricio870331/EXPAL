<?php
include ("funciones_mysql.php");
$conexion = conectar("expresop_convenios"); 
 $id_delete = $_POST['id'];
 $sql2 = "DELETE FROM imagenesEP WHERE id = ".$id_delete;


 $resultado2 = ejecutar($sql2,$conexion); 

 if (mysql_affected_rows()>0) {
  	echo 1;
  } else{
  	echo 2;
  }
  mysql_close($conexion);

?>