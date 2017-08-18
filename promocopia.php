<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu.php'); ?>

        <script>

            $(document).ready(function () {
                console.log("pantalla = " + screen.width);
                $("#bot_acumulakm, #bot_acumulakm2").mouseenter(function () {
                    var nav = navigator.userAgent.toLowerCase();
                    if (nav.indexOf("chrome") == -1) {
                        alert("Cliente Ultra esta optimizado para Google Chrome, para participar Inicia sesi�n en Chrome..");
                        window.location = "cliente-ultra.php";
                    }
                });
            });


//            function guardarUsuario() {
//                var clave_registro = document.formRegistro.clave_registro.value;
//                var confirmar_clave = document.formRegistro.confirmar_clave.value;
//                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//                elemento = document.getElementById("acepto");
//                if (document.formRegistro.Nombre.value.length == 0) {
//                    alert("Debe de completar el campo  de nombre");
//                    document.formRegistro.Nombre.focus()
//                    return false;
//                }
//                /*
//                 if (document.formRegistro.Apellidos.value.length == 0) {
//                 alert("Debe de completar el campo  de Apellidos");
//                 document.formRegistro.Apellidos.focus()
//                 return false;
//                 } else 
//                 */
//                if (document.formRegistro.nacimiento.value.length == 0) {
//                    alert("Debe de completar el campo  de fecha");
//                    document.formRegistro.nacimiento.focus()
//                    return false;
//                } else if (document.formRegistro.cedula.value.length == 0) {
//                    alert("Debe de completar el campo  de Cedula");
//                    document.formRegistro.cedula.focus()
//                    return false;
//                } else if (document.formRegistro.Telefono.value.length == 0) {
//                    alert("Debe de completar el campo  de Teléfono");
//                    document.formRegistro.Telefono.focus()
//                    return false;
//                } else if (document.formRegistro.clave_registro.value == 0) {
//                    alert("Debe de completar el campo  de clave");
//                    document.formRegistro.clave_registro.focus()
//                    return false;
//                } else if (clave_registro != confirmar_clave) {
//                    alert('Las claves no coinciden !');
//                    document.formRegistro.clave_registro.focus()
//                    return false;
//                } else if (!expr.test(document.formRegistro.Correo_Electronico.value)) {
//                    alert("La dirección de correo " + document.formRegistro.Correo_Electronico.value + " es incorrecta.");
//                    document.formRegistro.Correo_Electronico.focus()
//                    return false;
//                } else
//                if (!elemento.checked) {
//                    alert("Debe aceptar terminos y condiciones");
//                    return false;
//                } else if (document.formRegistro.ciudad.value == -1) {
//                    alert("Debe de completar el campo  ciudad");
//                    document.formRegistro.ciudad.focus()
//                    return false;
//                } else {
//                    document.formRegistro.action = "Model/guarda_usuario.php";
//                    document.formRegistro.submit()
//                }
//            }

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
                  height:100px;
              }
              #sliderc{
                  margin-top: -80px; 
                  margin-bottom: -100px;
                  height:80px; 
              }
            }    
        </style>
    </head>
    <body>
        <?php include('headerLan.html'); ?>

        <div class="theme-default">
            <div id="sliderc" >
                <img  class="ms" src="imgs/cliente_ultra/banner_2.jpg" >               
            </div>
        </div>
        <div id="slider-sombra"></div>




        <div id="mainint">
            <div class="untercioz2">
                <h2>Promociones</h2>
                <ul class="botconta" id="impromos2">
                    <li id="a1" style="cursor:pointer">                        
                        <img src="imgs/home/Banner-Inferior-l1.png" class="img_landingl2">                      
                    </li>
                    <li id="a2" style="cursor:pointer">
                        <img src="imgs/home/Banner-Inferior-l2.png" class="img_landingr2">
                        <!--onclick="validateNav2()" --> 
                    </li>
                </ul>                 
            </div>

            <div class="untercioz2 f2">
                <h2></h2>
                <ul class="botconta l"> 
                    <li class="mz2">                                 
                        <div id="clienteultrains2" >
                            <div class="modal-cireg2">
                                <p class="p1">Obtén más información llamando al</p>
                                <h9><b>313 222 71 31</b></h9>
                                <p class="p1">o habla con uno de nuestros</p>
                                <p class="p1">asesores en linea</p>
                                <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >
                                    <dl>

                                        <dt style="width:100%;clear:both;margin-top:-10px;text-align:center;height: 49px!important;">                                            

                                            <input id="chat" style="margin-right: 4px;" name="button"  type="button"  value="Chat aqui" class="ciregbot" />
                                            <br clear="all">
                                        </dt>
                                    </dl><br clear="all">
                                </form>
                            </div>
                        </div>
                        <!--fin Modal inscribete-->
                    </li>                   
                </ul>


            </div>  
            <table id="tbl_imagenes" >
                <thead>
                    <tr>
                        <th style="text-align: right;cursor: pointer;"><img id="imgs" src="imgs/cliente_ultra/Boton-Suscribete.jpg" class="imgpromo"></th>
                        <th style="text-align: center;cursor: pointer;"> <img id="imgr" src="imgs/cliente_ultra/botonrutasydestinos.png"  class="imgpromo"></th>
                        <th style="text-align: left;cursor: pointer;"><img id="imgb" src="imgs/cliente_ultra/nuestros-buses-btn.png" class="imgpromo"></th>
                    </tr>
                </thead>                    
            </table>
            
            <table id="tbl_imagenes2" style="display: none;">
                <thead>
                    <tr>
                        <th style="text-align: right;cursor: pointer;"><img id="imgs" src="imgs/cliente_ultra/Boton-Suscribete.jpg" class="imgpromo"></th>
                                           </tr>
                    <tr>
                        
                        <th style="text-align: center;cursor: pointer;"> <img id="imgr" src="imgs/cliente_ultra/botonrutasydestinos.png"  class="imgpromo"></th>
                        
                    </tr>
                    <tr>
                        
                        <th style="text-align: left;cursor: pointer;"><img id="imgb" src="imgs/cliente_ultra/nuestros-buses-btn.png" class="imgpromo"></th>
                    </tr>
                </thead>                    
            </table>

        </div>    

        <?php include('footerLan.html'); ?>
    </body>
</html>
