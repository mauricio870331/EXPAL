<!DOCTYPE html>
<html>
    <head><title>Expreso Palmira - Suscr&iacute;bete</title>
        <meta name="description" content="Somos la primera compa&amp;acuteia de trasporte terrestre de pasajeros del sur occidente y centro de Colombia. Creada el 17 de Marzo de 1956. Nuestra Política es prestar un servicio y atención a nuestros clientes que garantice la respuesta a sus necesidades de comodidad, seguridad y confiabilidad,">
        <?php include('inclu.php'); ?>
        <script>
            function guardarUsuario()
            {
                var clave_registro = document.formRegistro.clave_registro.value;
                var confirmar_clave = document.formRegistro.confirmar_clave.value;
                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                elemento = document.getElementById("acepto");
                if (document.formRegistro.nacimiento.value.length == 0) {
                    alert("Debe de completar el campo  de fecha");
                    document.formRegistro.nacimiento.focus();
                    return false;
                }
                if (document.formRegistro.Nombre.value.length == 0) {
                    alert("Debe de completar el campo  de nombre");
                    document.formRegistro.Nombre.focus();
                    return false;
                }
                if (document.formRegistro.Apellidos.value.length == 0) {
                    alert("Debe de completar el campo  de Apellidos");
                    document.formRegistro.Apellidos.focus();
                    return false;
                }
                if (document.formRegistro.cedula.value.length == 0) {
                    alert("Debe de completar el campo  de Cedula");
                    document.formRegistro.cedula.focus();
                    return false;
                }
                if (document.formRegistro.Telefono.value.length == 0) {
                    alert("Debe de completar el campo  de Teléfono");
                    document.formRegistro.Telefono.focus();
                    return false;
                }
                if (document.formRegistro.clave_registro.value == 0) {
                    alert("Debe de completar el campo  de clave");
                    document.formRegistro.clave_registro.focus();
                    return false;
                }
                if (clave_registro != confirmar_clave) {
                    alert('Las claves no coinciden !');
                    document.formRegistro.clave_registro.focus();
                    return false;
                }
                if (!expr.test(document.formRegistro.Correo_Electronico.value)) {
                    alert("La dirección de correo " + document.formRegistro.Correo_Electronico.value + " es incorrecta.");
                    document.formRegistro.Correo_Electronico.focus();
                    return false;
                }
                if (!elemento.checked) {
                    alert("Debe aceptar terminos y condiciones");
                    return false;
                }
                if (document.formRegistro.ciudad.value == -1) {
                    alert("Debe de completar el campo  ciudad");
                    document.formRegistro.ciudad.focus();
                    return false;
                }

                document.formRegistro.action = "Model/guarda_usuario.php";
                document.formRegistro.submit();
            }
        </script>
    </head>
    <body>
        <?php include('header.html'); ?>

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="imgs/home/ban01.jpg" >
                <img src="imgs/home/ban02.jpg" >
                <img src="imgs/home/ban03.jpg" >
            </div>
        </div>
        <div id="slider-sombra"></div>

        <div id="mainint">
            <h4 class="inscri">Suscr&iacute;bete para recibir toda la informaci&oacute;n de nuestros servicios, promociones, ofertas y descuentos.</h4>

            <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >

                <div class="unmedio">
                    <dl><dt>C&eacute;dula</dt>					<dd><input type="text" name="cedula" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Nombre</dt>							<dd><input type="text" name="Nombre" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Correo Electr&oacute;nico</dt>
                        <dd>
                            <input id="correo2" type="text" name="Correo_Electronico" value="" size="40" class="f" aria-invalid="false" placeholder="" />
                            <img id="loading" src="imgs/ajax/loading.gif" width="25" style="display: none;"/>
                        </dd>
                        <dt>Ciudad Residencia</dt>
                        <dd><select name="ciudad" id="ciudad" class="f">
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
                        <dt>Digite los caracteres que aparecen: <img style="height:30px!important;" src="imgs/captcha.png"/></dt>
                        <dd><input type="text" name="serie" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt><a id="termycond_a" href="#termycond">Clic aqu&iacute; para ver la pol&iacute;tica de tratamiento de datos.</a>
                            <div id="termycond">
                                <div class="close-termycond cierramodal">X</div>
                                <div class="modal-termycond">
                                    <h3>Pol&iacute;tica de Tratamiento de Datos</h3>
                                    Pol&iacute;tica de tratamiento de datos personales Mediante el diligenciamiento de este formulario, usted en calidad de titular(es) de la informaci&oacute;n, de manera libre, expresa, voluntaria e informada, 
                                    autoriza al organizado a recolectar, almacenar, utilizar, circular, suprimir y en general, a realizar cualquier otro tratamiento a los datos personales por usted suministrados, 
                                    para todos aquellos aspectos inherentes al presente concurso y/o actividad promocional, y cualquier otro relacionado con el desarrollo del objeto social principal del referida sociedad, 
                                    lo que implica el uso de los datos en actividades de mercadeo, promoci&oacute;n y de ser el caso, cuando la actividad comercial lo requiera, la transferencia de los mismos a un tercero (incluyendo terceros pa&iacute;ses), 
                                    bajo los par&aacute;metros de la ley 1581 de 2.012 y dem&aacute;s normatividad vigente que regule la materia. 
                                    En todo caso, el Organizador garantiza las condiciones de seguridad, privacidad y dem&aacute;s principios que impliquen el tratamiento de datos personales acorde con la legislaci&oacute;n aplicable. 
                                    Esta autorizaci&oacute;n se mantendr&aacute; por el tiempo de duraci&oacute;n del v&iacute;nculo o la prestaci&oacute;n del servicio y por el tiempo de duraci&oacute;n de la sociedad responsable, conforme lo establecido en sus estatutos. 
                                    <div align="center" style="border-top:1px solid #888888;padding:8px 0;margin:8px 0;"><button class="close-termycond"  type="button">Entiendo</button></div>
                                </div>
                            </div>
                        </dt>
                        <dt>Estoy de acuerdo con la pol&iacute;tica de tratamiento de datos. <input type="checkbox" name="acepto" id="acepto"  />
                        </dt>
                    </dl>
                </div>

                <div class="unmedio">
                    <dl><dt>Tel&eacute;fono</dt>			<dd><input type="text" name="Telefono" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Apellidos</dt>					<dd><input type="text" name="Apellidos" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Clave (8 Digitos)</dt>			<dd><input type="text" name="clave_registro" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Confirmar Clave</dt>			<dd><input type="text" name="confirmar_clave" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                        <dt>Sexo</dt>						<dd><select  class="f" name="sexo"><option> Masculino </option><option>Femenino</option></select></dd>
                        <dt>Fecha de nacimiento:</dt>		<dd><input type="date" name="nacimiento" id="nacimiento" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd> 
                        <dt><input style="background-color:#005F28!important;padding:5px!important;color:white!important;border-radius:4px;min-width:100px" name="button"  type="button"  value="Guardar" class="btn btn-success"   onclick="guardarUsuario()"/></dt>
                    </dl>
                    <input type="hidden" name="opc" value="1" />

                </div>
            </form> 
            <br clear="all"><br>

        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
