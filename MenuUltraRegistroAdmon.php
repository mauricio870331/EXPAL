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

        <div id="mainint">
            <div class="unterciom">
                <h2>Información de Proceso</h2>
                <p style="text-align: justify;">Para Registrar un tiquete, Ingresa toda la informacion que aparecen en el formulario, puede consultar sus tiquete en la pestaña de mis tiquetes.</p>   


            </div>
            <div class="dosterciosm">
                <h2>Registrar Tiquete</h2>
                <form id="form_3" action="Model/guarda_tiquetes.php" name="form_3" method="post"  role="form" class="form-horizontal">

                    <div class="form-group">
                        <label for="email">Fecha:</label>
                        <input  type="date" name="datepicker" id="datepicker"  class="form-control"   >
                    </div>
                    <div class="form-group">
                        <label  for="pwd">Nro Tiquete:</label>
                        <input type="text" class="form-control" id="pwd" name="tiquete">
                    </div>
                    <div class="form-group">
                        <label for="email">Origen:</label>
                        <select class="form-control" name="origen"  >
                            <option value="0">----Origen----</option>

                            <option>ANDALUCIA</option>
                            <option>ARMENIA</option>
                            <option>BARCELONA</option>
                            <option>BOGOTA</option>
                            <option>BUENAVENTURA</option>
                            <option>BUGA</option>
                            <option>BUGALAGRANDE</option>
                            <option>CAICEDONIA</option>
                            <option>CALI</option>
                            <option>CARTAGO</option>
                            <option>CERRITO VALLE</option>
                            <option>CERRITOS R.</option>
                            <option>CHINCHINA</option>
                            <option>DOSQUEBRADAS</option>
                            <option>GUACARI</option>
                            <option>IBAGUE</option>
                            <option>LA PAILA</option>
                            <option>MANIZALES</option>
                            <option>MEDELLIN</option>
                            <option>OBANDO</option>
                            <option>PALMIRA</option>
                            <option>PEREIRA</option>
                            <option>SANTA ROSA</option>
                            <option>SEVILLA</option>
                            <option>TULUA</option>
                            <option>URIBE</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email">Destino:</label>
                        <select class="form-control" name="destino"  >
                            <option value="0">----Destino----</option>

                            <option>ANDALUCIA</option>
                            <option>ARMENIA</option>
                            <option>BARCELONA</option>
                            <option>BOGOTA</option>
                            <option>BUENAVENTURA</option>
                            <option>BUGA</option>
                            <option>BUGALAGRANDE</option>
                            <option>CAICEDONIA</option>
                            <option>CALI</option>
                            <option>CARTAGO</option>
                            <option>CERRITO VALLE</option>
                            <option>CERRITOS R.</option>
                            <option>CHINCHINA</option>
                            <option>DOSQUEBRADAS</option>
                            <option>GUACARI</option>
                            <option>IBAGUE</option>
                            <option>LA PAILA</option>
                            <option>MANIZALES</option>
                            <option>MEDELLIN</option>
                            <option>OBANDO</option>
                            <option>PALMIRA</option>
                            <option>PEREIRA</option>
                            <option>SANTA ROSA</option>
                            <option>SEVILLA</option>
                            <option>TULUA</option>
                            <option>URIBE</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label  for="pwd">Cédula:</label>
                        <input type="text" class="form-control" id="pwd" name="cedula">
                    </div>

                    <div class="form-group">
                        <label  for="pwd">Nombre Completo:</label>
                        <input type="text" class="form-control" id="pwd" name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="verificar">Verificar Nodum:</label>
                        <select class="form-control" name="verificar"  >
                            <option value="0">----Selccione----</option>        
                            <option value="S">Si</option>
                            <option value="N">No</option>

                        </select>

                    </div>
                    <br/>
                    <div class="form-group"><center>
                            <button type="submit" class="btn btn-success" onclick="return Validacion()">Registrar</button>    
                        </center></div>

                </form>
            </div>
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
