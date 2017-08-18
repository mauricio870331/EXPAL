<?php
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");  
  $directorio = $_POST['directorio'];  
  $res = 1;
  try {            
	  	if (is_dir($directorio )) {
          $carpeta = @scandir($directorio); 
          if (count($carpeta) > 2){
		        $res = 2;
		      }else{
            rmdir($directorio);             		        
		      }		   
		}else{
			$res = 0;
		}				 
	} catch (Exception $e) {	  	 	
	  	 
    }	  	  
    
   echo  $res;

?>