<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu2.php'); ?>

    </head>
    <body>
        <?php include('header2.html'); ?>

        <div id="slider-sombra"></div>

        <div id="mainint2">
            <div class="statics">
                <h2>Estadisticas Cliente Ultra</h2>
                <br>    
                <form class="form-inline" role="form" action="" method="post">
                    <div class="form-group">
                        <label for="FecIni">Fecha Inicial</label>
                        <input type="date" class="form-control" id="fecIni" name="fecIni">
                    </div>

                    <div class="form-group">
                        <label for="email">Fecha Final</label>
                        <input type="date" class="form-control" id="fecFin" name="fecFin">
                    </div>

                    <button type="button" id="consultar" class="btn btn-default m" >Consultar</button>
                    <img id="loading" src="imgs/ajax/loading.gif" width="25" style="display: none;"/>
                </form>
                <br> 
                <div id="rs">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Ciudad</b></th>
                                <th><b>Cantidad</b></th>
                                <th><b>Redimen</b></th>
                            </tr>
                        </thead>                   
                        <tbody > 
                        </tbody>
                    </table>   
                </div>
            </div>


            <!-- inicio modal -->			
            <div id="myModalConfirmU" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button></p>
                            <h4 id="myModalLabel" class="modal-title" style="text-align:center;">Eliminar Cédula</b></h4>
                        </div>
                        <div class="modal-body">
                            <h3>Esta seguro de eliminar la Cédula?</h3>
                        </div>
                        <div class="modal-footer" style="background-color:#FFFF00!important;" >
                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1423651167494">
                                <div class="vc_col-sm-4 wpb_column vc_column_container"> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="si"  type="button"  value="Eliminar" class="btn btn-success"   onclick="DeleteUser()"/> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="no"  type="button"  value="Cancelar" class="btn btn-success"   data-dismiss="modal" /> 

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- fin modal -->	

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >

                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:78px;">Nombre</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Nombre" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:72px;">Apellidos</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Apellidos" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:88px;">Cédula</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="cedula" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>



                                <p>
                                    <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                        <p style="display:inline;margin-right:74px; ">Teléfono</p>
                                        <select name="Tele" style="display:inline;width:150px;height:40px;">
                                            <option value="-1">Seleccione</option>
                                            <option value="-1">Fijo</option>
                                            <option >Celular</option>
                                        </select> 
                                        <input style="display:inline!important;width:257px!important;" type="text" name="Telefono" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:8px;">Correo Electrónico</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Correo_Electronico" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:8px;">Fecha de nacimiento</p>
                                        <input style="display:inline!important;width:390px!important;" type="date" name="nacimiento" id="nacimiento" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>

                                <p>
                                    <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                        <p style="display:inline;margin-right:9px; " name="ciudades">Ciudad Residencia</p>
                                        <select  style="display:inline;width:260px;height:40px;" name="ciudad" id="ciudad" >
                                            <option value="-1">Seleccione</option>
                                            <option> ARMENIA </option>
                                            <option>BOGOT&#193</option>                                  
                                            <option>BUENAVENTURA</option>                            
                                            <option>BUGA</option>                                    
                                            <option>CAICEDONIA</option>                              
                                            <option>CALI</option>                                    
                                            <option>CARTAGO</option>                                 
                                            <option>CHINCHIN&#193</option>                              
                                            <option>GUACAR&#205</option>                                 
                                            <option>IBAGU&#201</option>                                  
                                            <option>MANIZALES</option>                               
                                            <option>MEDELL&#205N</option>                                
                                            <option>PALMIRA</option>                                 
                                            <option>PEREIRA</option>                                 
                                            <option>POPAY&#193N</option>                                 
                                            <option>SANTANDER DE QUILICHAO</option>                  
                                            <option>SEVILLA</option>                                 
                                            <option>TULU&#193</option>                                   
                                            <option>YUMBO</option>                                   
                                            <option>ZARZAL</option>  
                                            <option>OTRO</option>  
                                        </select>
                                    </span>
                                </p>

                                <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                    <p style="display:inline;margin-right:105px; ">Sexo</p>
                                    <select  style="display:inline;width:150px;height:40px;" name="sexo">
                                        <option> Masculino </option>                                             
                                        <option>Femenino</option>                                  
                                    </select>
                                    </select>
                                </span>
                                </p>
                                <input type="hidden" name="opc" value="2">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarUsuario()" >Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin Modal inscribete-->


        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
