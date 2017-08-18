<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include ("Model/funciones_mysql.php");
$conexion = conectar("expresop_vultra");
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
            <div class="unterciom2">
                <h2>Tiquetes Anulados</h2>
                <br>    
                <form name="AccionesTiquete" method="post" id="form_5">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Tiquete</b></th>                           
                                <th>Acciones <a class="myIcons" title="Nuevo"  data-toggle="modal" data-target="#myModalTiquetes" onclick="setNumTiquete(0, 'C')" ><i class="fa fa-plus-square"  ></i></a></th>
                            </tr>
                        </thead>                   
                        <tbody>
                            <?php
                            $kilom = 0;
                            $sqlt = "SELECT * FROM tbl_tiquetes_anulados";
                            $resultado = ejecutar($sqlt, $conexion);
                            while ($campo = mysql_fetch_row($resultado)) {
                                ?><tr>
                                    <td><?php echo $campo[0]; ?></td>                               
                                    <td><a class="myIcons" title="Seleccionar"  data-toggle="modal" data-target="#myModalTiquetes" onclick="setNumTiquete('<?php echo $campo[0]; ?>', 'U')" ><i class="fa fa-check-circle" ></i></a>
                                        | <a class="myIcons" title="Eliminar"  data-toggle="modal" data-target="#myModalConfirm" onclick="setNumTiquete('<?php echo $campo[0]; ?>', 'U')"><i class="fa fa-close" ></i></a>
                                    </td>
                                </tr>  
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>  
                </form>
            </div>
            <div class="dosterciosm2">
                <h2>Usuarios Anulados</h2>
                <br>
                <form name="AccionesUser" method="post" id="form_6">
                    <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Cèdula</b></th>                           
                                <th>Acciones <a class="myIcons" title="Nuevo"  data-toggle="modal" data-target="#myModalUser" onclick="setNumCedula(0, 'C')" ><i class="fa fa-plus-square"  ></i></a></th>
                            </tr>
                        </thead>                   
                        <tbody>
                            <?php
                            $sqlt = "SELECT * FROM tbl_users_anulados";
                            $resultado = ejecutar($sqlt, $conexion);
                            while ($campo = mysql_fetch_row($resultado)) {
                                ?><tr>
                                    <td><?php echo $campo[0]; ?></td>                               
                                    <td><a class="myIcons" title="Seleccionar" data-toggle="modal" data-target="#myModalUser" onclick="setNumCedula('<?php echo $campo[0]; ?>', 'U')" ><i class="fa fa-check-circle" ></i></a>
                                        | <a class="myIcons" title="Eliminar"  data-toggle="modal" data-target="#myModalConfirmU"  onclick="setNumCedula('<?php echo $campo[0]; ?>')" ><i class="fa fa-close" ></i></a>
                                    </td>
                                </tr>  
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>  
                </form>
            </div>

            <!-- inicio modal -->			
            <div id="myModalTiquetes" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button></p>
                            <h4 id="myModalLabel" class="modal-title" style="text-align:center;">Actualizar Tiquete</b></h4>
                        </div>
                        <div class="modal-body"><div class="wpcf7" id="wpcf7-f11443-p11059-o1" lang="es-ES" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form id="formUpdateT" name="formUpdateT" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >


                                    <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                            <p style="display:inline!important;width:20%!important;margin-right:72px;">Tiquete</p>
                                            <input style="display:inline!important;width:410px!important;" type="text" id="tiquete" name="tiquete" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                        </span>
                                    </p>
                                    <input style="display:inline!important;width:410px!important;" type="hidden" id="oldTiquete" name="oldTiquete" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    <input style="display:inline!important;width:410px!important;" type="hidden" id="opc" name="opc" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />

                                </form>


                            </div></div>
                        <div class="modal-footer" style="background-color:#FFFF00!important;" >

                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1423651167494">


                                <div class="vc_col-sm-2 wpb_column vc_column_container"> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="button"  type="button"  value="Guardar" class="btn btn-success"   onclick="UpdateTiquete()"/> 

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- fin modal -->

            <!-- inicio modal -->			
            <div id="myModalConfirm" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button></p>
                            <h4 id="myModalLabel" class="modal-title" style="text-align:center;">Eliminar Tiquete</b></h4>
                        </div>
                        <div class="modal-body">
                            <h3>Esta seguro de eliminar el tiquete?</h3>
                        </div>
                        <div class="modal-footer" style="background-color:#FFFF00!important;" >

                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1423651167494">

                                <div class="vc_col-sm-4 wpb_column vc_column_container"> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="si"  type="button"  value="Eliminar" class="btn btn-success"   onclick="DeleteTiquete()"/> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="no"  type="button"  value="Cancelar" class="btn btn-success"   data-dismiss="modal" /> 

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- fin modal -->	

            <!-- inicio modal -->			
            <div id="myModalUser" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button></p>
                            <h4 id="myModalLabel2" class="modal-title" style="text-align:center;">Actualizar Cédula</b></h4>
                        </div>
                        <div class="modal-body"><div class="wpcf7" id="wpcf7-f11443-p11059-o1" lang="es-ES" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form id="formUpdateC" name="formUpdateC" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >


                                    <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                            <p style="display:inline!important;width:20%!important;margin-right:72px;">Cédula</p>
                                            <input style="display:inline!important;width:410px!important;" type="text" id="cedula" name="cedula" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                        </span>
                                    </p>
                                    <input style="display:inline!important;width:410px!important;" type="hidden" id="oldcedula" name="oldcedula" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    <input style="display:inline!important;width:410px!important;" type="hidden" id="opc2" name="opc2" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />

                                </form>


                            </div></div>
                        <div class="modal-footer" style="background-color:#FFFF00!important;" >

                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1423651167494">


                                <div class="vc_col-sm-2 wpb_column vc_column_container"> 
                                    <input style="background-color:#005F28!important;padding:5px!important;color:white!important;" name="button"  type="button"  value="Guardar" class="btn btn-success"   onclick="UpdateUser()"/> 

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- fin modal -->


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
