<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear Subtitulos</title>
        <link rel="icon" type="image/png" href="images/favicon.png" /> 
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="ListDirectories.php" class="site_title"><span>Inicio</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <br />
                        <!-- sidebar menu -->
                        <?php include 'sidebarMenu.php'; ?>
                        <!-- /sidebar menu -->

                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>


                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h5>Crear Subtitulos Para:</h5>
                                <h5>"<?php echo $_GET['titulo'] ?>"</h5>
                            </div>            
                        </div>

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <br />
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">
                                                    Descripcion
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="desc" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>                                            
                                            <input type="hidden" id="id_titulo" value="<?php echo $_GET['id'] ?>">


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="conv">Agregar<span class="required"></span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <button type="button" class="btn btn-default" onclick="addParrafo(1)">+</button>   
                                                    <button type="button" class="btn btn-default" onclick="addParrafo(2)">Limpiar</button>   
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>                                                        
                                                        <th>Descripción</th>                                                                                                                                      
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTable">
                                                    <tr>  
                                                        <td style = "vertical-align: middle"></td>                                                                                                                                                                                                                        
                                                    </tr>  
                                                </tbody>
                                            </table>

                                            <div class="ln_solid"></div>


                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="button" class="btn btn-primary" onclick="redirect()">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="saveParrafo()">Crear</button>                          
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">           
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>   
        <!-- PNotify -->
        <script src="../vendors/pnotify/dist/pnotify.js"></script>
        <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
        <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script> 

        <!-- Dropzone.js -->
        <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

        <!-- funciones -->
        <script>
                                                        var i = 1;

                                                        function addParrafo(opc) {
                                                            var desc = $("#desc").val();
                                                            var id_titulo = $("#id_titulo").val();

                                                            var campos = {"desc": desc, "id_titulo": id_titulo, "opc": opc};
                                                            var countEmpty = 0;

                                                            if (opc == 1) {
                                                                for (c in campos) {
                                                                    //console.log("indice = "+ c +" Valor = "+campos[c]);
                                                                    if (campos[c] == "") {
                                                                        countEmpty = countEmpty + 1;
                                                                        $('#' + c).css("border", "1px solid red");
                                                                    } else {
                                                                        $('#' + c).css("border", "");
                                                                    }
                                                                }
                                                                if (countEmpty > 0) {
                                                                    showAlert("red", "Aviso..!", "Los Campos marcados en rojo son requeridos", "danger");
                                                                    return;
                                                                }
                                                            }
                                                            $.ajax({
                                                                data: campos,
                                                                url: 'Model/addSubtitulo.php',
                                                                type: 'post',
                                                                beforeSend: function () {
                                                                    //$("#responseKm").html("...");
                                                                },
                                                                success: function (response) {
                                                                    $("#bodyTable").html(response);
                                                                    if (opc == 1) {
                                                                        $("#desc").val("");
                                                                        i++;
                                                                    } else {
                                                                        i = 1;
                                                                        $("#desc").val("");
                                                                    }
                                                                }
                                                            });
                                                        }

                                                        function saveParrafo() {
                                                            $.ajax({
                                                                data: "",
                                                                url: 'Model/saveSubtitulos.php',
                                                                type: 'post',
                                                                beforeSend: function () {
                                                                    //$("#responseKm").html("...");
                                                                },
                                                                success: function (response) {
                                                                    if (response == 1) {
                                                                        showAlert("green", "Información..!", "Subtitulos creados con éxito", "info");
                                                                        setTimeout("redirect()", 3000);
                                                                    } else {
                                                                        showAlert("red", "Aviso..!", "Ocurrio un error al crear los Subtitulos", "info");
                                                                        setTimeout("redirect2()", 3000);
                                                                    }
                                                                }
                                                            });
                                                        }



//                                        showAlert("green", "Información..!", "Imagen Subida con éxito", "info");
//                                                        setTimeout("redirect()", 3000);
//showAlert("red", "Aviso..!", "Ocurrio un error al subir la imagen", "info");

                                                        function showAlert(color, titulo, cuerpo, icono) {
                                                            new PNotify({
                                                                title: titulo,
                                                                type: icono,
                                                                text: cuerpo,
                                                                nonblock: {
                                                                    nonblock: false
                                                                },
                                                                addclass: color,
                                                                styling: 'bootstrap3',
                                                                hide: true,
                                                                before_close: function (PNotify) {
                                                                    PNotify.convenio({
                                                                        title: PNotify.options.title + " - Enjoy your Stay",
                                                                        before_close: null
                                                                    });
                                                                    PNotify.queueRemove();
                                                                    return true;
                                                                }
                                                            });
                                                        }


                                                        function redirect() {
                                                            window.location.href = "ListTitulos.php";
                                                        }

                                                        function redirect2() {
                                                            window.location.href = "CrearTitulos.php";
                                                        }

                                                        function redireccionarPagina() {
                                                            window.location.href = "AsignarPermisos.php";
                                                        }

                                                        function setIdconvenio(id) {
                                                            $("#convenio").val(id);
                                                        }


                                                        function oculto() {
                                                            if (!$('#newDocument').is(":visible")) {
                                                                cleanModalDrop();
                                                            }
                                                        }

                                                        function  cleanModalDrop(campo) {
                                                            $("#drop").html("<input type='hidden' id='convenio' name='convenio'/><div class='dz-default dz-message'><span>Arrastre hasta aqui los archivos que desea subir..!</span></div>");
                                                        }






        </script>


    </body>
</html>
