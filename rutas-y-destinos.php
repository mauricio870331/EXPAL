<?php
session_start();
require'EasyGoogleMap.class.php';
require'helperGoogleMaps.php';
$_SESSION["ori"] = $origen;
$_SESSION["des"] = $destino;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">
        <?php include('inclu.php'); ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                //document.getElementById('ver').style.display = 'none';
                //$("#datepicker").datepicker();
                var ori =<?php echo "'" . $_SESSION["ori"] . "'"; ?>;
                var des =<?php echo "'" . $_SESSION["des"] . "'" ?>;

                if (ori == '') {
                    ori = 'Terminal de Transporte, Cali - Valle del Cauca, Colombia';
                } else {
                    ori =<?php echo "'" . $_SESSION["ori"] . "'" ?>;
                }

                if (des == '') {
                    des = 'Terminal de transporte, Ciudad Salitre, Bogotá - Bogotá D.C., Colombia';
                } else {
                    des =<?php echo "'" . $_SESSION["des"] . "'" ?>;
                }
                bajarRuta(ori, des);                 
            });
        </script>
    </head>
    <?php echo $gm->GmapsKey(); ?>
    <body>
        <?php include('header.html'); ?>
        <div id="slider-sombra"></div>
        <div id="mainint2">
            <div class="unterciom3" style="margin-left: 30px!important;">
                <h2>Rutas y Destinos</h2>              
                <h3>Origen</h3>
                <form method='POST' name="SignupForm" action="">
                    <?php
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://190.85.141.28:6530/expal/cargarComboRutas.php');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($ch) or die(curl_error($ch));
                    curl_close($ch);
                    $array = json_decode($output, true);
                    ?>
                    <div class="list-group">
                        <select class="form-control" name="origen">
                            <option value="1">Selecciona...</option>
                            <?php ?>
                            <option value="<?php echo $_SESSION['origen'] ?>" selected="selected"><?php echo $_SESSION['origen'] ?></option>
                            <?php
                            for ($i = 0; $i < count($array); $i++) {
                                ?> 
                                <option value='<?php echo $array[$i] ?>'><?php echo $array[$i] ?></option>
                                <?php
                            }
                            ?>    
                        </select>     
                    </div> 
                    <h3>Destino</h3>
                    <div id="direcciones" class="form-group">
                        <select class="form-control" name="destino" onchange="this.form.submit()">
                            <option value="1">Selecciona...</option>
                            <?php ?>
                            <option value="<?php echo $_SESSION['destino'] ?>" selected="selected"><?php echo $_SESSION['destino'] ?></option>
                            <?php
                            for ($i = 0; $i < count($array); $i++) {
                                ?> 
                                <option value='<?php echo $array[$i]; ?>'><?php echo $array[$i]; ?></option>
                                <?php
                            }
                            ?>  
                        </select>
                    </div> 
                    <h3>Servicio</h3>
                    <div id="direcciones" class="form-group">
                        <select class="form-control" name="servicio" onchange="this.form.submit()">                          
                            <?php ?>
                            <option value="<?php echo $_SESSION['servicio'] ?>" selected="selected"><?php echo $_SESSION['servicio'] ?></option>
                            ?>
                            <!--<option value="DUPPLO PISO 1">DUPPLO PISO 1</option>
                            <option value="DUPPLO PISO 2">DUPPLO PISO 2</option>-->
                            <option value="ECO">ECO</option>
                            <option value="Mettro X">Mettro X</option>
                            <option value="Mettro">Mettro</option>
                            <option value="Mettro via Palmira">Mettro via Palmira</option>
                            <option value="Mettro Via Rozo">Mettro Via Rozo</option>
                            <option value="S26">S26</option>
                            <option value="S26 Maxxi">S26 Maxxi</option>
                            <option value="S26 Maxxi dupplo">S26 Maxxi dupplo</option>                           
                        </select>
                    </div>                   
                </form>
            </div>
            <div class="dosterciosm3">
                <center><h2>Tarifas</h2></center>
                <?php
                $origen = (isset($_POST['origen'])) ? $_POST['origen'] : "";
                $destino = (isset($_POST['destino'])) ? $_POST['destino'] : "";
                $servicio = (isset($_POST['servicio'])) ? $_POST['servicio'] : "Selecciona";

                if ($origen == '') {
                    $origen = 'Cali';
                }
                if ($destino == '') {
                    $destino = 'Bogota';
                }
                
                echo '<center><h5><b>Origen: ' . $origen . " - Destino: " . $destino . '</b></h5></center>';
                $ch = curl_init();
                $url = 'http://190.85.141.28:6530/expal/consultaRutas.php?param2=' . trim($_SESSION['origen']) . '&param3=' . trim($_SESSION['destino']). '&z='.str_replace(" ","*",$_SESSION['servicio']);
               
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch) or die(curl_error($ch));
                curl_close($ch);
                $array = json_decode($output, true);            
           
               
                if (count($array) == 1) {
                    ?>
                    <table class="table table-fixed">          
                        <div class="alert alert-info"><b><?php echo $array[0]["observaciones"] ?></b></div>  
                    </table>
                    <?php
                } else {
                    ?>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Servicio</b></th>
                                <th><b>Hora</b></th>
                                <th><b>Tarifa</b></th>
                                <th class="hidetd">Observaciones</th>                                
                            </tr>
                        </thead>                   
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($array); $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $array[$i]["servicio"]; ?></td>
                                    <td><?php echo $array[$i]["horario"]; ?></td>
                                    <td><?php echo '$ ' . number_format($array[$i]["precio"]); ?></td>
                                    <td class="hidetd"><?php echo $array[$i]["observaciones"]; ?></td>
                                </tr>  
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <div class="tresterciosm" >
                <h2>Mapa</h2>
                <center>  
                    <?php echo $gm->MapHolder(); ?>
                    <?php echo $gm->InitJs(); ?>
                    <?php echo $gm->UnloadMap(); ?> 
                    <div style="font-size:12px;text-align: justify;padding-top:20px;">* Tarifas y horarios sujetos  a cambios  sin previo aviso  o a variaciones  en los precios  de acuerdo a la disponibilidad de sillas.</div>
                </center>  
            </div>
        </div>        
        <?php include('footer.html'); ?>
    </body>
    <script >
        function bajarRuta(desde, hasta) {
            map.clearOverlays();
            obtenerRuta(desde, hasta);
        }

        function obtenerRuta(desde, hasta) {
            var gdir;
            gdir = null;
            if (hasta == 'Calle 53 53, Sevilla - Valle Del Cauca, Colombia') {
                hasta = 'Carrera 16 # 8-9, Caicedonia, Quindío, Colombia';
                gdir = new GDirections(map, document.getElementById("caminos"));
                gdir.load("from: " + desde + " to: " + hasta, {"locale": "es", "travelMode": G_TRAVEL_MODE_DRIVING, "preserveViewport": "true"});
                desde = 'Carrera 16 # 8-9, Caicedonia, Quindío, Colombia';
                hasta = 'Calle 53 53, Sevilla - Valle Del Cauca, Colombia';
            }
            if (hasta == 'Terminal De Transporte, Manizales - Caldas, Colombia') {
                hasta = 'Terminal De Transporte, Pereira - Risaralda, Colombia';
                gdir = new GDirections(map, document.getElementById("caminos"));
                gdir.load("from: " + desde + " to: " + hasta, {"locale": "es", "travelMode": G_TRAVEL_MODE_DRIVING, "preserveViewport": "true"});
                desde = 'Terminal De Transporte, Pereira - Risaralda, Colombia';
                hasta = 'Terminal De Transporte, Manizales - Caldas, Colombia';
            }
            gdir = new GDirections(map, document.getElementById("caminos"));
            gdir.load("from: " + desde + " to: " + hasta, {"locale": "es", "travelMode": G_TRAVEL_MODE_DRIVING, "preserveViewport": "true"});
            PonerMarca(hasta);
        }
        function PonerMarca(x) {
            var zoom = 7;
            var point2 = new GLatLng(3.916319, -75.249481);
            function addtag(point, address) {
                var marker = new GMarker(point, icon);
                GEvent.addListener(marker, "click", function () {
                    marker.openInfoWindowHtml(address);
                });
                return marker;
            }
            if (x == 'Terminal De Transporte, Armenia - Quindío, Colombia') {
                var point = new GLatLng(4.38000, -75.65000);
                var point2 = new GLatLng(4.300725, -74.80545);
                zoom = 8;
                var address = '<h4>BOGOTÁ - ARMENIA</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 4:00, 6:00, 8:00, 9:30, 10:30, 11:30<br><b>Tarde:</b> 12:30, 1:30, 2:30, 3:30, 4:30, 5:30<br><b>Noche:</b> 7:30, 8:15, 9:30, 10:45, 11:30<br><b>DISTANCIA:</b> 286 Kms<br><b>DURACIÓN Aprox:</b> 7 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal de transporte, Ciudad Salitre, Bogotá - Bogotá D.C., Colombia') {
                var point = new GLatLng(4.750000, -74.300000);
                var point2 = new GLatLng(4.300725, -74.899999);
                zoom = 8;
                var address = '<h4>ARMENIA - BOGOTÁ</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:00, 1:00, 7:00, 9:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:30, 4:00, 5:00, 6:30<br><b>Noche:</b> 8:00, 9:00, 10:00, 11:30<br><b>DISTANCIA:</b> 286 Kms<br><b>DURACIÓN Aprox:</b> 7 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal de Transporte, Cali - Valle del Cauca, Colombia') {
                var point = new GLatLng(3.365501, -76.421907);
                var point2 = new GLatLng(4.02001, -76.07224);
                zoom = 8;
                var address = '<h4>ARMENIA - CALI</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:30, 2:30, 3:15, 4:30, 5:45, 6:30, 11:00<br><b>Tarde:</b> 1:00, 3:00, 4:30, 5:30, 6:30<br><b>Noche:</b> 7:30, 8:30, 9:30, 10:30, 11:30<br><b>HORARIOS METRO</b><br><b>Mañana:</b> 5:30, 7:30, 8:30, 9:00, 10:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:00, 3:00, 3:30, 4:30, 5:30, 6:30<br><b>DISTANCIA:</b> 182 Kms<br><b>DURACIÓN Aprox:</b> 3 1/2 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Carrera 5 # 7-32, Buenaventura - Valle Del Cauca, Colombia') {
                var point = new GLatLng(3.609345, -77.000000);
                var point2 = new GLatLng(4.268355, -75.346127);
                zoom = 7;
                var address = '<h4>BUENAVENTURA - BOGOTÁ</h4><br><b>HORARIOS S26</b><br><b>Noche:</b>7:30<br>Empalme Cali.<br><b>DISTANCIA:</b> 518 Kms<br><b>DURACIÓN Aprox:</b> 11 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal De Transportes Buga, Buga - Valle Del Cauca, Colombia') {
                var point = new GLatLng(3.898851, -76.245900);
                var point2 = new GLatLng(4.32001, -76.07224);
                zoom = 9;
                var address = '<h4>ARMENIA - BUGA</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:30, 2:30, 3:15, 4:30, 5:45, 6:30, 11:00<br><b>Tarde:</b> 1:00, 3:00, 4:30, 5:30, 6:30<br><b>Noche:</b> 7:30, 8:30, 9:30, 10:30, 11:30<br><b>HORARIOS METRO</b><br><b>Mañana:</b> 5:30, 7:30, 8:30, 9:00, 10:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:00, 3:00, 3:30, 4:30, 5:30, 6:30<br><b>DISTANCIA:</b> 116 Kms<br><b>DURACIÓN Aprox:</b> 2 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Carrera 16 # 8-9, Caicedonia, Quindío, Colombia') {
                var point = new GLatLng(4.340000, -75.850000);
                var point2 = new GLatLng(4.409000, -75.75000);
                zoom = 11;
                var address = '<h4>ARMENIA - CAICEDONIA</h4><br><b>HORARIOS METRO</b><br><b>Desde:</b> 6:00a.m. a 6:00p.m. cada 1 hora.<br><b>DISTANCIA:</b> 25 Kms<br><b>DURACIÓN Aprox:</b> 1 Hora';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Carrera 3E # 3-1, Cartago - Valle Del Cauca, Colombia') {
                var point = new GLatLng(4.754415, -75.779606);
                var point2 = new GLatLng(4.068042, -76.128126);
                zoom = 8;
                var address = '<h4>CALI - CARTAGO</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 5:15, 7:15, 8:45, 10:15, 11:45<br><b>Tarde:</b> 1:15, 2:45, 4:15, 5:45<br><b>HORARIO ELITE MILENIO</b><br><b>Mañana:</b> 6:00, 10:00<br><b>Tarde:</b> 2:00, 5:00<br><b>DISTANCIA:</b> 99 Kms<br><b>DURACIÓN Aprox:</b> 3 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Carrera 8 # 3, Guacarí - Valle Del Cauca, Colombia') {
                var point = new GLatLng(3.766667, -76.393333);
                var point2 = new GLatLng(3.586795, -76.304025);
                zoom = 10;
                var address = '<h4>CALI - GUACARÍ</h4><br><b>HORARIOS METRO</b><br><b>Tarde:</b> 6:00<br><b>DISTANCIA:</b> 58 Kms<br><b>DURACIÓN Aprox:</b> 1 Hora';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal De Transporte, Ibagué - Tolima, Colombia') {
                var point = new GLatLng(4.488355, -75.256127);
                var point2 = new GLatLng(4.46915, -75.452979);
                zoom = 10;
                var address = '<h4>ARMENIA - IBAGUÉ</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:00, 1:00, 7:00, 9:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:30, 4:00, 5:00, 6:30<br><b>Noche:</b> 8:00, 9:00, 10:00, 11:30<br><b>DISTANCIA:</b> 97 Kms<br><b>DURACIÓN Aprox:</b> 3 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal De Transporte, Manizales - Caldas, Colombia') {
                var point = new GLatLng(4.997769, -75.506544);
                var point2 = new GLatLng(4.907769, -75.506544);
                zoom = 9;
                var address = '<h4>ARMENIA - MANIZALES</h4><br><b>HORARIOS METRO</b><br><b>Desde:</b> 7:20a.m a 6:20p.m cada 1 hora.<br><b>DISTANCIA:</b> 85 Kms<br><b>DURACIÓN Aprox:</b> 2 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Cinemas Terminal Del Sur, Medellín - Antioquia, Colombia') {
                var point = new GLatLng(6.216002, -75.506981);
                var point2 = new GLatLng(4.808055, -75.693278);
                var address = '<h4>CALI - MEDELLÍN</h4><br><b>HORARIOS S26</b><br><b>Noche:</b> 8:30, 10:00<br><b>DISTANCIA:</b> 428 Kms<br><b>DURACIÓN Aprox:</b> 8 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Calle 42 # 28-37, Palmira - Valle Del Cauca, Colombia') {
                var point = new GLatLng(3.506795, -76.504025);
                var point2 = new GLatLng(4.02001, -76.07224);
                zoom = 8;
                var address = '<h4>ARMENIA - PALMIRA</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:30, 2:30, 3:15, 4:30, 5:45, 6:30, 11:00<br><b>Tarde:</b> 1:00, 3:00, 4:30, 5:30, 6:30<br><b>Noche:</b> 7:30, 8:30, 9:30, 10:30, 11:30<br><b>HORARIOS METRO</b><br><b>Mañana:</b> 5:30, 7:30, 8:30, 9:00, 10:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:00, 3:00, 3:30, 4:30, 5:30, 6:30<br><b>DISTANCIA:</b> 160 Kms<br><b>DURACIÓN Aprox:</b> 3 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal De Transporte, Pereira - Risaralda, Colombia') {
                var point = new GLatLng(4.788055, -75.653278);
                var point2 = new GLatLng(4.728055, -75.643278);
                zoom = 10;
                var address = '<h4>ARMENIA - PEREIRA</h4><br><b>HORARIOS METRO</b><br><b>Desde:</b> 7:20a.m a 6:20p.m cada 1 hora.<br><b>DISTANCIA:</b> 51 Kms<br><b>DURACIÓN Aprox:</b> 1 Hora';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Terminal De Popayán - Cauca, Colombia') {
                var point = new GLatLng(2.447734, -76.71144);
                var point2 = new GLatLng(3.016667, -76.483333);
                zoom = 8;
                var address = '<h4>CALI - POPAYAN</h4><br><b>HORARIOS ECO</b><br>Desde las 4:00am hasta las 7:00pm cada 12 min.<br><b>DISTANCIA:</b> 136 Kms<br><b>DURACIÓN Aprox:</b> 3 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Carrera 40 # 35, Tuluá - Valle Del Cauca, Colombia') {
                var point = new GLatLng(4.05, -76.128126);
                var point2 = new GLatLng(4.12001, -76.07224);
                zoom = 9;
                var address = '<h4>ARMENIA - TULUÁ</h4><br><b>HORARIOS S26</b><br><b>Mañana:</b> 0:30, 2:30, 3:15, 4:30, 5:45, 6:30, 11:00<br><b>Tarde:</b> 1:00, 3:00, 4:30, 5:30, 6:30<br><b>Noche:</b> 7:30, 8:30, 9:30, 10:30, 11:30<br><b>HORARIOS METRO</b><br><b>Mañana:</b> 5:30, 7:30, 8:30, 9:00, 10:00, 11:00<br><b>Tarde:</b> 12:00, 1:00, 2:00, 3:00, 3:30, 4:30, 5:30, 6:30<br><b>DISTANCIA:</b> 91 Kms<br><b>DURACIÓN Aprox:</b> 2 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            if (x == 'Calle 53 53, Sevilla - Valle Del Cauca, Colombia') {
                var point = new GLatLng(4.26639, -75.985319);
                var point2 = new GLatLng(4.400000, -75.77000);
                zoom = 10;
                var address = '<h4>ARMENIA - SEVILLA</h4><br><b>HORARIOS METRO</b><br><b>Desde:</b> 6:00a.m. a 6:00p.m. cada 1 hora.<br><b>DISTANCIA:</b> 58 Kms<br><b>DURACIÓN Aprox:</b> 2 Horas';
                var marker = addtag(point, address);
                map.addOverlay(marker);
            }
            //centrar mapa luego de la marca
            //map.setCenter(point,zoom);
            map.setZoom(zoom);
            map.panTo(point2);
        }
    </script>
</html>
