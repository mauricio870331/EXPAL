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
        <?php include('header3.php'); ?>
        <div id="slider-sombra"></div>
        <div id="mainint">
            <div class="unterciom">
                <h2>Información de Proceso</h2>
                Para registrar tu tiquete digita la información del formulario, solo podrás registrar los tiquetes que coincidan con la cédula de tu usuario.
                <br><br>
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div style="
                             background-color:#005F28!important;
                             padding:2%!important;
                             color:white;
                             font-size:17px;
                             font-weight:bold;
                             ">Contacto Ultra</div>

                        <p style="text-align: left;">Tel: 664 46 89 ext. 124		
                            clientesultra@expresopalmira.com.co
                        </p> 
                    </div> 
                </div> 
                <div id="btnCuponesCont"> 
                    <!--if ($_SESSION['cod_usuario'] == '123456@') { ?>-->
                        <a href="Cupones.php" >
                            <img id="btnCupones" src="imgs/elastislide/ultracupones-boton.jpg">
                        </a>
                    <!--} ?>--> 
                </div>
            </div>
            <div class="dosterciosm">
                <h2>Registra tu tiquete</h2>

                <form id="form_3" action="Model/guarda_tiquetes.php" name="form_3" method="post"  role="form" class="form-horizontal">

                    <div class="form-group">
                        <label for="email">Fecha:</label>
                        <input  type="date" name="datepicker" id="datepicker"  class="form-control"   >
                    </div>
                    <div class="form-group">
                        <label  for="pwd">Nro Tiquete:</label>
                        <input type="text" class="form-control" id="pwd" name="tiquete">
                    </div>
                    <!--<div class="form-group">
                      <label  for="sercode">Servicio:</label>
                      <input type="text" class="form-control" id="sercode" name="sercode">
                    </div>-->
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
                    <input type="hidden" name="verificar" value="S" />
                    <br/>
                    <div class="form-group">
                        <center>
                            <div class="wpb_text_column wpb_content_element ">
                                <button 
                                    class="btn btn-primary btn-lg" 
                                    style="background: linear-gradient( to bottom, #ffff00,#ffff00);
                                    display:block;margin:auto;padding: 9px 9px;font-size:15px;color:black;"
                                    type="submit" onclick="return Validacion2()"><!-- va ahi data-target=".conditions_termns_modal" data-target=".bs-example-modal-lg-pqrs" -->
                                    <b>Registrar</b></button>	
                            </div>
                        </center>
                    </div>
                </form>

            </div>

            <!--Modal inscribete-->
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
