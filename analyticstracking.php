<script>
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

//para agrregar una nueva categoria guiarse con el siguiente codigi

        $('#btnCupones').on('click', function () {
            ga('send', 'event', 'cupones', 'click', 'AccionCupones');  //ga('comando', 'evento: click, blur, ect', 'categoria', 'accion texto')
        });


        $('#banner').on('click', function () {
            ga('send', 'event', 'inicioCupones', 'click', 'LandingCupones');  //ga('comando', 'evento: click, blur, ect', 'categoria', 'accion texto', etiqueta)
        });

        $('#guardarUser').on('click', function () {
            ga('send', 'event', 'userLanCupones', 'click', 'GuardarUsuariosLanding');  //ga('comando', 'evento: click, blur, ect', 'categoria', 'accion texto', etiqueta)
        });

     
       
        $('#btndescargar').on('click', function () {
            ga('send', 'event', 'descargarCupon', 'click', 'descargaCupon');  //ga('comando', 'evento: click, blur, ect', 'categoria', 'accion texto', etiqueta)
        });       
       


    });
</script>