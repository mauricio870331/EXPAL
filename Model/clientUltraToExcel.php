<?php
session_start();
include("funciones_mysql.php"); 
$fecha_inicial = $_SESSION['fecha_inicial'];
$fecha_final = $_SESSION['fecha_final'];
$opc = $_GET['opc'];
$and = "";
$d = "";
$tbl = "";
$titulo = "Listado Clientes Ultra";
if ($opc == "ganador") {
   $d = "distinct";
   $and = "and u.cod_usuario = t.cod_usuario";
   $tbl = ", tbl_tiquetes_hero t";
   $titulo = "Listado Clientes Ultra que participan en Hero";
}

$tbHtml = "<table>
            <header>
                <tr><th colspan='7'>".$titulo." Desde: ".$fecha_inicial." Hasta: ".$fecha_final."</th></tr>
                <tr>
				   <th>Cedula</th>
                   <th>Nombre</th>
				   <th>Telefono</th>
				   <th>E-mail</th>
				   <th>Ciudad</th>
				   <th>Fecha Alta</th>
				   <th>Activo</th>						
			    </tr>
            </header>";
$conexion = conectar("expresop_vultra");  	   
 $sql = "SELECT ".$d." u.cod_usuario, 
                    u.nombre,
                    u.apellido, 
                    u.telefono, 
                    u.correo, 
                    u.ciudad,
                    u.fecha_creacion,
                    u.Estado
            from tbl_usuario u ".$tbl." WHERE u.fecha_creacion BETWEEN '" . $fecha_inicial . " 00:00:00' AND  '" . $fecha_final . " 23:59:59' 
            AND u.Rol = 'cliente' ".$and." order by u.fecha_creacion";  


     $resultado = ejecutar($sql,$conexion);   

	
   while ($campo = mysql_fetch_row($resultado)){
	
	$tbHtml .= "<tr>";
    $tbHtml .= "<td>".utf8_decode($campo[0])."</td>";
    $tbHtml .= "<td>".utf8_decode($campo[1])." ".utf8_decode($campo[2])."</td>";       
    $tbHtml .= "<td>".utf8_decode($campo[3])."</td>";        
    $tbHtml .= "<td>".utf8_decode($campo[4])."</td>";
    $tbHtml .= "<td>".utf8_decode($campo[5])."</td>";
    $tbHtml .= "<td>".utf8_decode($campo[6])."</td>";
    $tbHtml .= "<td>";if ($campo[7] == "ACTIVO") {
    	$tbHtml .= "<b>Si</b>"; 
    	           } else { 
             $tbHtml .= "<b>No</b>"; 
        }  
     $tbHtml .= "</td>";        
     $tbHtml .= "</tr>";
      
	}

$tbHtml .= "</table>";
$tbHtml .= "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Listado_Clientes_Ultra.xls");
header("Pragma: no-cache"); 
header("Expires: 0");

echo $tbHtml;
?>