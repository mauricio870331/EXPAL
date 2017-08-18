<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Bogota");

$guia=$_POST['guia'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'http://190.85.141.28:5000/Servidor.Web/dominio/envios/EnEnvios/GetLog/'.$guia);
//curl_setopt($ch, CURLOPT_URL,'http://190.85.141.28:9500/server/dominio/envios/EnEnvios/GetLog/300');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch) or die (curl_error ($ch));
curl_close($ch);
$array = json_decode($output, true) ;  

if (count($array)>0) {
    ?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Estado</th>
        <th>Ciudad</th>
        <th>Fecha y Hora</th>
      </tr>
    </thead>
    <tbody>
    <?php
        for($i=0;$i<count($array);$i++){
    ?>
          <tr>
            <td><?php echo $array[$i]["estado"]; ?></td>
            <td><?php echo $array[$i]["nombrePoblacion"]; ?></td>
            <td><?php echo str_replace("T"," ",$array[$i]["fecha"]); ?></td>
          </tr> 
    <?php
       }
    ?>   
    </tbody>
   </table>
    <?php  
    $ch1 = curl_init();
      curl_setopt($ch1, CURLOPT_URL,'http://190.85.141.28:5000/Servidor.Web/dominio/lin/LILogisticaInversa/GetUrlImagen/?numero='.$guia); 
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($ch1);
      curl_close($ch1);
      $array = json_decode($output, true) ;  
      if ($array != ""){
        echo '<div id="imgDigital" onclick="action(\''.$array.'\');" class="alert alert-success" style="cursor:pointer;margin-bottom: -9px;margin-top: -9px" role="alert"><img style="width: 670px;display:block; margin:auto;"  SRC='.$array.'>
             </div><input type="hidden" href="#modalDigi" data-toggle="modal" id="digiClick" /> ';             
      }       
}else{
    echo 0;
} 



   




?>


