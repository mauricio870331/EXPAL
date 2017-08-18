$(function () {
    $('#example').DataTable();
    $('#example2').DataTable();
});
var miArray = new Array();
var miArraySum = new Array();
var num = 0;
var pos = 0;


function Selecionar(codigo, valor, kms) {
    var condi = -1;
    for (var i = 0; i <= miArray.length; i++) {
        if (miArray[i] == codigo) {
            delete miArray[i];
            delete miArraySum[i];
            num = num - 1;
            condi = i;
            break;
        }
    }
    if (condi == -1) {
        miArray[num] = [codigo];
        miArraySum[num] = [valor];
    }
    num = num + 1;
    condi = -1;
}

function Acept(kms, documento, opc, id_tiquete_solicitado, id_parametro_ganador) {
  /*  if (miArray.length == 0) {
        alert("Debes selecionar primero un tiquete");
    } else {
        miArray.filter(Boolean);
        miArraySum.filter(Boolean);*/
        window.location.href = "Model/PremiarTiquete.php?Accion="+ kms + "-" + documento + "-" + opc + "-" + id_tiquete_solicitado + "-" + id_parametro_ganador + "";
      
        /*miArray = [];
        miArraySum = [];
    }*/
}

function Atras() {
    location.href = 'MenuUltraAdmon.php';
}

function Salir() {
    window.location.href = "Model/CerrarSession.php";
}

function Validacion() {

    if (document.form_3.datepicker.value.length == 0) {
        alert("Debe de completar el campo  de fecha");
        document.form_3.datepicker.focus()
        return false;
    }


    if (document.form_3.tiquete.value.length == 0) {
        alert("Debe de completar el campo  de tiquete");
        document.form_3.tiquete.focus()
        return false;
    }

    if (document.form_3.origen.value == 0) {
        alert("Debe selecionar un origen");
        document.form_3.origen.focus()
        return false;
    }


    if (document.form_3.destino.value == 0) {
        alert("Debe selecionar un destino");
        document.form_3.destino.focus()
        return false;
    }

    if (document.form_3.verificar.value == 0) {
        alert("Sleccione la opcion de verificar si ò no");
        document.form_3.verificar.focus()
        return false;
    }

    var ori = document.form_3.origen.value;
    var des = document.form_3.destino.value;

    if (ori == des) {
        alert("el origen y el destino deben ser diferentes");
        document.form_3.origen.focus()
        return false;
    }

}

function guardarUsuario() {
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
    } else if (!expr.test(document.formRegistro.Correo_Electronico.value)) {
        alert("La dirección de correo " + document.formRegistro.Correo_Electronico.value + " es incorrecta.");
        document.formRegistro.Correo_Electronico.focus()
        return false;
    } else {
        document.formRegistro.action = "Model/guarda_usuario.php";
        document.formRegistro.submit()
    }
}

$(document).keypress(function (e) {
    if (e.which == 13) {
        cargarPremiados();
    }
});


function cargarPremiados() {
    $("#resultConsulta").show();
    $("#resultConsulta2").hide();
    var fecINI = $("#fecINI").val();
    var fecFin = $("#fecFin").val();
    if (fecINI == "") {
        alert("Seleccione la Fecha Inicial");
        $("#fecINI").focus();
        return false;
    }
    if (fecFin == "") {
        alert("Seleccione la Fecha Final");
        $("#fecFin").focus();
        return false;
    }
    var parametros = {"fecINI": fecINI, "fecFin": fecFin};
    $.ajax({
        data: parametros,
        url: 'Model/cargarPremiados.php',
        type: 'post',
        beforeSend: function () {
            $("#resultConsulta").html("...");
        },
        success: function (response) {
            $("#resultConsulta").html(response);
        }
    });


}

function  cleanModal(campo, content) {
    $("#" + campo).val("");
    $("#" + content).html("");
}


