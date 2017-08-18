<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("convenios_ultra");
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
                                <h3>Subir slides</h3>
                                <h5>Aviso: Asegurese de que el nombre de la imagen no este repetida, pues la imagen sera reemplazada..!</h5>
                            </div>            
                        </div>

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <br />
                                        <form enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="convenio">Convenio<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="convenio2" name="convenio2" onchange="setIdconvenio(this.value);addRemoveAttr(this.id)"
                                                             style="width: 100%;height: 33px;">
                                                        <option value="">-- Seleccione --</option>
                                                        <?php
                                                        if ($conexion->getTotalFilas() > 0) {
                                                            foreach ($object as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->nit ?>"><?php echo $value->nombre ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        $conexion->desconectar();
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_imagen">Seleccione Imagen<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 10px;">
                                                    <a  data-placement="bottom"  title="Seleccione imagen" data-toggle="tooltip">
                                                        <span  id="upload" style="font-size:15px;cursor:pointer;display:inline-block" 
                                                               data-toggle="modal"                                                                
                                                               class="fa fa-cloud-upload">                                        
                                                        </span></a>
                                                </div>
                                            </div>   
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="button" class="btn btn-primary" onclick="redirect()">Cancelar</button>                                                                            
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Small modal view-->
                    <div class="modal fade bs-example-modal-sm" id="newDocument" tabindex="-1" role="dialog" aria-hidden="true" onmouseout="oculto()">
                        <div class="modal-dialog modal-sm" style="width:500px !important;">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Subir Documentos</h4>
                                </div>
                                <div class="modal-body" id="resultFiles2">
                                    <!-- page content -->   
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">                                      
                                                <div class="x_content" style="height: 320px;">                                       
                                                    <form id="drop" action="" class="uploadform dropzone">                                                                               
                                                        <input type='hidden' id='convenio' name='convenio'/>
                                                    </form>                                                                                                                                                              
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                    <!-- /page content -->             
                                </div>
                                <div class="modal-footer">
                                    <button id="mcdrop" type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModalDrop()">Cerrar</button>                                                
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /modals view-->


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
                                        $(document).ready(function () {
                                            Dropzone.autoDiscover = false;
                                            $(".uploadform").dropzone({
                                                url: 'Model/uploader.php',
                                                maxFiles: 1, // Number of files at a time
                                                maxFilesize: 4, //in MB
                                                maxfilesexceeded: function (file)
                                                {
                                                    alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
                                                },
                                                success: function (response) {
                                                    var x = JSON.parse(response.xhr.responseText);
                                                    if (x == 1) {
                                                        showAlert("green", "Información..!", "Imagen Subida con éxito", "info");
                                                        setTimeout("redirect()", 2000);
                                                    }
                                                    ;
                                                    if (x == 0) {
                                                        showAlert("red", "Información..!", "La imagen supera el tamaño Máximo permitido de 150Kb", "info");
                                                    }
                                                    ;
                                                    if (x == 3) {
                                                        showAlert("red", "Información..!", "Error, tamaño de imagen = 0KB, Imposible subir una imagen vacia", "info");
                                                    }
                                                    ;
                                                    if (x == 4) {
                                                        showAlert("red", "Información..!", "Solo se permiten imagenes en formato png ò jpg", "info");
                                                    }
                                                    ;
                                                    if (x == 5) {
                                                        showAlert("red", "Información..!", "El convenio ya tiene 3 imagenes para el slide", "info");
                                                        setTimeout("redirect2()", 2000);
                                                    }
                                                    ;
                                                    if (x == 6) {
                                                        showAlert("red", "Aviso..!", "Ocurrio un error al subir la imagen", "info");
                                                        setTimeout("redirect2()", 2000);
                                                    }
                                                    ;
                                                    $('.icon').hide(); // Hide Cloud icon
                                                    $('#uploader').modal('hide'); // On successful upload hide the modal window
                                                    $('.img').attr('src', x.img); // Set src for the image
                                                    $('.thumb').attr('src', x.thumb); // Set src for the thumbnail
                                                    $('img').addClass('imgdecoration');
                                                    this.removeAllFiles(); // This removes all files after upload to reset dropzone for next upload
                                                    console.log(x); // Just to return the JSON to the console.
                                                },
                                                addRemoveLinks: true,
                                                removedfile: function (file) {
                                                    var _ref; // Remove file on clicking the 'Remove file' button
                                                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                                }
                                            });
                                        });
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
                                            window.location.href = "ListSlidesConv.php";
                                        }

                                        function redirect2() {
                                            window.location.href = "SubirImagenConv.php";
                                        }

                                        function setIdconvenio(id) {
                                            $("#convenio").val(id);
                                        }


                                        function oculto() {
                                            if (!$('#newDocument').is(":visible")) {
                                                cleanModalDrop();
                                            }
                                        }

                                        function  cleanModalDrop() {
                                            $("#drop").html("<input type='hidden' id='convenio' name='convenio'/><div class='dz-default dz-message'><span>Arrastre hasta aqui los archivos que desea subir..!</span></div>");
                                        }



                                        function addRemoveAttr(elemento) {
                                            var conv = $('#convenio').val();
                                            if (conv != "") {
                                                $('#upload').attr("data-target", "#newDocument");
                                            } else {
                                                $('#upload').removeAttr("data-target");
                                                showAlert("red", "Información..!", "Para poder subir la imagen debes seleccionar primero el convenio", "info");
                                            }

                                        }


        </script>


    </body>
</html>
