<?php

function conectar($bd){
	$con = mysql_connect ('localhost','expresop_user','S1st3m4s') or die ("ERROR EN CONEXION: ".mysql_error());
	$base_datos = mysql_select_db ($bd,$con) or die ("ERROR AL SELECCIONAR BASE DE DATOS: ".mysql_error()); 
	return $con; 
}

function ejecutar($sql,$con){
    mysql_query("SET NAMES 'utf8'");
	$result = mysql_query ($sql,$con)or die ("ERROR EN LA CONSULTA: ".mysql_error());
	//mysql_close($con);
	return $result;
}

function conectarNodum(){
	$con = mysql_connect ('192.168.10.1','sa','EPpal2003') or die ("ERROR EN CONEXION: ".mysql_error());
	$base_datos = mysql_select_db ('NodumEP',$con) or die ("ERROR AL SELECCIONAR BASE DE DATOS: ".mysql_error()); 

	return $con; 
}


function ejecutar2($sql,$con){
    mysql_query("SET NAMES 'utf8'");
	$result = mysql_query ($sql,$con)or die ("ERROR EN LA CONSULTA: ".mysql_error());
	//mysql_close($con);
	return $result;
}


?>