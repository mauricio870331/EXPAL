<?php 
if (!empty($_FILES)) {
	 include ("funciones_mysql.php");
	 $conexion = conectar("expresop_convenios");
	 $folder = $_POST['ruta'];	
	 $id=0;
	 $hoy = date("Y-m-d h:m:s");

    $totalUsado_mb = 0;                        
    $sqlt = "SELECT sum(size_doc) FROM tbl_documentos";
    $resultado = ejecutar($sqlt,$conexion);
    if (mysql_num_rows($resultado)>0) { 
     if ($campo = mysql_fetch_row($resultado)){
        $bytes=$campo[0];
        $totalUsado_mb = $bytes / 1000000; 
      }
      $porcientoMegas = (round(number_format($totalUsado_mb, 5, '.',','))/500)*100 ;      
    }

    if ($porcientoMegas<100) {    
	     
	    $temp = $_FILES['file']['tmp_name'];
	    $nombre = $_FILES['file']['name'];
	 	$tipo = $_FILES['file']['type'];
	 	$extension = end( explode('.', $nombre));	
	 	$size = $_FILES['file']['size']; 	
	 	$dir_separator = DIRECTORY_SEPARATOR; 	
	 	$destino_path =  dirname(__FILE__).$dir_separator.$folder.$dir_separator;
	 	$target_path = $destino_path.$_FILES['file']['name'];
	   if ($extension == "pdf" || $extension == "PDF" || $extension == "xls" || $extension == "xlsx") {

	 	if ($size>3999999) {
	 		echo json_encode(0);
	 	}elseif($size==0){
           echo json_encode(3);
	 	}else{ 	
             $sql = "SELECT nombre_doc FROM tbl_documentos WHERE nombre_doc = '".$nombre."' AND ruta = '".$folder."'";
 			$resultado = ejecutar($sql,$conexion);
            if (mysql_num_rows($resultado)==0) { 
            	 $sql2 = "INSERT INTO tbl_documentos (tipo_doc, ext, nombre_doc, size_doc, fecha_creacion, ruta) 
	                       VALUES ('".$tipo."','".$extension."','".$nombre."',".$size.",'".$hoy."', '".$folder."')";
			    $resultado2 = ejecutar($sql2,$conexion);  
			    if($resultado2){
			      if (move_uploaded_file($temp , $target_path)){
		 		     echo json_encode(1);
		 	      }
			    }
            }else{
            	 //if (move_uploaded_file($temp , $target_path)){
		 		 //    echo json_encode(1);
		 	     // }
			    	echo json_encode(2);
			} 	 		
	 	}
	 		
	 	}else{
	 		echo json_encode(4);
	 	}

	 
    }else{
        echo json_encode(5);
    }


	
 	
 }

                                          
?>