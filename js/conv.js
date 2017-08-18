function  verificarCupon(consecutivo, usuario) {
    var id = document.getElementById("validar").value;
    var alert1 = document.getElementById("alert1");
    var alert2 = document.getElementById("alert2");
    var alert3 = document.getElementById("alert3");
    var alert4 = document.getElementById("alert4");
    if (id != "") {
        var form = document.getElementById("form");
        var nit = document.getElementById("nit").value;
        var parametros = {"id": id, "nit": nit, "consecutivo": consecutivo, "usuario": usuario};
        $.ajax({
            data: parametros,
            url: '../Model/validarCupon.php',
            type: 'post',
            beforeSend: function () {

            },
            success: function (response) {
                if (response == "1") {
                    form.style.display = "none";
                    alert1.style.display = "block";
                    alert4.style.display = "none";
                    alert2.style.display = "none";
                    alert3.style.display = "none";
                    document.getElementById("validar").value = "";
                } else if (response == "2") {
                    form.style.display = "none";
                    alert2.style.display = "block";
                    alert4.style.display = "none";
                    alert1.style.display = "none";
                    alert3.style.display = "none";
                    document.getElementById("validar").value = "";
                } else {
                    alert3.style.display = "block";
                    alert4.style.display = "none";
                    alert1.style.display = "none";
                    alert2.style.display = "none";
                    document.getElementById("validar").value = "";
                }
            }
        });
    } else {
        alert4.style.display = "block";
        alert1.style.display = "none";
        alert2.style.display = "none";
        alert3.style.display = "none";
        document.getElementById("validar").focus();
    }

}