function  consultarCliente(activar) {
    var cedula = $("#cedula").val();
    if (cedula != "") {
        var parametros = {"cedula": cedula, "activar": activar};
        $.ajax({
            data: parametros,
            url: 'Model/cargarDatosPorCliente.php',
            type: 'post',
            beforeSend: function () {
                $("#responsecli").html("...");
            },
            success: function (response) {
                $("#responsecli").html(response);
            }
        });
    } else {
        alert("El campo Cédula no debe estar vacio");
        $("#cedula").focus();
    }


}


function consultarKilometros() {
    var cedula = $("#cedulaK").val();
    if (cedula != "") {
        var parametros = {"cedula": cedula};
        $.ajax({
            data: parametros,
            url: 'Model/cargarKmPorCliente.php',
            type: 'post',
            beforeSend: function () {
                $("#responseKm").html("...");
            },
            success: function (response) {
                $("#responseKm").html(response);
            }
        });
    } else {
        alert("El campo Cédula no debe estar vacio");
        $("#cedulaK").focus();
    }

}

function consultarPremios() {
    var cedula = $("#cedulaP").val();
    if (cedula != "") {
        var parametros = {"cedula": cedula};
        $.ajax({
            data: parametros,
            url: 'Model/cargarPremiosPorCliente.php',
            type: 'post',
            beforeSend: function () {
                $("#responseP").html("...");
            },
            success: function (response) {
                $("#responseP").html(response);
            }
        });
    } else {
        alert("El campo Cédula no debe estar vacio");
        $("#cedulaP").focus();
    }

}

function consultarVencidos() {
    var cedula = $("#cedulaV").val();
    if (cedula != "") {
        var parametros = {"cedula": cedula};
        $.ajax({
            data: parametros,
            url: 'Model/cargarVencidosPorCliente.php',
            type: 'post',
            beforeSend: function () {
                $("#responseV").html("...");
            },
            success: function (response) {
                $("#responseV").html(response);
            }
        });
    } else {
        alert("El campo Cédula no debe estar vacio");
        $("#cedulaV").focus();
    }

}



function reporte() {
    var opc = $('input:radio[name=opc]:checked').val();
    var fecINI = $("#fecINI").val();
    var fecFin = $("#fecFin").val();
    if (fecINI == "") {
        alert("Seleccione la Fecha Inicial");
        $("#fecINI").focus();
        return false;
    }
    if (fecFin == "") {
        alert("Seleccione la Fecha Final");
        $("#fecFin").focus();
        return false;
    }
    var parametros = {"fecINI": fecINI, "fecFin": fecFin, "opc": opc};
    $.ajax({
        data: parametros,
        url: 'Model/consolidado.php',
        type: 'post',
        beforeSend: function () {
            $("#resultConsulta").html("...");
        },
        success: function (response) {
            $("#resultConsulta").html(response);
        }
    });


}

function setCedula(cedula, alta) {
    $("#cccliente").val(cedula);
    $("#alta").val(alta);
}

function cleanModalDetalle() {
    $("#opt1").attr('checked', false);
    $("#opt2").attr('checked', false);
    $("#opt3").attr('checked', false);
    $("#responseDetalle").html("");
}

function getDatos() {
    var fecINI = $("#inicio").val();
    var fecFin = $("#fin").val();
    var cedula = $("#cccliente").val();
    var alta = $("#alta").val();
    var opt = "";

    if ($("#opt1").is(':checked')) {
        opt = $("#opt1").val();
    }
    if ($("#opt2").is(':checked')) {
        opt = $("#opt2").val();
    }
    if ($("#opt3").is(':checked')) {
        opt = $("#opt3").val();
    }

    var parametros = {"cedula": cedula, "alta": alta, "opt": opt};
    $.ajax({
        data: parametros,
        url: 'Model/tiquetesByCliente.php',
        type: 'post',
        beforeSend: function () {
            $("#responseDetalle").html("...");
        },
        success: function (response) {
            $("#responseDetalle").html(response);
        }
    });


}

