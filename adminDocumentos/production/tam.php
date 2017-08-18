<?php

function listar_directorios_ruta($ruta) {
    $directorios = array();
    // abrir un directorio y listarlo recursivo 
    if (is_dir($ruta)) {
        if ($dh = opendir($ruta)) {
            $carpeta = @scandir($ruta);
            while (($file = readdir($dh)) !== false) {
                //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                //mostraría tanto archivos como directorios 
                //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);     
                if (is_dir($ruta . $file) && $file != "." && $file != "..") {
                    //solo si el archivo es un directorio, distinto que "." y ".."                 
                    $directorios[] = "../Documentos/" . $file . "/";
                    //listar_directorios_ruta($ruta . $file . "/"); 
                }
                /* if (is_file($ruta . $file) && $file!="." && $file!=".."){ 
                  //solo si el archivo es un directorio, distinto que "." y ".."
                  echo "<li>$file</li>";
                  //listar_directorios_ruta($ruta . $file . "/");
                  } */
            }
            closedir($dh);
        }
    } else {
        $directorios[] = "No es ruta valida";
    }
    return $directorios;
}

function getArchivosInRuta($array) {
    // abrir un directorio y listarlo recursivo 
    $tamanos = array();
    foreach ($array as $key => $ruta) {
        if (is_dir($ruta)) {
            if ($dh = opendir($ruta)) {
                $carpeta = @scandir($ruta);
                if (count($carpeta) > 2) {
                    while (($file = readdir($dh)) !== false) {
                        //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                        //mostraría tanto archivos como directorios 
                        //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);     
                        /* if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
                          //solo si el archivo es un directorio, distinto que "." y ".."
                          echo "<br>  -- $file/";
                          //listar_directorios_ruta($ruta . $file . "/");
                          } */
                        if (is_file($ruta . $file) && $file != "." && $file != "..") {
                            //solo si el archivo es un directorio, distinto que "." y ".."                 
                            $tamanos[]  =  filesize($ruta . $file);
                            //listar_directorios_ruta($ruta . $file . "/"); 
                        }
                    }

                    closedir($dh);
                } else {
                    //"<ul><li>El directorio esta vacio</li></ul>";
                }
            }
        } else {
            //"<br>No es ruta valida"; 
        }
    }

    return $tamanos;
}

$dir = listar_directorios_ruta("../Documentos/");

$tam = getArchivosInRuta($dir); 
print_r($dir);
echo "<br>";
print_r($tam);

/*foreach ($dir as $key => $value) {
    echo "<br>" . $value;
}*/
?>