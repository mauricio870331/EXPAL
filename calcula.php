 <?php 
	include("funciones_mysql.php"); 
      	$tipo_servicio =$_POST[tipo_servicio];
        $contenido = $_POST[contenido];
	    $origen = $_POST[origen]; 
        $destino = $_POST[destino];
        $kilos = $_POST[kilos]; 
        $largo = $_POST[largo]; 
        $ancho = $_POST[ancho]; 
        $alto = $_POST[alto];
        $valor_declarado = $_POST[valor];
	    $cajas = $_POST[cajas];
        $forma_pago = $_POST[forma_pago];	   
	
	 $conexion = conectar("expresop_rutas");
   $sql = "SELECT t.primer_kilo,t.kilo_adicional,t.nivel FROM ciudades as c,tarifas as t WHERE c.origen = '". $origen ."' AND  c.destino ='". $destino ."' AND c.tipo = t.id";
	
 $resultado = ejecutar($sql,$conexion);
		
 while ($campo = mysql_fetch_row($resultado)){
	
        $primer_kilo = $campo[0];
	    $kilo_adicional = $campo[1];
		$nivel = $campo[2];
		}
		$kilos_aprox = ceil($kilos);
if($tipo_servicio == "Mensajeria" && $contenido == "Documento"){
		//FORMULA POR KILOS
		$aux1 = $kilos_aprox - 1;
		$resultado_parcial = $primer_kilo + ($aux1 * $kilo_adicional);
		if($valor_declarado <=  10000){
		$impuesto = 100;
		}else{
		$impuesto = $valor_declarado * 0.01;
		}
		$total = $resultado_parcial + $impuesto;
		 echo "<label >Servicio: ".$nivel."</label><br/>";
		 echo "<label >Primer Kilo: $".number_format($primer_kilo)."</label><br/>";
		echo "<label >Kilo adicional: $".number_format($kilo_adicional * $aux1)."</label><br/>";
		echo "<label >Manejo: $".number_format($impuesto)."</label><br/>";
		 echo "<label >Total : $".number_format($total)."</label><br/>";
}
if($tipo_servicio == "Mensajeria" && $contenido == "Mercancia"){

//FORMULA POR KILOS
		$aux1 = $kilos_aprox - 1;
		$resultado_parcial = $primer_kilo + ($aux1 * $kilo_adicional);
		if($valor_declarado <=  10000){
		$impuesto = 100;
		}else{
		$impuesto = $valor_declarado * 0.01;
		}
		$total = $resultado_parcial + $impuesto;
		
		//FORMULA POR VOLUMEN
		 $volumen = ($largo*$ancho*$alto*$cajas)/2500;
		 $volumen_aprox = ceil($volumen);
	     $aux2 = $volumen_aprox - 1;
	 $resultado_parcial2 = $primer_kilo + ($aux2 * $kilo_adicional);
	if($valor_declarado <=  10000){
		$impuesto2 = 100;
		}else{
		$impuesto2 = $valor_declarado * 0.01;
		}	
	
	 $total2 = $resultado_parcial2 + $impuesto2;
		
		if($total>$total2){
		 echo "<label >Servicio: ".$nivel."</label><br/>";
		 echo "<label >Primer Kilo: $".number_format($primer_kilo)."</label><br/>";
		 if($aux1 == 0){
		  echo "<label >Kilo adicional: $".number_format(0)."</label><br/>";
		 }
		 else{
		  echo "<label >Kilo adicional: $".number_format($kilo_adicional * $aux1)."</label><br/>";
		  
		 }		 	
		echo "<label >Manejo: $".number_format($impuesto)."</label><br/>";
		   echo "<label >Total : $".number_format($total)."</label><br/>";
			  
			  echo "<label >Peso real: ".number_format($kilos)."</label><br/>";
				echo "<label >Peso volumen: ".number_format($volumen_aprox)."</label><br/>";
			}
			else{
			 echo "<label >Servicio: ".$nivel."</label><br/>";
		 echo "<label >Primer Kilo: $".number_format($primer_kilo)."</label><br/>";
		  if($aux2 == 0){
		  echo "<label >Kilo adicional: $".number_format(0)."</label><br/>";
		 }
		 else{
		  echo "<label >Kilo adicional: $".number_format($kilo_adicional * $aux2)."</label><br/>";
		 }		 
		   echo "<label >Manejo: $".number_format($impuesto2)."</label><br/>";
		    echo "<label >Total : $".number_format($total2)."</label><br/>";
			  echo "<label >Peso real: ".number_format($kilos)."</label><br/>";
				echo "<label >Peso volumen: ".number_format($volumen_aprox)."</label><br/>";
			}
}
$sql2 = "SELECT super_ex_docu, expreso_documentos, super_ex_paquetes_20kg, super_ex_paquetes_20kg_ka,
expreso_paquetes_20kg, expreso_paquetes_20kg_ka, super_ex_21kg, expreso_21kg
 FROM ciudades2 WHERE origen = '". $origen ."' AND  destino ='". $destino ."'";
