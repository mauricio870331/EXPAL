<?php 
    include ("funciones_mysql.php");
    
function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=8;     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}   
    $ids = array();
    $object = array();
    $correos = array("armenia"=>"armenia@expresopalmira.com.co",
                    "bogota norte"=>"bogota@expresopalmira.com.co",
                    "bogota sur"=>"bogota@expresopalmira.com.co",
                    "buenaventura"=>"buenaventura@expresopalmira.com.co",
                    "buga"=>"buga@expresopalmira.com.co",
                    "cali"=>"cali@expresopalmira.com.co",
                    "cartago"=>"cartago@expresopalmira.com.co",
                    "ibague"=>"ibague@expresopalmira.com.co",
                    "manizales"=>"manizales@expresopalmira.com.co",
                    "medellin"=>"medellin@expresopalmira.com.co",
                    "palmira estacion"=>"palmira@expresopalmira.com.co",
                    "palmira versalles"=>"palmira@expresopalmira.com.co",
                    "pereira"=>"pereira@expresopalmira.com.co",
                    "popayan"=>"popayan@expresopalmira.com.co",
                    "tulua"=>"tulua@expresopalmira.com.co"
                    );

    $conexion = conectar("expresop_convenios");
    $sql = "SELECT id, cod_usuario FROM tbl_musuarios_login WHERE nivel = 1 AND cambiaclaveAuto = 1";
    $resultado = ejecutar($sql,$conexion);  
    while ($campo = mysql_fetch_row($resultado)){
        $object['id']=$campo[0];
        $object['cod_usuario']=$campo[1];
        $object['new_pass']=generaPass();
        if(array_key_exists($campo[1], $correos)){
            $object['correo']=$correos[$campo[1]]; 
        }
        $ids[]=$object;
    }

  // echo "<pre>";print_r($ids); echo "</pre>";  echo "<pre>";print_r($value); echo "</pre>";
   foreach ($ids as $key => $value) {     
      $sql2 = "UPDATE tbl_musuarios_login SET clave = '".$value['new_pass']."' WHERE id = ".$value['id'];
      $resultado2 = ejecutar($sql2,$conexion); 
      if (mysql_affected_rows()>0) {
            $asunto= "Cambio de ".utf8_decode('contraseña')." taquillas..!";
            $cabecera  = 'MIME-Version: 1.0' . "\r\n";
            $cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabecera .= 'From: Expreso Palmira <desarrollo1@expresopalmira.com.co>' . "\r\n";
            $cabecera .= 'Cc: desarrollo1@expresopalmira.com.co, olga.sanchez@expresopalmira.com.co' . "\r\n";
            $destino = $value['correo'];
            $cuerpo ="Se ha actualizado la ".utf8_decode('contraseña')." para la taquilla con el usuario: ".$value['cod_usuario'].".<br>"
                    ."Nueva ".utf8_decode('contraseña')." : ".$value['new_pass']."";
            mail($destino,$asunto,$cuerpo,$cabeceras); 
      }     
   }

   
?> 





