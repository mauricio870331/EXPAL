<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
 $cedula = $_POST[id]; 
 $pass = $_POST[pass]; 

include ("funciones_mysql.php");
include ("encriptar.php");  
$clave_encriptada = Encrypter::encrypt($pass);

$conexion = conectar("expresop_vultra");
$sql = "UPDATE  tbl_usuario SET clave =  '".$clave_encriptada."', cambio_clave = 'N' WHERE cod_usuario = '".$cedula."'"; 
$resultado = ejecutar($sql,$conexion);

if ($resultado) {	 
     echo 1;
	}else{    
     echo 0;
	}		
}
	

?>