$resultado2 = ejecutar($sql2,$conexion);
		
 while ($campo2 = mysql_fetch_row($resultado2)){
	
        $super_ex_docu = $campo2[0];
	    $expreso_documentos = $campo2[1];
		$super_ex_paquetes_20kg = $campo2[2];
        $super_ex_paquetes_20kg_ka = $campo2[3];
		$expreso_paquetes_20kg = $campo2[4];
		$expreso_paquetes_20kg_ka = $campo2[5];
		$super_ex_21kg = $campo2[6];
	    $expreso_21kg = $campo2[7];
	}
if($tipo_servicio == "Expreso" && $contenido == "Documento"){

		
		if($valor_declarado <=  40000){
		$impuesto = 400;
		}else{
		$impuesto = $valor_declarado * 0.01;
		}
		$total = $expreso_documentos + $impuesto;
		
		 echo "<label >Primer Kilo: $".number_format($expreso_documentos)."</label><br/>";
		  echo "<label >Kilo adicional: $ 0</label><br/>";
		    echo "<label >Manejo : $".number_format($impuesto)."</label><br/>";
		      echo "<label >Total : $".number_format($total)."</label><br/>";
}
if($tipo_servicio == "Expreso" && $contenido == "Mercancia"){
//FORMULA POR KILOS
	$aux1 = $kilos_aprox - 1;
	if($kilos_aprox >= 21){
		$resultado_parcial = $kilos_aprox * $expreso_21kg;
	}
	else{
		$resultado_parcial = $expreso_paquetes_20kg + ($aux1 * $expreso_paquetes_20kg_ka);//-->
	}
	if($valor_declarado <=  200000){
		$impuesto = 2000;
	}else{
		$impuesto = $valor_declarado * 0.01;
	}
	$total = $resultado_parcial + $impuesto;//->
	
		//FORMULA POR VOLUMEN
	$volumen = ($largo*$ancho*$alto*$cajas)/2500;//-->
	$volumen_aprox = ceil($volumen);
	$aux2 = $volumen_aprox - 1;
	if($volumen_aprox >= 21){//->
		$resultado_parcial2 = $volumen_aprox * $expreso_21kg;
	}
	else{
		$resultado_parcial2 = $expreso_paquetes_20kg + ($aux2 * $expreso_paquetes_20kg_ka);
	}
		
	if($valor_declarado <=  200000){
		$impuesto2 = 2000;
	}else{
		$impuesto2 = $valor_declarado * 0.01;
	}	
	
	 $total2 = $resultado_parcial2 + $impuesto2;//-->
	 	
	 if($total>$total2){
	 	
	 	if($kilos_aprox >= 21){
	 		
	 		echo "<label >Primer Kilo: $".number_format(0)."</label><br/>";
	 	}else{
	 		echo "<label >Primer Kilo: $".number_format($expreso_paquetes_20kg)."</label><br/>";
	 	}
	 	
	 	if($kilos_aprox >= 21){
	 		echo "<label >Kilo adicional: $".number_format($expreso_21kg * $kilos_aprox)."</label><br/>";
	 	}else{
	 		echo "<label >Kilo adicional: $".number_format($expreso_paquetes_20kg_ka * $aux1)."</label><br/>";
	 	}
	 	
	 	echo "<label >Manejo: $".number_format($impuesto)."</label><br/>";
	 	
	 	echo "<label >Total : $".number_format($total)."</label><br/>";
	 	echo '<br>';
	 	echo "<label >Peso real: ".$kilos_aprox."kg</label><br/>";
	 	echo "<label >Peso volumen: ".$volumen_aprox."kg</label><br/>";
	 }
	 else{
	 	
	 	if($volumen_aprox >= 21){//-->
	 		echo "<label >Primer Kilo: $".number_format(0)."</label><br/>";
	 		echo "<label >Kilo adicional: $".number_format($expreso_21kg * $volumen_aprox)."</label><br/>";
	 	}else{	 		
	 		echo "<label >Primer Kilo: $".number_format($expreso_paquetes_20kg)."</label><br/>";
	 		echo "<label >Kilo adicional: $".number_format($expreso_paquetes_20kg_ka * $aux2)."</label><br/>";
	 	} 		
	 	
	 	echo "<label >Manejo: $".number_format($impuesto2)."</label><br/>";
	 	
	 	echo "<label >Total : $".number_format($total2)."</label><br/>";
	 	echo '<br>';
	 	echo "<label >Peso real:".$kilos_aprox."kg</label><br/>";
	 	echo "<label >Peso volumen: ".$volumen_aprox."kg</label><br/>";
	 	
	 }

	}
