<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");
  
  $directorio = $_POST['directorio'];
  $ruta = "../../Documentos/".$directorio;
  $hoy = date("Y-m-d h:m:s");
  $response = 1;	
	    if (!file_exists("../../Documentos")){
	         mkdir("../../Documentos");
	    }
	    if(!file_exists($ruta)){
	       if(!mkdir($ruta)) {
	       	  die('Fallo al crear las carpetas...');
	      	  $response = 0;
	    	}
	    }else{
        $response = 2;
      }	  	
	
 
 
  echo $response;

?>