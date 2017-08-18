<!DOCTYPE html>
<html>
    <head><title>Expreso Palmira</title>
        <meta name="description" content="Somos la primera compa��a de trasporte terrestre de pasajeros del sur occidente y centro de Colombia. Creada el 17 de Marzo de 1956. Nuestra Poltica es prestar un servicio y atencin a nuestros clientes que garantice la respuesta a sus necesidades de comodidad, seguridad y confiabilidad,">
        <?php include('inclu.php'); ?>
        <script>
            // Get the modal

// Get the button that opens the modal


// When the user clicks on the button, open the modal 
            function showModal() {
                document.getElementById('myModal').style.display = "block";
            }

// When the user clicks on <span> (x), close the modal
            function hideModal() {
                document.getElementById('myModal').style.display = "none";
            }

// When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == document.getElementById('myModal')) {
                    document.getElementById('myModal').style.display = "none";
                }
            }
//             function validateNav2()
//            {
//                var nav = navigator.userAgent.toLowerCase();
//                if (nav.indexOf("chrome") != -1) {                  
//                     window.open('http://www.expresopalmira.com.co/ElTiqueteGanador/index.php', '_blank');
//                } else {
//                    alert("El Tiquete Ganador esta optimizado para Google Chrome, para participar ingresa desde el Navegador Google Chrome..");                   
//                }
//            }
        </script>
        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 10000; /* Sit on top */
                left: 0;
                top: 0;
                width:100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto; /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 28%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <?php
        include('header.html');
        include ("Model/funciones_mysql.php");
        $conexion = Conexion::conectar("expresop_convenios");
        $sql = "SELECT * FROM imagenesEP WHERE lugar = 'inicio' and estado = 1 order by posicion";

        $stmt = $conexion->prepare($sql);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
        ?>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php
                if ($numfilas > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $row->imagen; ?>">
                        <?php
                    }
                    $conexion = null;
                    $stmt = null;
                }
                ?>               
            </div>
        </div>
        <div id="slider-sombra"></div>


        <div id="mainwepa">
            <div id="central">
                <div class="pestas" id="divpestder">
                    <div id="pestder">
                        <a onclick="showModal()" id="wepa_gps">                         

                        </a>
                    </div>
                </div>

                <div class="pestas" id="divpestizq">
                    <div id="pestizq"><a href="http://expresopalmira.webhop.org:9997/VO" target="_blank" id="wepa_resertick"></a>
                    <a href="reserva_tiquete.php" id="wepa_chat"></a>
                    </div>

                </div>


                <ul class="botcen">
                    <li><a href="rutas-y-destinos.php" class="icobar" id="bot_rutasydestinos" style="height: 134px;"><h2>Rutas y destinos</h2></a>
                    <li><a href="inscribete_2.php" class="icobar" id="bot_suscribite" style="height: 134px;"><h2>Suscr&iacute;bete</h2></a>
                    <li class="bancen">
                        <div id="wepa_slider"> 
                            <a href="promociones.php?promo=0" ><img src="imgs/home/Banner-Inferior-Manizales_Armenia.jpg" style="height: 120px;"></a>
                            <a href="promociones.php?promo=4" ><img src="imgs/home/Banner-Inferior-pereira-armenia.png" style="height: 120px;"></a>
                            <a href="promociones.php?promo=1" ><img src="imgs/home/Banner-Inferior-bgmz.png" style="height: 120px;"></a>
                        </div>
                </ul>
                <ul class="botcen">
                    <li><a  href="cliente-ultra.php" class="icobar" id="bot_clienteultra" style="height: 134px;"><h2>Cliente Ultra</h2></a>
                    <li><a href="http://www.epexpress.co/" target="_blank" class="icobar" id="bot_enviosyencomientas" style="height: 134px;"><h2>Mensajería y Paquetes</h2></a>    
                    <!--<li class="bancen"><a  href="Ultracupones.php" ><img src="imgs/home/Boton-Ultra-Cupones.jpg" style="height: 109px;width: 100%;" id="banner"></a><!--onclick="validateNav2()" -->               
                    <li class="bancen"><a  href="http://expresopalmira.webhop.org:9997/VO" target="_blank" ><img src="imgs/home/Banner-Fijo.jpg" style="height: 109px;width: 100%;" id="banner"></a><!--onclick="validateNav2()" --> 
                </ul> 
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close "id="close" onclick="hideModal()">&times;</span>
                    <h4>Selecciona una página de rastreo:</h4>
                    <a style="color: #0E9400;" href="http://www.gps.com.co/seg_veh3/web/track.php?eid=EP" onclick="hideModal()" target="_blank">GPS</a>
                    <br>
                    <a style="color: #0E9400;" href="https://www.expresopalmira.com.co/TSO/Rastreo" onclick="hideModal()" target="_blank" >GPS Eje Cafetero</a>
                </div>
            </div>
        </div>
        <?php include('footer.html'); ?>
    </body>
</html>



