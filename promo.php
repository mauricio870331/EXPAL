<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Promo</title> 
        <link rel="icon" type="image/png" href="base/favicon.png" />
        <style>            
            #preloader {
                position: fixed;
                top:0; left:0;
                right:0; bottom:0;
                background: #000;
                z-index: 1001;
            }
            #loader {
                width: 130px;
                height: 130px;
                position: absolute;
                left:50%; top:50%;
                background: url(imgs/ajax/loading.gif) no-repeat center 0;
                margin:-50px 0 0 -50px;
            }
        </style>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/change.js"></script>
        <script>
            $(window).load(function () {
                $('#preloader').fadeOut('slow');                
            });

            $(document).ready(function () {
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-49907683-1', 'auto');
                ga('send', 'pageview');

                console.log(screen.width + ' ' + screen.height);
                if ((screen.width >= 1024) && (screen.height >= 768)) {
                    $("#estilo").attr("href", "resolucionescss/1366_768.css");
                    $(".ms2").css("display", "none");
                    $(".ms").css("display", "block");
                } else if ((screen.width >= 320) && (screen.height >= 534)) {
                    $("#estilo").attr("href", "resolucionescss/320_534.css");
                    $(".ms").css("display", "none");
                    $(".ms2").css("display", "block");
                } else {
//                    alert('Resolucion: Menos de 1024x768, a lo mejor es 800x600');
                    $("link[rel=stylesheet]:not(:first)").attr({href: "resolucionescss/1366_768.css"});
                }
            });
        </script> 

        <link id="estilo" rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div id="preloader">
            <div id="loader"></div>
        </div>
        <div id="info">
            <p>Obtén más información llamando al</p>
            <h3>313 222 71 31</h3>
            <p>o compra tus tiquetes en linea</p>
            <input id="chat" style="margin-right: 4px;" name="button"  type="button"  value="Aqui" class="ciregbot pointer" />
        </div>
        <div id="header">
            <a href="index.php" id="logo">
                <img src="base/logo1.png" class="headimg">
            </a>
        </div>
        <div id="main">
            <div><img  class="ms" src="imgs/cliente_ultra/banner_2.jpg" ></div>
            <div><img  class="ms2" src="imgs/cliente_ultra/Banner-Promocion-04mini.jpg" ></div>
            <div id="slider-sombra"></div>
            <div id="content">
                <h2>Promociones</h2>
                <div id="img1" class="pointer">
                    <img src="imgs/home/Banner-Inferior-l1.png" class="img_landingl2">
                </div>
                <div id="img2" class="pointer">
                    <img src="imgs/home/Banner-Inferior-l2.png" class="img_landingr2">
                </div>                
            </div>
            <div id="line"></div>

            <div id="cnt_img3">
                <div id="btn1" class="btnpromo pointer">
                    <img id="imgs" src="imgs/cliente_ultra/Boton-Suscribete.jpg" class="imgpromo">
                </div>
                <div id="btn2" class="btnpromo pointer">
                    <img id="imgr" src="imgs/cliente_ultra/botonrutasydestinos.png"  class="imgpromo">
                </div>
                <div id="btn3" class="btnpromo pointer">
                    <img id="imgb" src="imgs/cliente_ultra/nuestros-buses-btn.png" class="imgpromo">
                </div>
            </div>

        </div>
        <div id="foot">
            L&iacute;nea  Gratuita 
            <a href="tel:01 8000 936662">01 8000 936662</a>
            - Transportes Expreso Palmira S.A. 2016 &copy; Todos los derechos reservados.
            &nbsp;<img id="veritas" style="width:120px;margin-left: 10px; margin-bottom: -20px;margin-top: -20px;" src="img/logoveritas-01.jpg">
        </div>
    </body>
</html>