 <?php 
  include ("funciones_mysql.php");  
  $conexion = conectar("expresop_convenios");                           
  $sql = "SELECT nom_directorio, ruta_directorio, id_directorio FROM tbl_directorios ORDER BY nom_directorio";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)>0) { 
    while ($campo = mysql_fetch_row($resultado)){
      ?>
       <tr>
        <td><?php echo $campo[0] ?></td>
        <td><?php echo $campo[1] ?></td>   
        <td>
        <a data-placement="bottom"  title="Crear Sub-Directorio" data-toggle="tooltip" href="Model/CrearSubdirectorios.php?token=<?php echo base64_encode($campo[2]); ?>&ping=<?php echo base64_encode($campo[0]); ?>"><span  style="font-size:15px;cursor:pointer;" class="fa fa-plus-square"></span></a> | 
         <a data-placement="bottom"  title="Subir Documento" data-toggle="tooltip"><span  style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#newDocument" onclick="setRuta('<?php echo $campo[1]; ?>')"  class="fa fa-cloud-upload"></span></a> | 
          <a data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip"><span style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#viewFiles" onclick="viewDirectorie('<?php echo $campo[1]; ?>')"  class="fa fa fa-eye"></span></a> | 

          <a data-placement="bottom"  title="Eliminar Directorio" data-toggle="tooltip"> <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#ConfirmDelete" onclick="setDirectorie(<?php echo $campo[2]; ?>)" ></span></a>
          </td>                             
      </tr>  
      <?php                                
    }
  }else{
    ?>
      <tr>
        <td colspan="3">
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>No hay directorios</strong>
          </div>
        </td>
      </tr>
    <?php
  }                            
?>         