<!DOCTYPE html>
<html>
<head><title>Expreso Palmira - Rutas y Destinos</title>
<meta name="description" content="Encuentra aqui informacion de las rutas y destinos que ofrece Expreso Palmira para ti">
<?php include('inclu.php'); ?>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.html'); ?>


<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<div id="mainint">
	<br><br><h2>Rutas y destinos</h2>
	
	<div class="container">
			<div class="col-sm-2" >
				<h3>Origen</h3>
				<form method='POST' name="SignupForm" action="">
<?php 
   $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'http://190.85.141.28:6530/expal/cargarComboRutas.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch) or die (curl_error ($ch));
    curl_close($ch);
    $array = json_decode($output, true) ;  
	?>

					<div class="list-group">
						<select class="form-control" name="origen">
							<option value="1">Selecciona...</option>
				<?php	?>	<option value="<?php echo $_SESSION['origen'] ?>" selected="selected"><?php echo $_SESSION['origen'] ?></option>
				<?php   for($i=0;$i<count($array);$i++)	{	?><option value='<?php echo $array[$i] ?>'><?php echo $array[$i] ?></option><?php   }	?>	    
					  </select>     
					</div> 
	        
					<h3>Destino</h3>
					<div id="direcciones" class="form-group">
						<select class="form-control" name="destino">
							<option value="1">Selecciona...</option>
			   	<?php    ?> <option value="<?php echo $_SESSION['destino'] ?>" selected="selected"><?php echo $_SESSION['destino'] ?></option>
			    <?php for($i=0;$i<count($array);$i++)	{	?> 
					 		<option value='<?php echo $array[$i]; ?>'><?php echo $array[$i]; ?></option>
				<?php    }   ?>	
	          			</select>
					</div>
					<br/><br/>
					<div id="Buscar" class="form-group"><button type="submit" class="btn btn-success" onclick="return Validacion()">Cargar</button></div>
				</form>
			</div>
			
			<div class="col-sm-7" >
				<h3>Tarifas</h3>
				<div id="texto_rutas_final">

<?php
$origen=$_POST[origen];
$destino=$_POST[destino];
$fecha=$_POST[datepicker];
$Hora=$_POST[hora];

$porciones = explode(":",  $Hora);
if($origen=='')	{	$origen='Cali';	}
if($destino==''){	$destino='Bogota';}
$time = time();
if($fecha=='')	{	$fecha= date("Y-m-d", $time);	}
if(count($porciones)<=1)	{	$horaF = date("H:i:s", $time);	}else{	$horaF=$Hora.":00";	}
 echo '
    <h5>Origen:'.$origen." - Destino:".$destino.'</h5>';
/*   if($origen=='Cali'){$origen='7600101';}elseif($origen=='Bogotá'){	$origen='1100101';}elseif($origen=='Buga'){	$origen='7611101';}elseif($origen=='Ibagué'){$origen='7300101';}
elseif($origen=='Manizales'){	$origen='1700101';}elseif($origen=='Palmira'){	$origen='7652001';}elseif($origen=='Pereira'){	$origen='6600101';}elseif($origen=='Sevilla'){$origen='7673601';}
elseif($origen=='Tuluá'){	$origen='7683401';}elseif($origen=='Armenia'){	$origen='6300101';}

if($destino==''){	$destino='1700101';}elseif($destino=='Cali'){	$destino='7600101';}elseif($destino=='Bogotá'){	$destino='1100101';}elseif($destino=='Buga'){$destino='7611101';}
elseif($destino=='Ibagué'){	$destino='7300101';}elseif($destino=='Manizales'){	$destino='1700101';}elseif($destino=='Palmira'){	$destino='7652001';}elseif($destino=='Pereira')
{$destino='6600101';}elseif($destino=='Sevilla'){	$destino='7673601';}elseif($destino=='Tuluá'){	$destino='7683401';}*/

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'http://190.85.141.28:6530/expal/consultaRutas.php?param2='.trim($_SESSION['origen']).'&param3='.trim($_SESSION['destino']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch) or die (curl_error ($ch));
    curl_close($ch);
    $array = json_decode($output, true) ;  
    if (count($array)==1){
 	 ?>
        				<table class="table table-fixed">	       
		    			<div class="alert alert-info"><b><?php echo $array[0]["observaciones"] ?></b></div>	 
						</table>
	 <?php 
    }else{
	    $new_tiquete = '';
	    echo '<table class="table table-fixed"">';
	    echo '<tr>	      
	    <td ><b>Servicio</b></td>
	    <td ><b>Hora</b></td >
	    <td ><b>Tarifa</b></td>
	    <td ><b>Observaciones</b></td>
	    </tr>';
	    for($i=0;$i<count($array);$i++){
	      echo '<tr>';	      
	      echo '<td>'.$array[$i]["servicio"].'</td>';
	      echo '<td>'.$array[$i]["horario"].'</td>';      
	      echo '<td>'.'$ '.number_format($array[$i]["precio"]).'</td>';
	      echo '<td>'.$array[$i]["observaciones"].'</td>'; 
	      echo '</tr>';
	    }
	    echo '</table>';
    }

?>
  
				</div>
			</div>
       		
			<div class="col-sm-3" >
				<center>
					<h3>Mapa</h3>   
					<?php echo $gm->MapHolder(); ?>
					<?php echo $gm->InitJs(); ?>
					<?php echo $gm->UnloadMap(); ?>  
					</center>       
    		</div>

			<div class="col-sm-3" style="font-size:12px;text-align: justify;padding-top:20px;">*Tarifas y horarios sujetos  a cambios  sin previo aviso  o a variaciones  en los precios  de acuerdo a la disponibilidad de sillas.</div>
	</div>
</div>

<?php include('footer.html'); ?>
</body>
</html>
