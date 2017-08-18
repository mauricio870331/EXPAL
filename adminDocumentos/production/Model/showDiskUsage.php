<?php 
 include ("funciones_mysql.php");
 $totalUsado = 0;
 $classBar="progress-bar-success";
 $conexion = conectar("expresop_convenios");                           
 $sqlt = "SELECT sum(size_doc) FROM tbl_documentos";
 $resultado = ejecutar($sqlt,$conexion);
 if (mysql_num_rows($resultado)>0) { 
   if ($campo = mysql_fetch_row($resultado)){
      $bytes=$campo[0];
      $totalUsado_mb = $bytes / 1000000; 
    }
    $porcientoMegas = (round(number_format($totalUsado_mb, 5, '.',','))/500)*100 ;
    if ($porcientoMegas>=60 && $porcientoMegas<=80) {
      $classBar="progress-bar-warning";
    }
    if ($porcientoMegas>80) {
      $classBar="progress-bar-danger";
    }
 }
 ?>
<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">                 
Espacio total: gatos -- Usado: <?php  echo  round(number_format($totalUsado_mb, 5, '.',','))."Mb" ?>
<div class="progress" data-placement="bottom"  title="<?php echo 'Espacio del disco utilizado: '.$porcientoMegas.'%' ?>" data-toggle="tooltip">
    <div class="progress-bar <?php echo $classBar ?>" data-transitiongoal="20"></div>
</div>                  
</div>