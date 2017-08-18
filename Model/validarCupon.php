<?php
include ("funciones_mysql.php");
$conexion = conectar("expresop_vultra");
$queryv = "SELECT count(*) FROM convenios_ultra WHERE nit = '" . $_POST['nit'] . "' AND clave = '" . $_POST['id'] . "'";
$rsv = ejecutar($queryv, $conexion);
$f = mysql_fetch_row($rsv);
if ($f[0] > 0) {
    $query1 = "SELECT * FROM usuarios_cupones WHERE id_convenio = '" . $_POST['nit']. "' AND doc_usuario = '" . $_POST['usuario'] . "' and redimido = 0 and estado = 'A' and consecutivo = '" . $_POST['consecutivo'] . "'";
    $rs1 = ejecutar($query1, $conexion);
    if ($c = mysql_fetch_row($rs1)) {
        $query = "UPDATE usuarios_cupones set redimido = 1 where consecutivo = '" . $_POST['consecutivo'] . "'";
        $rs = ejecutar($query, $conexion);  
        echo 1;
    }else{
        echo 2;
    }    
} else {
    echo 0;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//para anular los cupones
//
//SELECT * FROM usuarios_cupones WHERE id_convenio = 'BILLOSCOMIDASRAPIDAS' and redimido = 0 and estado = 'A' and  date_format(fecha_mod, '%Y-%m') < date_format(now(), '%Y-%m')
//