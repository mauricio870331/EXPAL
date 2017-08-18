<?php
   session_start(); 
  if (empty($_SESSION['descripcion'])){
    header('Location: index.php');
  }  
     include ("funciones_mysql.php");
    $conexion = conectar("expresop_convenios");     
    $documento = base64_decode($_GET['documento']);  
    $RUTATEMP = ""; 
    $sql2 = "SELECT ruta FROM tbl_documentos WHERE  nombre_doc = '".$documento."'";
    $resultado2 = ejecutar($sql2,$conexion);
    if ($campo2 = mysql_fetch_row($resultado2)){     
       $RUTATEMP = $campo2[0];
    }    
    $Documento = $RUTATEMP.'/'.$documento;  

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($Documento));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($Documento));
	ob_clean();
	flush();
	readfile($Documento);
	exit;


?>