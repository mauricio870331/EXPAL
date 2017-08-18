<?php
include("funciones_mysql.php"); 
$opc = $_GET['opc'];
$fecINI = $_GET['ini'];
$fecFin = $_GET['fin'];

$tbHtml = "<table>
            <header>
                <tr><th colspan='9'>Listado Tiquetes Hero registrados desde: ".$fecINI." hasta : ".$fecFin."</th></tr>
                <tr>                  
                   <th>No. Tiquete</th>
                   <th>Origen</th>
                   <th>Destino</th>
                   <th>Agencia</th>
                   <th>Fecha Venta</th>
                   <th>Cedula</th>
                   <th>Nombre</th>    
                   <th>".utf8_decode('Teléfono')."</th> 
                   <th>Correo</th>                 
          </tr>
            </header>";
$objTiquetes = array();   
//$tiquetes = array();          
$conexion = conectar("expresop_vultra");       
$sql = "SELECT t1.tiquete,                
               t1.origen, 
               t1.destino,
              CASE WHEN t1.sucursal is null THEN 'No registra' ELSE t1.sucursal END as sucursal, 
               t1.fecha_viaje, 
               t1.cod_usuario,
               concat(t2.nombre,' ',t2.apellido),
               CASE WHEN t2.telefono = '' THEN 'No registra' ELSE t2.telefono END as telefono, 
               correo 
              FROM tbl_tiquetes_hero t1, tbl_usuario t2 WHERE t1.cod_usuario = t2.cod_usuario AND t1.estado = 'ACTIVO' AND t1.fecha_viaje BETWEEN '".$fecINI." 00:00:00' AND  '".$fecFin." 23:59:59' AND t2.Rol = 'cliente' LIMIT 0,30";  
           

   
    $resultado = ejecutar($sql,$conexion);  
    $result2 =  $resultado;

   while ($campo = mysql_fetch_row($resultado)){
        $objTiquetes[] = $campo;
        //$tiquetes[] = $campo[1];
   }  

    for ($i=0; $i < count($objTiquetes); $i++) {
     
            $tbHtml .= "<tr>";
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][0])."</td>"; 
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][1])."</td>";    
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][2])."</td>";        
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][3])."</td>";
            $tbHtml .= "<td>".(utf8_decode($objTiquetes[$i][4]))."</td>";
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][5])."</td>";
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][6])."</td>";    
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][7])."</td>";  
            $tbHtml .= "<td>".utf8_decode($objTiquetes[$i][8])."</td>";         
            $tbHtml .= "</td>";        
            $tbHtml .= "</tr>"; 

       
  }

$tbHtml .= "</table>";
$tbHtml .= "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";




 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Listado_Tiquetes.xls"); 
header("Pragma: no-cache");
header("Expires: 0");

echo $tbHtml;
?>