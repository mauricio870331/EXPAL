<?php 
    include ("funciones_mysql.php");
    // t2.origen, t2.destino, t3.ruta,  t3.destino,
    $conexion = conectar("expresop_vultra");
    $sql = "SELECT t1.cod_usuario,
                   t2.total_puntos,              
                   t1.correo,
                   t2.origen, 
                   t2.destino,                   
                   (SELECT getKMS(t2.origen,  t2.destino,  t1.cod_usuario)) as puntos,
                    (SELECT getCantPuntos(t2.origen,  t2.destino)) as km
                    FROM tbl_usuario t1, tbl_total_puntos t2 AND case when getKMS(t2.origen,  t2.destino,  t1.cod_usuario)>=getCantPuntos(t2.origen,  t2.destino) end
            WHERE  t1.cod_usuario = t2.cod_usuario 
            group by t1.cod_usuario";
    $resultado = ejecutar($sql,$conexion);  
    while ($campo = mysql_fetch_row($resultado)){
        $cod_usuario = $campo[0];
        $total_puntos = $campo[1];
        $kilometros = $campo[2];
        $correo = $campo[3];
        $origen = $campo[4];
        $destinoRuta = $campo[5];
        $puntosReales = $campo[6];
        if ($puntosReales>=$kilometros) {
            $asunto= "Expreso Palmira premia tu fidelidad.   Felicitaciones Ganaste !";
            $cabecera  = 'MIME-Version: 1.0' . "\r\n";
            $cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabecera .= 'From: Expreso Palmira <clientesultra@expresopalmira.com.co>' . "\r\n";
            $cabecera .= 'Bcc: desarrollo1@expresopalmira.com.co, clientesultra@expresopalmira.com.co, olga.sanchez@expresopalmira.com.co' . "\r\n";
            $destino = $correo;
            $cuerpo ="Te informamos que  ya tienes los  ".utf8_decode('kilómetros')." requeridos para reclamar   tu Tiquete  Obsequio.<br>"
            ."En la ruta: <b>".$origen." - ".$destinoRuta."</b> <br><br>"
            ."Para reclamar  tu premio ten en cuenta lo siguiente:<br>"
            ."Debes ingresar al programa Cliente Ultra con tu usuario y contraseña, una vez en el sistema dirigete a la opcion 'Mis Tiquetes' y presiona el ".utf8_decode('botòn')." 'Redimir Tiquete' <br>"
            ."Nuestro sistema es amigable y te informa que tienes registrados tiquetes, y que has acumulado los suficientes kilometros para reclamar tiquete(s), pero es posible que aun deban validarse algunos de ellos<br>"
            .utf8_decode('acciòn')." que debe realizar nuestro funcionario a cargo, si el sistema no te permite redimirlos por favor comunicate con nosotros enviando un correo en la direccion que especificamos al final de este mensaje."
            ."Los tiquetes entregados ".utf8_decode('tendrán')." una validez de 3 meses a partir de la fecha de ".utf8_decode('expedición')." y  no ".utf8_decode('podrán')." ser utilizados en temporadas altas.<br>" 
            ."Se define como temporada alta las fechas comprendidas entre: <br><br>"
            ."<ol>
                <li>Diciembre 01 a enero 31.</li>
                <li>Junio 15 a julio 31.</li>
                <li>Semana Santa (desde el viernes anterior al domingo de ramos hasta el lunes de pascua).</li>
                <li>Semana de receso escolar en el mes de octubre (inicia viernes anterior al inicio de la semana de receso y termina el lunes siguiente).</li>
                <li>Puentes  festivo del ".utf8_decode('día')." de la madre, ".utf8_decode('día')." anterior y posterior a este.</li>
                <li>Puentes  festivo del ".utf8_decode('día')." del padre, ".utf8_decode('día')." anterior y posterior a este.</li>
              </ol><br><br>
             Los tiquetes <b>Obsequios</b>  no pueden cederse, no son canjeables, ni sustituibles.  <br><br>
             Cualquier inquietud por favor ".utf8_decode('comuníquese')." con nosotros al correo; clientesultra@expresopalmira.com.co o revise el link http://www.expresopalmira.com.co/cliente-ultra.html e ingrese al ".utf8_decode('botón términos')." y condiciones.";
            mail($destino,$asunto,$cuerpo,$cabeceras);   
        }
    }
   
?> 





