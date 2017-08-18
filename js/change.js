//para landing ultra
$(document).ready(function () {

    var target = null;
    $('.img_thumb').hover(function (e) {
        target = $(this);
        $(target[0].firstElementChild).fadeIn(200);
    }, function () {
        $(target[0].firstElementChild).fadeOut(200);
    });



    $("#img1").click(function () {
        $("#modal-title").html("Billos Comidas Rapidas");
        $("#imgModal2").attr("src", "imgs/imglanding/billos.png");
        $("#li_p").html("COMIDAS RÁPIDAS");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'https://es-la.facebook.com/COMIDAS-RAPIDAS-BILLOS-290809780929776/' target = '_blank' >Siguenos en facebook.</a>");
        $("#li_p3").html("10% de descuento en");
        $("#li_p4").html("hamburguesas y perros.");
    });


    $("#imgcaramelo").click(function () {
        $("#modal-title").html("CARAMELO TORTAS Y POSTRES");
        $("#imgModal2").attr("src", "imgs/imglanding/caramelo.png");
        $("#li_p").html("TORTAS Y POSTRES");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.caramelo.com.co' target = '_blank' >www.caramelo.com.co.</a>");
        $("#li_p3").html("10% de descuento en todos");
        $("#li_p4").html("los postres y ponqués.");
    });


    $("#img3").click(function () {
        $("#modal-title").html("APARTA HOTEL DEL RIO");
        $("#imgModal2").attr("src", "imgs/imglanding/delrio.png");
        $("#li_p").html("APARTA HOTEL DEL RIO");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.apartahoteldelrio.com' target = '_blank'>www.apartahoteldelrio.com.</a>");
        $("#li_p3").html("10% de descuento en");
        $("#li_p4").html("las habitaciones.");
    });


    $("#img4").click(function () {
        $("#modal-title").html("MARDEN");
        $("#imgModal2").attr("src", "imgs/imglanding/mardenpyo.png");
        $("#li_p").html("Papelería Marden");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.comercializadoramarden.com' target = '_blank'>www.comercializadoramarden.com.</a>");
        $("#li_p3").html("10% En productos de");
        $("#li_p4").html("oficina y papelería.");
    });


    $("#img10").click(function () {
        $("#modal-title").html("MARDEN");
        $("#imgModal2").attr("src", "imgs/imglanding/mardenpyj.png");
        $("#li_p").html("Papelería Marden");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.comercializadoramarden.com' target = '_blank'>www.comercializadoramarden.com.</a>");
        $("#li_p3").html("7% de descuento en");
        $("#li_p4").html("piñatería y fiesta.");
    });

    $("#img11").click(function () {
        $("#modal-title").html("MARDEN");
        $("#imgModal2").attr("src", "imgs/imglanding/mardenmyt.png");
        $("#li_p").html("Papelería Marden");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.comercializadoramarden.com' target = '_blank'>www.comercializadoramarden.com.</a>");
        $("#li_p3").html("5% de descuento en");
        $("#li_p4").html("muebles y tecnología.");
    });

    $("#img5").click(function () {
        $("#modal-title").html("MR SALNG MEYER CALI SAS");
        $("#imgModal2").attr("src", "imgs/imglanding/meye.png");
        $("#li_p").html("MR salng meyer");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.meyer.edu.co' target = '_blank'>www.meyer.edu.co.</a>");
        $("#li_p3").html("20% de descuento en");
        $("#li_p4").html("todos los cursos de inglés.");
    });

    $("#img6").click(function () {
        $("#modal-title").html("HOTELES MS");
        $("#imgModal2").attr("src", "imgs/imglanding/ms.png");
        $("#li_p").html("HOTELES MS");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.hotelesms.com' target = '_blank'>www.hotelesms.com.</a>");
        $("#li_p3").html("10% de descuento en");
        $("#li_p4").html("las habitaciones.");
    });


    $("#img7").click(function () {
        $("#modal-title").html("HAUS MUEBLES IMPORTADOS");
        $("#imgModal2").attr("src", "imgs/imglanding/jaus.png");
        $("#li_p").html("MUEBLES IMPORTADOS");
        $("#li_p2").html("");
        //<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.hauscolombia.com' target = '_blank'>www.hauscolombia.com.</a>
        $("#li_p3").html("25% de descuento en");
        $("#li_p4").html("todos los muebles.");
    });


    $("#img8").click(function () {
        $("#modal-title").html("ROLLING FASHION");
        $("#imgModal2").attr("src", "imgs/imglanding/rolling.png");
        $("#li_p").html("ROLLING FASHION");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.rollingfashion.com.co' target = '_blank'>www.rollingfashion.com.co.</a>");
        $("#li_p3").html("10% En prendas y");
        $("#li_p4").html("accesorios exhibidos.");
    });


    $("#img9").click(function () {
        $("#modal-title").html("SUBWAY");
        $("#imgModal2").attr("src", "imgs/imglanding/subway.png");
        $("#li_p").html("SUBWAY");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.subwaycolombia.com' target = '_blank'>www.subwaycolombia.com.</a>");
        $("#li_p3").html("Gratis bebida en");
        $("#li_p4").html("Vaso de 16 oz.");
    });


    $("#img12").click(function () {
        $("#modal-title").html("CENTRO DE ODONTOLOGIA INTEGRAL");
        $("#imgModal2").attr("src", "imgs/imglanding/coi.png");
        $("#li_p").html("COI");
        $("#li_p2").html("<a style = 'text-decoration:none;color:#0e9400;' href = 'http://www.odontologiacoi.com' target = '_blank'>www.odontologiacoi.com</a>");
        $("#li_p3").html("Hasta el 45% de descuento");
        $("#li_p4").html("en los tratamientos");
    });


    $("#img13").click(function () {
        $("#modal-title").html("MENSAJERÍA Y PAQUETES");
        $("#imgModal2").attr("src", "imgs/imglanding/epxpress.png");
        $("#li_p").html("EPEXPRESS");
        $("#li_p2").html("<a style='text-decoration:none;color:#0e9400;' href='http://www.epexpress.co' target='_blank'>www.epexpress.co</a>");
        $("#li_p3").html("25% de descuento para");
        $("#li_p4").html("envíos entre 1 y 5 kg.");
    });

    $("#imgcarnes").click(function () {
        $("#modal-title").html("MIS CARNES PARRILLA");
        $("#imgModal2").attr("src", "imgs/imglanding/mcp.png");
        $("#li_p").html("MIS CARNES PARRILLA");
        $("#li_p2").html("<a style='text-decoration:none;color:#0e9400;' href='http://www.miscarnesparrilla.com' target='_blank'>www.miscarnesparrilla.com</a>");
        $("#li_p3").html("10% de descuento en los");
        $("#li_p4").html("platos exhibidos en la carta.");
    });


    $("#imgversilia").click(function () {
        $("#modal-title").html("CALZADO VERSILIA");
        $("#imgModal2").attr("src", "imgs/imglanding/versilia.png");
        $("#li_p").html("CALZADO VERSILIA");
        $("#li_p2").html("<a style='text-decoration:none;color:#0e9400;' href='https://www.facebook.com/versiliaoficial/#' target='_blank'>@versiliaoficial</a>");
        $("#li_p3").html("10% de descuento en");
        $("#li_p4").html("todos los zapatos");
    });


    $("#imgukumari").click(function () {
        $("#modal-title").html("BIOPARQUE UKUMARI");
        $("#imgModal2").attr("src", "imgs/imglanding/ukumari.png");
        $("#li_p").html("BIOPARQUE UKUMARI");
        $("#li_p2").html("<a style='text-decoration:none;color:#0e9400;' href='http://www.ukumari.co/' target='_blank'>www.ukumari.co</a>");
        $("#li_p3").html("15% de descuento en los");
        $("#li_p4").html("pasaportes suricato y ceiba");
    });


    $("#imgdorado").click(function () {
        $("#modal-title").html("HOTEL DORADO GOLD");
        $("#imgModal2").attr("src", "imgs/imglanding/dorado.png");
        $("#li_p").html("HOTEL DORADO GOLD");
        $("#li_p2").html("<a style='text-decoration:none;color:#0e9400;' href='http://www.hotelesdoradogold.com' target='_blank'>www.hotelesdoradogold.como</a>");
        $("#li_p3").html("20% de descuento en las");
        $("#li_p4").html("phabitaciones");
    });


    $("#btndog").click(function () {
        $("#btnham").css('background-color', '#FCE700');
        $("#btndog").css('background-color', '#D4C94F');
        $("#btndog").data('p', 'perro');
        $("#btnham").data('p', '');
    });

    $("#btnham").click(function () {
        $("#btndog").css('background-color', '#FCE700');
        $("#btnham").css('background-color', '#D4C94F');
        $("#btndog").data('p', '');
        $("#btnham").data('p', 'hamburguesa');
    });


    //    $("#img1").mouseover(function () {
//        $("#img1").attr("src", "imgs/elastislide/small/20_off.png");
////        $("#img1").css("opacity", 0.3);
//    });
//    $("#img1").mouseout(function () {
//        $("#img1").attr("src", "imgs/elastislide/small/ADR.jpg");
////        $("#img1").css("opacity", 1);
////        $("#img1").fadeIn("slow");
//    });

    $("#correo").blur(function () {
        var parametros = {"mail": $(this).val()};
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (expr.test($(this).val())) {
            $.ajax({
                data: parametros,
                timeout: 10000,
                url: 'Model/verificarMail.php',
                type: 'post',
                beforeSend: function () {
                    $("#correo").css("width", "80%");
                    $("#loading").css("display", "inline-block");
                    $("#correo").val("verificando..");
                },
                success: function (response) {
                    $("#correo").css("width", "90%");
                    $("#loading").css("display", "none");
                    if (response == "") {
                        $("#correo").val("No se puede verificar el correo");
                    } else {
                        $("#correo").val(response);
                    }

                }, error: function (jqXHR, textStatus, errorThrown) {
                    if (textStatus === "timeout") {
                        $("#correo").val("No se puede verificar el correo");
                        $("#correo").css("width", "90%");
                        $("#loading").css("display", "none");
                    }
                }
            });
        } else {
            $("#correo").val("");
        }
    });


    $("#correo2").blur(function () {
        var parametros = {"mail": $(this).val()};
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (expr.test($(this).val())) {
            $.ajax({
                data: parametros,
                timeout: 10000,
                url: 'Model/verificarMail.php',
                type: 'post',
                beforeSend: function () {
                    $("#correo2").css("width", "90%");
                    $("#loading").css("display", "inline-block");
                    $("#correo2").val("verificando..");
                },
                success: function (response) {
                    $("#correo2").css("width", "100%");
                    $("#loading").css("display", "none");
                    if (response == "") {
                        $("#correo2").val("No se puede verificar el correo");
                    } else {
                        $("#correo2").val(response);
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    if (textStatus === "timeout") {
                        $("#correo2").val("No se puede verificar el correo");
                        $("#correo2").css("width", "100%");
                        $("#loading").css("display", "none");
                    }
                }
            });
        } else {
            $("#correo2").val("");
        }
    });


    $("#consultar").click(function () {
        if ($("#fecIni").val() != "" && $("#fecFin").val() == "") {
            alert("Ingrese fecha final");
            return;
        }
        var parametros = {"fechaini": $("#fecIni").val(), "fechafin": $("#fecFin").val()};
        $.ajax({
            data: parametros,
            url: 'Model/rsestadisticas.php',
            type: 'post',
            beforeSend: function () {
                $("#loading").css("display", "inline-block");
            },
            success: function (response) {
                $("#rs").html(response);
                $("#loading").css("display", "none");
            }
        });

    });


    $("#img1").click(function () {
        window.location.href = "promociones.php?promo=2";
    });

    $("#img2").click(function () {
        window.location.href = "promociones.php?promo=3";
    });


    $("#chat").click(function () {
        window.open('http://201.234.242.21:9997/VO/(S(uid0olkjynmjdunishx3uy1b))/MainFormV2.aspx', '_blank');
    });

    $("#imgs").click(function () {
        window.location.href = "inscribete_2.php";
    });

    $("#imgr").click(function () {
        window.location.href = "rutas-y-destinos.php";
    });
    $("#imgb").click(function () {
        window.location.href = "nuestros-buses.php";
    });
    
    
    $("#imgvon").click(function () {
        window.open('https://expresopalmira.com.co/Condiciones de Adquisición de Pasajes por Vía Electrónica final.pdf', '_blank');
    });



});





