<?php
include ("funciones_mysql.php");

$id = $_POST['id'];

 $conexion = conectar("expresop_convenios");  
                                                 
   $sql = "SELECT * FROM imagenesEP WHERE id = ".$id;

$resultado = ejecutar($sql,$conexion);                    
if (mysql_num_rows($resultado)>0) {                              
   if ($campo = mysql_fetch_row($resultado)){  
    ?>

    <form id="demo-form2" action="Model/updateImages.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">

       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_directorie">Ubicacion<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="radio" class="boton" name="opc" value="inicio" <?php echo ($campo[4]=='inicio') ? 'checked' : '' ; ?> > Inicio
        <input type="radio" class="boton" name="opc" value="promocion" <?php echo ($campo[4]=='promocion') ? 'checked' : '' ; ?> > Promociones
        <input type="radio" class="boton" name="opc" value="modalPromo" <?php echo ($campo[4]=='modalPromo') ? 'checked' : '' ; ?> > Modal Promo
        <input type="radio" class="boton" name="opc" value="slidePromos" <?php echo ($campo[4]=='slidePromo') ? 'checked' : '' ; ?> > Slide Promo
        </div>
      </div>  

       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_directorie">Posicion<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <input style="width: 45px;" id="number" name="number" type="number" min="0" max="10" step="1" value="<?php echo $campo[5] ?>" size="2">  
        <input type="hidden" name="upd" value="<?php echo $id; ?>">      
        </div>
      </div>  

      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary" onclick="redirect()">Cancelar</button>
          <button type="submit" class="btn btn-success" >Editar</button>                          
        </div>
      </div>

    </form>

    <?php     

   }
 }
?>


