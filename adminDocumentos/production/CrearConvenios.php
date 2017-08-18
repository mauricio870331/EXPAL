<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("categorias_cupones", " Where id_categoria <> 'todas' order by categoria");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear Documentos</title>
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
                                <h3>Crear Convenios</h3>
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="orden">
                                                    No. Orden
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="orden" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nit">
                                                    Id Convenio
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="nit" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                                    Nombre del Convenio
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="name" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div> 


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prefix">
                                                    Prefijo
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="prefix" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div> 


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat">Categoria<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="cat" name="cat" style="width: 100%;height: 33px;">
                                                        <option value="">-- Seleccione --</option>
                                                        <?php
                                                        if ($conexion->getTotalFilas() > 0) {
                                                            foreach ($object as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id_categoria ?>"><?php echo $value->categoria ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        $conexion->desconectar();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="button" class="btn btn-primary" onclick="redireccionarPagina()">Cancelar</button>
                                                    <button type="button" class="btn btn-success" onclick="createConvenio()">Crear</button>                          
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
                                                        function createConvenio() {
                                                            var nit = $("#nit").val();
                                                            var name = $("#name").val();
                                                            var prefix = $("#prefix").val();
                                                            var cat = $("#cat").val();
                                                            var orden = $("#orden").val();
                                                            var campos = {"nit": nit,
                                                                "name": name,
                                                                "prefix": prefix,
                                                                "cat": cat,"orden": orden};
                                                            var countEmpty = 0;
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
                                                            $.ajax({
                                                                data: campos,
                                                                url: 'Model/crearConvenio.php',
                                                                type: 'post',
                                                                beforeSend: function () {
                                                                    //$("#responseKm").html("...");
                                                                },
                                                                success: function (response) {
                                                                    if (response == 1) {
                                                                        showAlert("green", "Información..!", "Convenio creado con éxito", "info");
                                                                        setTimeout("redirect()", 2000);
                                                                    } else if (response == 0) {
                                                                        showAlert("red", "Aviso..!", "Ocurrio un error al crear el Convenio", "danger");
                                                                        setTimeout("redirect()", 2000);
                                                                    } else {
                                                                        showAlert("red", "Aviso..!", "El Convenio con ese Nit ya existe", "danger");
                                                                        setTimeout("redirect()", 2000);
                                                                    }
                                                                }
                                                            });
                                                        }

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
                                                            window.location.href = "CrearConvenios.php";
                                                        }

                                                        function redireccionarPagina() {
                                                            window.location.href = "ContentCupones.php";
                                                        }

        </script>


    </body>
</html>
