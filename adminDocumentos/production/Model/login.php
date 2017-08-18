<?php 
session_start();
include ("funciones_mysql.php");
$conexion = conectar("expresop_convenios");  
$user = $_POST['user'];  
$pass = $_POST['pass'];  
$response = 1; 
$sql = "SELECT * FROM  tbl_utemp WHERE descripcion = '".$user."' AND pass = '".$pass."'" ;
$resultado = ejecutar($sql,$conexion);
if ($campo = mysql_fetch_row($resultado)){
     $_SESSION['id_utemp'] = $campo[0] ;
     $_SESSION['descripcion'] =$campo[1] ;
     $_SESSION['pass'] = $campo[2] ;     
}else{
  	 $response = 0; 
} 
echo $response;

?>