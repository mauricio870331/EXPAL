 <?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");                           
  $sql = "SELECT d.nom_directorio, d2.nombre_doc, d2.fecha_creacion, d2.id_doc, d2.id_directorio FROM tbl_directorios d INNER JOIN  tbl_documentos d2
          ON d.id_directorio = d2.id_directorio ORDER BY nom_directorio";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)>0) { 
    while ($campo = mysql_fetch_row($resultado)){
      ?>
       <tr>
        <td><b><?php echo $campo[0] ?></b></td>
        <td><?php echo $campo[1] ?></td>   
        <td><?php echo $campo[2] ?></td>  
        <td>
          <a href="Model/downloadFiles.php?directorio=<?php echo $campo[4]; ?>&documento=<?php echo $campo[3]; ?>" target="_blank"><span title="Descargar Documento" style="font-size:15px;cursor:pointer;" class="fa fa-cloud-download"></span></a> | 

          <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#ConfirmDelete" title="Eliminar" onclick="setDirectorie(<?php echo $campo[4]; ?>,<?php echo $campo[3]; ?>)" ></span>
          </td>                             
      </tr>  
      <?php                                
    }
  }else{
    ?>
      <tr>
        <td colspan="4">
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>No hay resultados</strong>
          </div>
        </td>
      </tr>
    <?php
  }                            
?>         