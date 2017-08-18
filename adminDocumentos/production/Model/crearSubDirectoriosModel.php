<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");
  
  $directorio = $_POST['directorio'];
  $subdirectorio = $_POST['subdirectorio']; 

  $response = 1;   
	    if(!file_exists($directorio."/".$subdirectorio)){
	       if(!mkdir($directorio."/".$subdirectorio)) {
	       	  die('Fallo al crear las carpetas...');
	      	  $response = 0;
	    	}
	    }else{
        $response = 2;
      }	  
  echo $response;

?>