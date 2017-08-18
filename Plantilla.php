<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu.php'); ?>
        <script>
            function guardarUsuario() {
                var clave_registro = document.formRegistro.clave_registro.value;
                var confirmar_clave = document.formRegistro.confirmar_clave.value;
                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                elemento = document.getElementById("acepto");
                if (document.formRegistro.Nombre.value.length == 0) {
                    alert("Debe de completar el campo  de nombre");
                    document.formRegistro.Nombre.focus()
                    return false;
                }

                if (document.formRegistro.nacimiento.value.length == 0) {
                    alert("Debe de completar el campo  de fecha");
                    document.formRegistro.nacimiento.focus()
                    return false;
                } else if (document.formRegistro.Apellidos.value.length == 0) {
                    alert("Debe de completar el campo  de Apellidos");
                    document.formRegistro.Apellidos.focus()
                    return false;
                } else if (document.formRegistro.cedula.value.length == 0) {
                    alert("Debe de completar el campo  de Cedula");
                    document.formRegistro.cedula.focus()
                    return false;
                } else if (document.formRegistro.Telefono.value.length == 0) {
                    alert("Debe de completar el campo  de Teléfono");
                    document.formRegistro.Telefono.focus()
                    return false;
                } else if (document.formRegistro.clave_registro.value == 0) {
                    alert("Debe de completar el campo  de clave");
                    document.formRegistro.clave_registro.focus()
                    return false;
                } else if (clave_registro != confirmar_clave) {
                    alert('Las claves no coinciden !');
                    document.formRegistro.clave_registro.focus()
                    return false;
                } else if (!expr.test(document.formRegistro.Correo_Electronico.value)) {
                    alert("La dirección de correo " + document.formRegistro.Correo_Electronico.value + " es incorrecta.");
                    document.formRegistro.Correo_Electronico.focus()
                    return false;
                } else
                if (!elemento.checked) {
                    alert("Debe aceptar terminos y condiciones");
                    return false;
                } else if (document.formRegistro.ciudad.value == -1) {
                    alert("Debe de completar el campo  ciudad");
                    document.formRegistro.ciudad.focus()
                    return false;
                } else {
                    document.formRegistro.action = "guarda_usuario.php";
                    document.formRegistro.submit()
                }
            }

            function iniciar() {
                document.inise.action = "validar.php";
                document.inise.submit();
            }
        </script>
    </head>
    <body>
