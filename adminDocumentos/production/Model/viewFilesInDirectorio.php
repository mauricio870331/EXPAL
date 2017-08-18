<?php
  $directorio = $_POST['directorio']; //"../../Documentos";//$_POST['directorio'];  
  
  function listar_directorios_ruta($ruta){ 
    $directorios = array();
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) {    	
      if ($dh = opendir($ruta)) { 
        $carpeta = @scandir($ruta); 
        if (count($carpeta) > 2){
           $objectDir = array();           
           while (($file = readdir($dh)) !== false) { 
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);     
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               $objectDir['ruta']= $ruta;
               $objectDir['nombre']= $file;
               $objectDir['tipo']= "dir";
               array_push($directorios,$objectDir);
               //solo si el archivo es un directorio, distinto que "." y ".."                 
               //echo "<li> $file/ &nbsp<i class='fa fa-folder-o'></i></li>"; 
               //listar_directorios_ruta($ruta . $file . "/"); 
            } 
            if (is_file($ruta . $file) && $file!="." && $file!=".."){
                $objectDir['ruta']= $ruta;
                $objectDir['nombre']= $file;
                $objectDir['tipo']= "file";
                array_push($directorios,$objectDir); 
               //solo si el archivo es un directorio, distinto que "." y ".."                 
               //echo "<li>$file &nbsp<i class='fa fa-file-o'></i></li>";  
               //listar_directorios_ruta($ruta . $file . "/"); 
            } 
          } 
          //echo "</ul>";
          closedir($dh);           
        }
      
      } 
   }else {
      echo "<br>No es ruta valida"; 
   }
   return $directorios;
}
echo "<span style='font-size:15px;cursor:pointer;' class='fa fa fa-folder-open'></span>&nbsp<b>". substr($directorio, 17)."<b>"; 
$directorios = listar_directorios_ruta($directorio."/");

if (count($directorios>0)) {
  echo "<ul>";
  foreach ($directorios as $key => $value) {
    if ($value['tipo']=="dir") {
      $icon="fa fa-folder-o";
    } else{
      $icon="fa fa-file-o";
    }
   echo "<li><i class='".$icon."'></i>&nbsp;&nbsp;".$value['nombre']."</li>";
  }
  echo "</ul>";
}
if (count($directorios)==0) {
 echo "<ul><li>El directorio esta vacio</li></ul>";
}



///print_r($directorios);
 
/*
Para eliminar carpeta si  importar su contenido
function eliminarDir($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        echo $archivos_carpeta;
 
        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }
 
    rmdir($carpeta);
}
*/



?>

