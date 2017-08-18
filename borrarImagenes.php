<?php
$path = 'Model/tempQR/*';     
$files = glob($path); // obtiene todos los archivos
$ficherosEliminados = 0;
foreach($files as $f){
   if (is_file($f)) {
     if (unlink($f) ){
         $ficherosEliminados++;
       }
     }
    //echo 'Model/tempQR/'.$f.'<br>';
}
//print "Eliminados : <strong>". $ficherosEliminados ."</strong>";
?>