function ValidarKilometros(usuari) {
    if (document.getElementById('opciones_1').checked) {
        valueRuta = origen + "-" + destino;
    }
    if (document.getElementById('opciones_2').checked) {
        valueRuta = destino + "-" + origen;
    }
    document.rquest.action = "Model/ValidarKilometros.php?Accion=" + id + "-" + usuari + "-" + valueRuta;
    document.rquest.submit();
// window.location.assign("ValidarKilometros.php?Accion="+codigo+"-"+usuari;
}

function ValidarKilometros2() {
    if (document.getElementById('opciones_1').checked) {
        valueRuta = origen + "-" + destino;
    }
    if (document.getElementById('opciones_2').checked) {
        valueRuta = destino + "-" + origen;
    }
    document.rquest.action = "Model/ValidarKilometros.php?Accion=" + id + "-" + cedu + "-" + valueRuta;
    document.rquest.submit();
    // window.location.assign("ValidarKilometros.php?Accion="+codigo+"-"+usuari;
}


function Validacion2() {
    if (document.form_3.datepicker.value.length == 0) {
        alert("Debe de completar el campo  de fecha");
        document.form_3.datepicker.focus()
        return false;
    }
    if (document.form_3.tiquete.value.length == 0) {
        alert("Debe de completar el campo  de tiquete");
        document.form_3.tiquete.focus()
        return false;
    }
    if (document.form_3.origen.value == 0) {
        alert("Debe selecionar un origen");
        document.form_3.origen.focus()
        return false;
    }
    if (document.form_3.destino.value == 0) {
        alert("Debe selecionar un destino");
        document.form_3.destino.focus()
        return false;
    }
    var ori = document.form_3.origen.value;
    var des = document.form_3.destino.value;
    if (ori == des) {
        alert("el origen y el destino deben ser diferentes");
        document.form_3.origen.focus()
        return false;
    }

}


var id;
var destino;
var origen;
var valueRuta;
var cedu;
function setId(a) {
    id = a;
    origen = document.getElementById('rq' + id).dataset.origen;
    destino = document.getElementById('rq' + id).dataset.destino;
    document.getElementById('r1').innerHTML = origen + " - " + destino;
    document.getElementById('r2').innerHTML = destino + " - " + origen;
}

function setId2(a, cedula) {
    id = a;
    cedu = cedula;
    origen = document.getElementById('rq' + id).dataset.origen;
    destino = document.getElementById('rq' + id).dataset.destino;
    document.getElementById('r1').innerHTML = origen + " - " + destino;
    document.getElementById('r2').innerHTML = destino + " - " + origen;
}

function Refrescar(cedula) {

    var parametros = {"cedula": cedula};
    $.ajax({
        data: parametros,
        url: 'Model/RefrescarPuntos.php',
        type: 'post',
        beforeSend: function () {
            $("#puntos").html("...");
        },
        success: function (response) {
            $("#puntos").html(response);
        }
    });


}

function  verMisPuntos(id) {

    var parametros = {"id": id};
    $.ajax({
        data: parametros,
        url: 'Model/verMisPuntos.php',
        type: 'post',
        beforeSend: function () {
            $("#responsePuntos").html("...");
        },
        success: function (response) {
            $("#responsePuntos").html(response);
        }
    });

}

function mostrar(id) {
    var li = document.getElementsByClassName("activethis");
    li[0].className = li[0].className.replace(" activethis", "");
    document.getElementById(id).className += " activethis";
    var categorias;
//    var parametros = {"id": id};
    $.ajax({
//        data: "",
        url: 'Model/getCategorias.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            categorias = JSON.parse(response);
            if (id == 'todas') {
                for (var indice in categorias) {
                    var cate = document.getElementsByClassName(categorias[indice]);
                    for (i = 0; i < cate.length; i++) {
                        cate[i].style.display = 'inline-block';
                    }
                }
            } else {
                for (var indice in categorias) {
                    var cate = document.getElementsByClassName(categorias[indice]);
                    if (categorias[indice] == id) {
                        for (i = 0; i < cate.length; i++) {
                            cate[i].style.display = 'inline-block';
                        }
                    } else {
                        for (i = 0; i < cate.length; i++) {
                            cate[i].style.display = 'none';
                        }
                    }
                }
            }
        }
    });
}



