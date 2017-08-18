var espere = 4000; //home: espera entre slides del slider pequeno del home

$(window).load(function () {
    $('#slider').nivoSlider({randomStart: true});
});

$('document').ready(function () {

    $('#ira').click(function () {
        if ($('#menuppal ul').is(':visible')) {
            $('#menuppal ul').slideUp();
        } else {
            $('#menuppal ul').slideDown();
        }
    });

    var x = document.location.href;
    pose = x.lastIndexOf('/') + 1;
    x = x.substring(pose, x.length);



    var mark = x.indexOf('?');

    if (mark != -1) {
        x = x.substring(0, mark);
    }

    $('#menuppal a').each(function () {
        if (x == $(this).attr('href')) {
            $(this).addClass('actual');
        }
    });

    if (x == '') {
        $('#menuppal a[href="index.php"]').addClass('actual');
    }

    if ($('#wepa_slider').length > 0) {
        $('#wepa_slider a').each(function (index) {
            var k = index + 1;
            if (index == 0) {
                $(this).addClass('actual');
            } else {
                $(this).addClass('novisi');
            }
            $(this).attr('ord', k);
        });
        setTimeout(function () {
            wsli();
        }, espere);
    }

    $('#mainint h2').wrapInner('<b></b>');
    $('#logo').text(window.innerWidth);
    if ($('#lasciudades li').length > 0)
    {
        var citi = '';
        var indexcali = 0;
        $('#lasciudades li').each(function (index) {
            var elm = $(this).html();
            var vec = elm.split('::');
            var tira = '';
            citi += '<option value="' + index + '">' + vec[0];
            var lica = vec[0].replace(/\s/g, '');
            if (lica == 'Cali') {
                indexcali = index;
            }
            tira = '<h4>' + vec[0] + '</h4>'
            var te = vec[1].replace(/\D/g, '');
            if (te != '')
            {	//tira+='<p><i class="fa fa-phone fa-lg" aria-hidden="true"></i> Tel: <a href="tel:+'+te+'">'+vec[1]+'</a></p>';		
                var tels = vec[1].split(',,');
                if (tels.length > 0)
                {
                    for (var k = 0; k < tels.length; k++)
                    {
                        var estel = tels[k].replace(/\D/g, '');
                        tira += '<p><i class="fa fa-phone fa-lg" aria-hidden="true"></i> Tel: <a href="tel:+' + estel + '">' + tels[k] + '</a></p>';
                    }
                }
            }
            var ce = vec[2].replace(/\D/g, '');
            if (ce != '')
            {	//tira+='<p><i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Cel: <a href="tel:+57'+ce+'">'+vec[2]+'</a></p>';	
                var cels = vec[2].split(',,');
                if (cels.length > 0)
                {
                    for (var k = 0; k < cels.length; k++)
                    {
                        var estel = cels[k].replace(/\D/g, '');
                        tira += '<p><i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Cel: <a href="tel:+57' + estel + '">' + cels[k] + '</a></p>';
                    }
                }
            }
            var lo = vec[3].replace(/\D/g, '');
            if (lo != '' || vec[3].length > 0) {
                tira += '<p><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> ' + vec[3] + '</p>';
            }
            $(this).html(tira);
            $(this).attr('estaciti', index);
        });
        citi = '<select id="selectciudades"><option>Seleccione' + citi + '</select>';
        $('#selciudades').html(citi);
        $('#selectciudades').change(function () {
            pintaciti($(this).val());
        });
        $('#selectciudades').val(indexcali);
        pintaciti(indexcali);
    }

    if ($('#ulpromos').length > 0)
    {
        $('#ulpromos img[promo]').each(function (index) {
            var pro = $(this).attr('promo');
            if (pro != '')
            {
                $(this).wrap('<a id="promo' + index + '" href="#modal' + index + '"></a>');
                $('#promo' + index).after('<div id="modal' + index + '"><div class="close-modal' + index + ' cierramodal">X</div><div class="modal-promo"><img src="' + pro + '"></div></div>');
                $('#promo' + index).animatedModal({modalTarget: 'modal' + index, color: 'rgba(0,102,45,0.7)', animationDuration: '.04s'});
            }
        });
    }
    $('body').append('<div id="subir"><i class="fa fa-angle-up fa-lg"></i></div>');

    $('#subir').click(function () {
        $('html, body').animate({scrollTop: $('html, body').offset().top}, 500);
    });

    $(window).scroll(function () {
        if (Number($(window).scrollTop()) > 100) {
            $('#subir').show();
        } else {
            $('#subir').hide();
        }
    });

    $('.buscarac').magnificPopup({
        delegate: 'a', type: 'image', tClose: 'Cerrar', tLoading: 'Cargando...',
        gallery: {enabled: true, navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Anterior', tNext: 'Siguiente', tCounter: '<span class="mfp-counter">%curr% / %total%</span>'},
        image: {titleSrc: 'title'}
    });

    $('#funsepsul').magnificPopup({
        delegate: 'a', type: 'image', tClose: 'Cerrar', tLoading: 'Cargando...',
        gallery: {enabled: true, navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Anterior', tNext: 'Siguiente', tCounter: '<span class="mfp-counter">%curr% / %total%</span>'},
        image: {titleSrc: 'title'}
    });
    if (x == 'promociones.php' && document.location.search != '')
    {
        var s = document.location.search;
        s = s.replace(/[\?\=]/g, '');
        if (typeof s != 'undefined' || s != '') {
            $('#' + s).click();
        }
    }
    if (x == 'inscribete_2.php') {
        $('#termycond_a').animatedModal({modalTarget: 'termycond', color: 'rgba(0,0,0,0.7)', animationDuration: '.04s'});
    }
    if (x == 'cliente-ultra.php')
    {
        $('#bot_clienteultra2').animatedModal({modalTarget: 'clienteultrains', color: 'rgba(0,0,0,0.7)', animationDuration: '.04s', oveflow: 'scroll'});
        $('#clienteultratyc_a').animatedModal({modalTarget: 'clienteultratyc', color: 'rgba(0,0,0,0.7)', animationDuration: '.04s', oveflow: 'scroll'});
        $('#bot_acumulakm').animatedModal({modalTarget: 'iniciosesionmodal', color: 'rgba(0,0,0,0.7)', animationDuration: '.04s', oveflow: 'hidden', beforeOpen: function () {
                veriniolv(1)
            }});
        $('#bot_acumulakm2').animatedModal({modalTarget: 'iniciosesionmodal', color: 'rgba(0,0,0,0.7)', animationDuration: '.04s', oveflow: 'hidden', beforeOpen: function () {
                veriniolv(1)
            }});
        $('#olvido').click(function (event) {
            var target = $(this.getAttribute('href'))
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({scrollTop: target.offset().top}, 400);
            }
        });
    }
   

});

function pintaciti(me)
{
    var ht = '';
    if (me != '') {
        ht = $('#lasciudades li[estaciti="' + me + '"]').html();
    }
    $('#estaciudad').html(ht);
}

function veriniolv(me)
{
    if (me == 1) {
        $('#areasesion1').show();
        $('#areasesion2').hide();
    } else {
        $('#areasesion2').show();
        $('#areasesion1').hide();
    }
}



function wsli()
{
    var cual = $('#wepa_slider a.actual').attr('ord');
    var sigue = Number(cual) + 1;
    if (sigue > $('#wepa_slider img').length) {
        sigue = 1;
    }
    $('#wepa_slider a[ord="' + cual + '"]').animate({'left': '-120%'}, 400, function () {
        $('#wepa_slider a[ord="' + cual + '"]').removeClass('actual');
        $('#wepa_slider a[ord="' + cual + '"]').addClass('novisi');
    });
    $('#wepa_slider a[ord="' + sigue + '"]').css({'left': '120%'});
    $('#wepa_slider a[ord="' + sigue + '"]').addClass('actual');
    $('#wepa_slider a[ord="' + sigue + '"]').removeClass('novisi');
    $('#wepa_slider a[ord="' + sigue + '"]').animate({'left': '0'}, 400, function () {
        setTimeout(function () {
            wsli();
        }, espere);
    });

}

$(window).resize(function ()
{
    $('#logo').text(window.innerWidth);
});