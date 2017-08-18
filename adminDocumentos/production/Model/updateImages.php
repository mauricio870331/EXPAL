<?php
include ("funciones_mysql.php");
$conexion = conectar("expresop_convenios");
 $opc = $_POST['opc'];	
 $pos = $_POST['number'];	
 $id_update = $_POST['upd'];
 $sql2 = "UPDATE imagenesEP SET  lugar = '".$opc."', posicion = '".$pos."' WHERE id = ".$id_update;


 $resultado2 = ejecutar($sql2,$conexion); 

 if (mysql_affected_rows()>0) {
  	header("location: ../chargedImages.php");
  } else{
  	echo $resultado2;
  }
  mysql_close($conexion);

?>