if($tipo_servicio == "Super Expreso" && $contenido == "Documento"){
    	
		if($valor_declarado <=  40000){
		$impuesto = 400;
		}else{
		$impuesto = $valor_declarado * 0.01;
		}
		  if($forma_pago == "Contraentrega"){
	  $contraentrega = 3150;
	  $total = $super_ex_docu + $impuesto + $contraentrega;
	  }else{
		$total = $super_ex_docu + $impuesto;
		}
		
		
		 echo "<label >Primer Kilo: $".number_format($super_ex_docu)."</label><br/>";
		  echo "<label >Kilo adicional: $ 0</label><br/>";
		    if($forma_pago == "Contraentrega"){
			 echo "<label >Contraentrega: $".number_format($contraentrega)."</label><br/>";
			}
			 echo "<label >Manejo: $".number_format($impuesto)."</label><br/>";
		      echo "<label >Total : $".number_format($total)."</label><br/>";
}
if($tipo_servicio == "Super Expreso" && $contenido == "Mercancia"){
//FORMULA POR KILOS
		$aux1 = $kilos_aprox - 1;
		 if($kilos_aprox >= 21){
		 $resultado_parcial = $kilos_aprox * $super_ex_21kg;
			}
		else{
			$resultado_parcial = $super_ex_paquetes_20kg + ($aux1 * $super_ex_paquetes_20kg_ka);
		}
		if($valor_declarado <=  200000){
		$impuesto = 2000;
		}else{
		$impuesto = $valor_declarado * 0.01;
		}
		  if($forma_pago == "Contraentrega"){
	  $contraentrega = 3150;
	  $total = $resultado_parcial + $impuesto + $contraentrega;//-->
	  }
	  else{
		$total = $resultado_parcial + $impuesto;
		}
		//FORMULA POR VOLUMEN
		 $volumen = ($largo*$ancho*$alto*$cajas)/2500;//-->
		 $volumen_aprox = ceil($volumen);
		 $aux2 = $volumen_aprox - 1;
		  if($volumen_aprox >= 21){
		  $resultado_parcial2 = $volumen_aprox * $super_ex_21kg;
		
		}
		else{
		$resultado_parcial2 = str_replace(",", "", $super_ex_paquetes_20kg) + ($aux2 * str_replace(",", "", $super_ex_paquetes_20kg_ka));
		}
		 
	 
	if($valor_declarado <=  200000){
		$impuesto2 = 2000;
		}else{
		$impuesto2 = $valor_declarado * 0.01;
		}	
	 if($forma_pago == "Contraentrega"){
	   $contraentrega = 3150;
	   $total2 = $resultado_parcial2 + $impuesto2 + $contraentrega;
	  }else{
	   $total2 = $resultado_parcial2 + $impuesto2;
	 }
	 	
	 if($total>$total2){

	 	if($kilos_aprox >= 21){

	 		echo "<label >Primer Kilo: $".number_format(0)."</label><br/>";
	 		echo "<label >kilo adicional: $".number_format($super_ex_21kg * $kilos_aprox)."</label><br/>";
	 		if($forma_pago == "Contraentrega"){
	 			echo "<label >Contraentrega: $".number_format($contraentrega)."</label><br/>";
	 		}
	 	}else{
	 		echo "<label >Primer Kilo: $".$super_ex_paquetes_20kg."</label><br/>";
	 		echo "<label >Kilo adicional: $".$super_ex_paquetes_20kg_ka * $aux1."</label><br/>";
	 		if($forma_pago == "Contraentrega"){
	 			echo "<label >Contraentrega: $".number_format($contraentrega)."</label><br/>";
	 		}
	 	}

	 	echo "<label >Manejo: $".number_format($impuesto)."</label><br/>";
	 	echo "<label >Total : $".number_format($total)."</label><br/>";
	 	echo '</br>';
	 	echo "<label >Peso real: ".$kilos_aprox."</label><br/>";
	 	echo "<label >Peso volumen: ".$volumen_aprox."</label><br/>";
	 }
	 else{

	 	if($volumen_aprox >= 21){
	 		echo "<label >Primer Kilo: $".number_format(0)."</label><br/>";
	 		echo "<label >kilo adicional: $".number_format($super_ex_21kg * $volumen_aprox)."</label><br/>";
	 		if($forma_pago == "Contraentrega"){
	 			echo "<label >Contraentrega: $".number_format($contraentrega)."</label><br/>";
	 		}
	 	}else{
	 		echo "<label >Primer Kilo: $".$super_ex_paquetes_20kg."</label><br/>";
	 		echo "<label >Kilo adicional: $".number_format(str_replace(",", "", $super_ex_paquetes_20kg_ka) * $aux2) ."</label><br/>";
	 		if($forma_pago == "Contraentrega"){
	 			echo "<label >Contraentrega: $".number_format($contraentrega)."</label><br/>";
	 		}
	 	}

	 	echo "<label >Manejo : $".number_format($impuesto2)."</label><br/>";
	 	echo "<label >Total : $".number_format($total2)."</label><br/>";
	 	echo '</br>';
	 	echo "<label >Peso real: ".$kilos_aprox."Kg</label><br/>";
	 	echo "<label >Peso volumen: ".$volumen_aprox."Kg</label><br/>";	 	
	 }
	}

	?> 