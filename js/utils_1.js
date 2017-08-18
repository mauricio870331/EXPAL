$(function () {
    $('#example2').DataTable();
});


$(".verificar").click(function () {
    var tiquete = $(this).data('value');
    var parametros = {'tiquete': tiquete};
    $.ajax({
        data: parametros,
        url: 'Model/verificarTiquete.php',
        type: 'post',
        success: function (response) {
            console.log(response);
            if (response == 1) {
                $("#presionar").click();
            } else {
                alert("No se pudo verificar el tiquete...!");
                $("#presionar").click();
            }
        }
    });

});