function setProducto(prod, elemento) {
    var elem = document.querySelector('#' + elemento);
    if (elemento == "btndog") {
        elem.setAttribute("data-prod", prod);
        document.querySelector('#btnham').setAttribute("data-prod", '');
    } else {
        elem.setAttribute("data-prod", prod);
        document.querySelector('#btndog').setAttribute("data-prod", '');
    }


}

function PrintElem(elem) {
    //window.open('imprimirCupon.php','_blank');
    //location.href='imprimirCupon.php';.
    var btn = document.querySelector('#btndog');
    var btn2 = document.querySelector('#btnham');
    var prod = '';
    var elemento = document.querySelector('#btndescargar');
    if (elemento.getAttribute("data-conv") == 'BILLOSCOMIDASRAPIDAS') {
        if (btn.getAttribute('data-prod') == '' && btn2.getAttribute('data-prod') == '') {
            alert('Seleccione producto');
            return;
        } else if (btn.getAttribute('data-prod') != '') {
            prod = btn.getAttribute('data-prod');
        } else if (btn2.getAttribute('data-prod') != '') {
            prod = btn2.getAttribute('data-prod');
        }
        if (prod != '') {
            document.querySelector('#btndog').setAttribute("data-prod", '');
            document.querySelector('#btnham').setAttribute("data-prod", '');
            document.getElementById('btndog').style.backgroundColor = '#FCE700';
            document.getElementById('btnham').style.backgroundColor = '#FCE700';
            open('Model/imprimirCupon.php?token=' + btoa(elem) + '&conv=' + btoa(elemento.getAttribute("data-conv")) + '&prod=' + btoa(prod), '', 'top=20,left=300,width=800,height=600');
        }
    } else {
        open('Model/imprimirCupon.php?token=' + btoa(elem) + '&conv=' + btoa(elemento.getAttribute("data-conv")) + '&prod=' + btoa(prod), '', 'top=20,left=300,width=800,height=600');
    }



}


function setConvenio(id) {
    for (i = 0; i < 3; i++) {
        document.getElementById('imgmin' + (i + 1)).src = "";
    }
    for (i = 0; i < 4; i++) {
        document.getElementById("parrafoCond" + (i + 1)).innerHTML = "";
    }

    for (i = 0; i < 5; i++) {
        document.getElementById("li" + (i + 1)).innerHTML = "";
    }

    for (i = 0; i < 6; i++) {
        document.getElementById("li" + (i + 1)).innerHTML = "";
    }
    for (i = 0; i < 4; i++) {
        if (i == 0) {
            document.getElementById("mtt").innerHTML = "";
            document.getElementById("tituloCond").innerHTML = "";
        }
        document.getElementById("li_p" + (i + 1)).innerHTML = "";

    }
    document.getElementById("Detalle").innerHTML = "";

    var l = document.getElementById('btn1');
    l.click();
    var elemento = document.querySelector('#btndescargar');
    var datos;
    elemento.setAttribute("data-conv", id);
    var parametros = {"id": id};
    $.ajax({
        data: parametros,
        url: 'Model/getDatosConvenios.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            if (id == 'BILLOSCOMIDASRAPIDAS') {
                document.getElementById('btndog').style.display = 'inline-block';
                document.getElementById('btnham').style.display = 'inline-block';
            } else {
                document.getElementById('btndog').style.display = 'none';
                document.getElementById('btnham').style.display = 'none';
            }
            response.replace(/[\u0000-\u0019]+/g, "").replace(/\\n/g, "\\n")
                    .replace(/\\'/g, "\\'")
                    .replace(/\\"/g, '\\"')
                    .replace(/\\&/g, "\\&")
                    .replace(/\\r/g, "\\r")
                    .replace(/\\t/g, "\\t")
                    .replace(/\\b/g, "\\b")
                    .replace(/\\f/g, "\\f");
            datos = JSON.parse(response);
            for (i = 0; i < datos['imagenes'].length; i++) {
                document.getElementById('imgmin' + (i + 1)).src = datos['imagenes'][i];
            }
            for (i = 0; i < datos['parrafos'].length; i++) {
                document.getElementById("parrafoCond" + (i + 1)).innerHTML = datos['parrafos'][i];
            }
            for (i = 0; i < datos['condiciones'].length; i++) {
                document.getElementById("li" + (i + 1)).innerHTML = datos['condiciones'][i];
            }
            for (i = 0; i < datos['parraf_slides'].length; i++) {
                if (i == 0) {
                    document.getElementById("mtt").innerHTML = datos['parraf_slides'][i];
                    document.getElementById("tituloCond").innerHTML = datos['parraf_slides'][i];
                }
                document.getElementById("li_p" + (i + 1)).innerHTML = datos['parraf_slides'][i];
            }
            var divPr = document.getElementById("Detalle");
            for (i = 0; i < datos['titulos'].length; i++) {
                var div = document.createElement("div");
                var ul = document.createElement("ul");
                var h5 = document.createElement("h5");
                div.appendChild(ul);
                h5.innerHTML = datos['titulos'][i]['desc'];
                h5.classList.add("listaz");
                var d2;
                ul.appendChild(h5);
                for (j = 0; j < datos['subtitulos'].length; j++) {
                    for (k = 0; k < datos['subtitulos'][j].length; k++) {
                        if (datos['subtitulos'][j][k]['id_titulo'] == datos['titulos'][i]['id']) {
                            var h6 = document.createElement("h6");
                            h6.innerHTML = datos['subtitulos'][j][k]['desc'];
                            h6.classList.add("listaz");
                            ul.appendChild(h6);
                            d2 = JSON.parse(datos['subtitulos'][j][k]['detalle']);
                            for (z = 0; z < d2.length; z++) {
                                var li = document.createElement("li");
                                li.innerHTML = d2[z];
                                li.classList.add("li_inter");
                                ul.appendChild(li);
                            }
                        }
                    }
                }
                divPr.appendChild(div);
            }
        }
    });
}


