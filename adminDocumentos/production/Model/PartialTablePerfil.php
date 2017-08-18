<?php 
  include ("funciones_mysql.php");
  $conexion = conectar("expresop_convenios");                           
  $sql = "SELECT * FROM  tbl_utemp  ORDER BY descripcion";
  $resultado = ejecutar($sql,$conexion);
  if (mysql_num_rows($resultado)>0) { 
    while ($campo = mysql_fetch_row($resultado)){
      ?>
       <tr>                                    
        <td><?php echo $campo[1] ?></td>                                       
        <td>   
        <a href="Model/partialPerfilDoc.php?token=<?php echo base64_encode($campo[0]); ?>&ping=<?php echo base64_encode($campo[1]); ?>"><span title="Asignar Documentos" style="font-size:15px;cursor:pointer;" class="fa fa-plus-circle"></span></a> | 
        <?php if ($campo[1]!="Admin") { ?>
        <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#ConfirmDelete" title="Eliminar Perfil" onclick="setPerfilToDelete(<?php echo $campo[0]; ?>)" ></span>
          </td>   
        <?php
              }
        ?> 
                                    
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