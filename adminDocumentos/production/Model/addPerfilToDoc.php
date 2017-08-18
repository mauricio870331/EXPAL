<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $perfil = $_POST['perfil'];
  $documento = $_POST['documento'];
  
  $response = 1; 
  $sql = "SELECT id_doc, id_utemp FROM tbl_documentos_utemp WHERE id_doc = ".$documento." AND id_utemp = ".$perfil."";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)==0) { 
      $sql2 = "INSERT INTO tbl_documentos_utemp (id_doc, id_utemp) 
                       VALUES (".$documento.",".$perfil .")";
	  $resultado2 = ejecutar($sql2,$conexion);   
  }else{
    $sqlu="DELETE FROM tbl_documentos_utemp WHERE id_doc=".$documento." AND  id_utemp = ".$perfil."";
    $resultado = ejecutar($sqlu,$conexion);
	  $response = 2;
  }
 
  echo $response;

?>