var t;
function setNumTiquete(tiquete, opc) {
    if (tiquete != 0) {
        document.getElementById("tiquete").value = tiquete;
        document.getElementById("oldTiquete").value = tiquete;
    } else {
        document.getElementById("tiquete").value = "";
        document.getElementById("oldTiquete").value = "";
    }
    document.getElementById("opc").value = opc;
    document.getElementById("myModalLabel").innerHTML = ((opc == "U") ? "Actualizar Tiquete" : "Nuevo Tiquete");

    t = tiquete;
}

function DeleteTiquete() {
    document.AccionesTiquete.action = "Model/DeleteTiquete.php?Accion=" + t;
    document.AccionesTiquete.submit();
}

function UpdateTiquete() {
    var n_tiquete = document.getElementById("tiquete").value;
    if (n_tiquete != "") {
        document.formUpdateT.action = "Model/UpdateTiquete.php";
        document.formUpdateT.submit();
    } else {
        alert("Ingrese numero de tiquete");
        document.getElementById("tiquete").focus();
    }


}

var c;
function setNumCedula(cedula, opc) {
    if (cedula != 0) {
        document.getElementById("cedula").value = cedula;
        document.getElementById("oldcedula").value = cedula;
    } else {
        document.getElementById("cedula").value = "";
        document.getElementById("oldcedula").value = "";
    }
    document.getElementById("opc2").value = opc;
    document.getElementById("myModalLabel2").innerHTML = ((opc == "U") ? "Actualizar Cédula" : "Nueva Cédula");
    c = cedula;
}

function DeleteUser() {
    document.AccionesUser.action = "Model/DeleteUser.php?Accion=" + c;
    document.AccionesUser.submit();
}

function UpdateUser() {
    var ncedula = document.getElementById("cedula").value;
    if (ncedula != "") {
        document.formUpdateC.action = "Model/UpdateCedulaUser.php";
        document.formUpdateC.submit();
    } else {
        alert("Ingrese número de Cédula");
        document.getElementById("cedula").focus();
    }
}
