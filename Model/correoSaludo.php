
<?php
/*if ($_GET['INI'] && $_GET['FIN'] ) {
include("funciones_mysql.php");
$conexion = conectar("expresop_vultra");

$sql = ("SELECT id, correo FROM `tbl_usuario` where id between ".$_GET['INI']." and ".$_GET['FIN']." and correo is not null and correo != '' and id not in (1,2,292)");
$resultado = ejecutar($sql, $conexion);
if (mysql_num_rows($resultado) != 0) {
    while ($campo = mysql_fetch_row($resultado)) {         
        echo $mail = $campo[1].' '.$campo[0].'<br>';
        try {*/
        	$mail = "secreadmin_mzales@cosmitet.net,cias.colpatria@ui.colpatria.com,tesoreria@nutriavicola.com";
        	$mail .= ",damasverdes-huv@hotmail.com,fabian.ruiz@correo.policia.gov.co,czamorano@caminantesviajesyturismo.com";
        	$mail .= ",deris.secsa-jefat@policia.gov.co,gloria.avila@agencialogistica.gov.co,mosqueramo@ejercito.mil.co";
        	$mail .= ",wramirez@sos.com.co,administracion@hoturisviajes.com.co,administracion@fdp.com.co";
        	$mail .= ",dequi.grusa@policia.gov.co,gerenciageneral@meditramites.co,aliriobetancouth@asmetsalud.co";
        	$mail .= ",bperez@sos.com.co,acardenas@sos.com.co,lsierra@sos.com.co";
        	$mail .= ",luisa.sanchez@meditramites.com,direcciondeproyectos@meditramites.co";
        	$correo = $mail;//"olga.sanchez@expresopalmira.com.co,publicidad@expresopalmira.com.co,desarrollo1@expresopalmira.com.co";        
	          $asunto= "Te deseamos unas felices fiestas en ".utf8_decode('compañía')." de los tuyos!";         
	          $cabeceras =  'MIME-Version: 1.0' . "\r\n"; 
	          $cabeceras .= 'From: Expreso Palmira <comunidadweb@expresopalmira.com.co>' . "\r\n";
	          $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";           
	          $cuerpo = "<html>
						    <head>
						        <title>Expreso Palmira</title>
						        <meta charset='UTF-8'>
						        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
						    </head>
						    <body bgcolor='#CCCCCC'>					     
						        <div align='center' style='margin: 0 auto;width:65%;background-color: white;'><br/><br/>
						            <img src='http://www.expresopalmira.com.co/img/nav.png' alt='Felices Fiestas Te Desea Expreso Palmira' width='750' height='800'/>   
						                  <br/>
						            <p>Linea Amiga: 01 8000 93 66 62 WhatsApp: 321 890 35 97 PBX: (2) 664 46 89</p>
						            <p>Correo: servicioalcliente@expresopalmira.com.co</p>
						            <table style='width:95%;' bgcolor='#ECE9E9' >
						                <tr>
						                    <td style='width: 60%'>
						                         Visitanos en :
							                         <a href='http://www.expresopalmira.com.co/' style='color: #003300;font-size: larger'>
							                           www.expresopalmira.com.co
							                         </a>                          
						                    </td> 
						                    <td style='width: 40%;text-align:right;font-size:15' >                        
						                            <b>".utf8_decode('Síguenos')." en:&nbsp;&nbsp;</b><a href='https://www.facebook.com/Expressopalmira/?fref=nf'><img src='http://www.expresopalmira.com.co/img/3.jpg' alt='' width='28' height='28'/></a>
						                            &nbsp;
						                            <a href='https://twitter.com/EPalmiraOficial'><img src='http://www.expresopalmira.com.co/img/4.png' alt='' width='28' height='28'/></a>
						                    </td>   
						                </tr> 
						            </table>
						        </div>        
						    </body>
						</html>";
          		mail($correo,$asunto,$cuerpo,$cabeceras);
       /* } catch (Exception $e) {
        	echo $e;
        }
      
    }

}    
}else{
	echo 'no hay rango';
}
*/

 
     

?>
