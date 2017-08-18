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
 /* header('Content-type: application/pdf'); 
	header('Content-Disposition: inline; filename="'.$Documento.'"');
  readfile($Documento);*/
?>
<html lang="en">
  <head> 
    <title>Vista Documentos</title>
    <link rel="icon" type="image/png" href="../images/favicon.png" /> 
<script language="JavaScript">
        
    /*function disableIE() {
        if (document.all) {
            return false;
        }
    }

    function disableNS(e) {
        if (document.layers||(document.getElementById&&!document.all)) {
            if (e.which==2||e.which==3) {
                return false;
            }
        }
    }


    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=disableNS;
    } 
    else {
        document.onmouseup=disableNS;
        document.oncontextmenu=disableIE;
    }
   
    document.oncontextmenu=new Function("return false")*/
    //<embed src="<?php echo $Documento ?>#toolbar=0" width="100%" height="100%" >   
</script>

  </head>

<body style="overflow-y:hidden" >
<embed src="<?php echo $Documento ?>" width="100%" height="100%" >   
</body>
</html>
