<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu4.php'); ?>        

        <script>
//            document.writeln(screen.width + " x " + screen.height)
            $(document).ready(function () {

                $('#carousel').bxSlider({
                    slideWidth: 200,
                    minSlides: 2,
                    maxSlides: 5,
                    slideMargin: 10
                });
            });


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
                /*
                 if (document.formRegistro.Apellidos.value.length == 0) {
                 alert("Debe de completar el campo  de Apellidos");
                 document.formRegistro.Apellidos.focus()
                 return false;
                 } else 
                 */
                if (document.formRegistro.nacimiento.value.length == 0) {
                    alert("Debe de completar el campo  de fecha");
                    document.formRegistro.nacimiento.focus()
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
                    document.formRegistro.action = "Model/guarda_usuario.php";
                    document.formRegistro.submit()
                }
            }

        </script>
        <style>
            .ms{
                width: 100% !important;
                height: 400px;
            }
            @media screen and (max-width:768px)	
            {	.ms {
                  width:60%;
                  margin: 80px auto;
                  height:170%;
              }
              #sliderc{
                  margin-top: -80px; 
                  margin-bottom: -100px;
                  height:80px; 
              }
            } 

            @media screen and (max-width:412px)	
            {	.ms {
                  width:60%;
                  margin: 80px auto;
                  height:140%;
              }
              #sliderc{
                  margin-top: -80px; 
                  margin-bottom: -100px;
                  height:80px; 
              }
            }

            @media screen and (max-width:360px)	
            {	.ms {
                  width:60%;
                  margin: 80px auto;
                  height:140%;
              }
              #sliderc{
                  margin-top: -80px; 
                  margin-bottom: -100px;
                  height:80px; 
              }
            }

            @media (max-width:340px)and (min-width: 320px)		
            {
                .ms {
                    width:60%;
                    margin: 80px auto;
                    height:140%;
                }
                #sliderc{
                    margin-top: -80px; 
                    margin-bottom: -100px;
                    height:95px; 
                } 
            }
        </style>
    </head>
    <body>
        <?php include('headerLan.html'); ?>

        <div class="theme-default">
            <div id="sliderc" >
                <img  class="ms" src="imgs/cliente_ultra/bannerlandingultra2.jpg" >               
            </div>
        </div>
        <div id="slider-sombra"></div>

        <div id="mainint">
            <div class="untercioz">
                <p class="ptitle">Ultra cupones los más grandes descuentos en tus marcas favoritas.</p>
                <!-- Elastislide Carousel -->
                <ul id="carousel" class="elastislide-list">
                    <li class="liresp">
                        <a id="img9" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">Una</p>
                                    <p class="desc d1">Bebida</p>
                                    <p class="desc d2">16 Oz.</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/subway.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="imgcaramelo" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/caramelo.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img6" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/ms.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img5" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">20%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/meyer.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img11" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">5%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/marden3.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img4" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/marden1.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img10" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">7%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/marden2.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>                    

                    <li class="liresp">
                        <a id="img1" class="nolink" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/billos.jpg" alt="image01"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img7" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">25%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/haus.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>


                    <li class="liresp">
                        <a id="img3" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/delrio.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>  

                    <li class="liresp">
                        <a id="img8" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/rollinfashion.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>

                    <li class="liresp">
                        <a id="img12" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">45%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/coi.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>
                    
                    <li class="liresp">
                        <a id="img13" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">25%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/epx.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li> 
                    
                    <li class="liresp">
                        <a id="imgcarnes" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/miscarnes.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>   
                    
                    
                    <li class="liresp">
                        <a id="imgversilia" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">10%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/versilia.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>  
                    
                    
                    <li class="liresp">
                        <a id="imgukumari" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">15%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/ukumari.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>  
                    
                    
                     <li class="liresp">
                        <a id="imgdorado" data-toggle="modal" data-target="#myModal">
                            <div class="img_thumb">
                                <div class="img_desc">
                                    <p class="percent">20%</p>
                                    <p class="desc d3">Descuento</p>
                                    <p class="desc d2">Mas Info</p>
                                </div>
                                <img  src="imgs/slideslandingUltra/dorado.jpg" alt="image02"/>
                            </div>
                        </a>
                    </li>  
                    
                    
                    
                    
                </ul>
                <!-- End Elastislide Carousel -->              

            </div>

            <div class="untercioz f2">
                <h2></h2>
                <ul class="botconta l"> 
                    <li class="mz2">  
                        <a href="cliente-ultra.php" >
                            <img src="imgs/cliente_ultra/btnultraal.jpg" class="img_landingbtnL">
                        </a><!--onclick="validateNav2()" -->                         
                        <!--Modal inscribete-->
                        <div id="clienteultrains2" >
                            <div class="modal-cireg3">
                                <h3 class="formt">Inscríbete gratis como <b>Cliente Ultra</b> y accede a descargar tus cupones de descuento</h3>
                                <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >
                                    <dl>                                                                                <dt>Nombre</dt>		<dd><input type="text" name="Nombre" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>C&eacute;dula</dt>	<dd><input type="text" name="cedula" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Tel&eacute;fono</dt><dd><input type="text" name="Telefono" value="" size="20" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Correo Electr&oacute;nico</dt><dd>
                                            <input id="correo" type="text" name="Correo_Electronico" value="" size="40" class="f" aria-invalid="false" placeholder="" width="70"/>
                                            <img id="loading" src="imgs/ajax/loading.gif" width="25" style="display: none;"/>
                                        </dd>
                                        <dt>Fecha de nacimiento</dt>	<dd><input type="date" name="nacimiento" id="nacimiento" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Clave (8 Digitos)</dt><dd><input type="text" name="clave_registro" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>
                                        <dt>Confirmar Clave</dt><dd><input type="text" name="confirmar_clave" value="" size="40" class="f" aria-invalid="false" placeholder="" /></dd>                                        
                                        <dt>Ciudad Residencia</dt><dd>
                                            <select  name="ciudad" id="ciudad" class="f">
                                                <option value="-1">Seleccione</option>
                                                <option>ARMENIA</option>
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
                                        <dt>Sexo</dt>
                                        <dd><select  class="f" name="sexo">
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                            </select>
                                        </dd>
                                        <dt style="width:100%;background:#FCE700;clear:both;margin-top:0px;text-align:center;">
                                            <input style="margin-left: 3px;" type="checkbox" name="acepto" id="acepto"  />
                                            <a href="Politica_de_tratamiento_de_Datos.pdf" target="_blank" style="font-size:11px;color:#0e9400;">
                                                He leido y acepto la Pol&iacute;tica de tratamiento de datos. </a> &nbsp; &nbsp;
                                            <input name="lanPromo"  type="hidden"  value="1"/>
                                            <input name="opc"  type="hidden"  value="1"/>
                                            <input style="margin-right:3px;" name="button"  id="guardarUser" type="button"  value="Guardar" class="ciregbot"   onclick="guardarUsuario()"/>
                                            <br clear="all">
                                        </dt>
                                    </dl><br clear="all">
                                </form>
                            </div>
                        </div>
                        <!--fin Modal inscribete-->
                    </li>
                    <li class="mz2">
                        <a href="contacto.php">
                            <img src="imgs/cliente_ultra/btncontacto.jpg" class="img_landingbtnR">
                        </a><!--onclick="validateNav2()" --> 
                    </li>                   
                </ul>
            </div>            

        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog" id="modalD">
                <!-- Modal content-->
                <div class="modal-content mcontent">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="modal-title" class="modal-title"></h4>
                    </div>
                    <div class="modal-body modalLanding-heigth">
                        <div class="modalLanding mp" >
                            <img id="imgModal2"  />
                        </div>
                        <div class="modalLanding" >
                            <ul id="listap_lan">
                                <li id="li_p" class="lan_p"></li>
                                <li id="li_p2" class="lan_p2"></li>
                                <li id="li_p3" class="lan_p3"></li>
                                <li id="li_p4" class="lan_p4"></li>
                                <li id="li_p5" class="lan_p5">
                                    <a id="btndescargar" href="cliente-ultra.php?token=true" class="btnland">
                                        <b>Inicia Sesión</b>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-footer footerm">
                        <button type="button" class="btn btn-default btnfooter" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="infocupones">Ten en cuenta: para redimir los cupones debes llevar el cupón impreso junto con copia de tu cedula al establecimiento.</div>
        <?php include('footerLan.html'); ?>
    </body>
</html>