<?php include('header.html'); ?>

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="imgs/cliente_ultra/Banner-Cliente-Ultra.jpg" >
                <img src="imgs/cliente_ultra/Banner-Cliente-Ultra-2.jpg" >
            </div>
        </div>
        <div id="slider-sombra"></div>


        <div id="mainint">
            <div class="untercio">
                <h2>CLIENTE ULTRA</h2>
                Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podr&aacute;s ir acumulando kilometraje que te har&aacute;n ganador de tiquetes sin costo.
            </div>
            <div class="dostercios">
                <ul class="botconta">
                    <li><a id="bot_clienteultra2" class="icobar" href="#clienteultrains"><h4>Inscr&iacute;bite</h4></a>
                        <!--Modal inscribete-->
                        <div id="clienteultrains">
                            <div class="close-clienteultrains cierramodal">X</div>
                            <div class="modal-cireg">
                                <h3>Suscríbete para recibir toda la informaci&oacute;n de <b>nuestros servicios, promociones, ofertas y descuentos</b></h3>
                                <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >
                                    <dl><dt>Nombre</dt>		<dd><input type="text" name="Nombre" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Apellidos</dt>	<dd><input type="text" name="Apellidos" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>C&eacute;dula</dt>	<dd><input type="text" name="cedula" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Tel&eacute;fono</dt><dd><select name="Tele" class="f" style="width:40%; float:left;"><option value="-1">Tipo</option><option value="-1">Fijo</option><option >Celular</option></select>
                                            <input type="text" name="Telefono" value="" size="20" class="f" style="width:40%; margin-left:5px" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Correo Electr&oacute;nico</dt>	<dd><input type="text" name="Correo_Electronico" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Fecha de nacimiento</dt>	<dd><input type="date" name="nacimiento" id="nacimiento" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Clave (8 Digitos)</dt>		<dd><input type="text" name="clave_registro" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Confirmar Clave</dt>		<dd><input type="text" name="confirmar_clave" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Ciudad Residencia</dt>		<dd>
                                            <select  name="ciudad" id="ciudad" class="f">
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
                                            </select></dd>
                                        <dt>Sexo</dt>				<dd><select  class="f" name="sexo"><option> Masculino </option><option>Femenino</option></select></dd>
                                        <dt style="width:50%">Digite los caracteres que aparecen: </dt>
                                        <dd><img style="height:30px !important; float:left;" src="img/captcha.png"/> &nbsp; &nbsp; 
                                            <input type="text" name="serie" value="" size="40" class="f" style="width:50px" aria-invalid="false" placeholder="" align="top" /></dd>
                                        <dt style="width:100%;background:#FCE700;clear:both;margin-top:30px;text-align:center;">
                                            &nbsp; <input type="checkbox" name="acepto" id="acepto"  /> Estoy de acuerdo con los T&eacute;rminos y Condiciones &nbsp; &nbsp; 
                                            <input name="button"  type="button"  value="Guardar" class="ciregbot"   onclick="guardarUsuario()"/>
                                            <br clear="all">
                                        </dt>
                                    </dl><br clear="all">
                                </form>
                            </div>
                        </div>
                        <!--fin Modal inscribete-->
                        <a id="clienteultratyc_a" href="#clienteultratyc" class="botoncu">T&eacute;rminos y condiciones</a>
                        <div id="clienteultratyc">
                            <div class="close-clienteultratyc cierramodal">X</div>
                            <div class="modal-teyco">
                                <iframe style="border-radius:5px;width:100%; height:400px;" src="terminos_cliente_ultra.html"></iframe>
                            </div>
                        </div>

                    <li><a href="#iniciosesionmodal" class="icobar" id="bot_acumulakm"><h4>Acumula kil&oacute;metros</h4></a>
                        <div id="iniciosesionmodal">
                            <div class="close-iniciosesionmodal cierramodal">X</div>
                            <div class="modal-inism">
                                <div id="areasesion1">
                                    <h3>INICIO DE SESI&Oacute;N</h3>
                                    <form name="inise" id="inise" novalidate="novalidate" method="post" method="post" class="wpcf7-form" style="width:100%;">
                                        <dl><dt>C&eacute;dula</dt>	<dd><input id="login-username" type="text" name="cedula" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                            <dt>Contrase&ntilde;a</dt>	<dd><input id="login-password" type="text" name="clave" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                            <dt style="width:100%;background:#FCE700;text-align:center">
                                                <a href="javascript:veriniolv(2)"  id="olvido" style="color:#000000; text-decoration:none"> &iquest;Olvid&oacute; su contrase&ntilde;a?</a> &nbsp; &nbsp; &nbsp; &nbsp;
                                                <button class="" style="background:#005F28; color:#ffffff; padding:4px 16px; margin-top:3px;" type="button" onclick="iniciar()">Iniciar Sesi&oacute;n</button>
                                            </dt>
                                        </dl><br clear="all">
                                    </form> 
                                </div>
                                <div id="areasesion2">
                                    <h3>&iquest;Olvid&oacute; su clave?</h3>
                                    Digita tu n&uacute;mero de c&eacute;dula y te enviaremos un correo con el usuario y contrase&ntilde;a que registraste en la p&aacute;gina.
                                    <form id="valid-form" name="modal" method="post" action="envia_clave.php"  onSubmit="return onEnvia();">
                                        <input id="login-username" type="text" class="f" name="cedula_correo" id="cedula_modal" value="" placeholder="cedula" style="width:90%;margin:12px auto">
                                        <input type="submit" id="enviar_modal" class="btn btn-success"  value="Enviar" style="background:#005F28; color:#ffffff; padding:4px 16px; margin-top:3px;">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="botoncu">Ver Premios</a>
                </ul>
            </div>
        </div>











<?php include('footer.html'); ?>
    </body>
</html>
