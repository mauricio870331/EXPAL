<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("img_slides_conv");
$object2 = $conexion->findAll("convenios_ultra");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado Slides Cupones</title>
        <link rel="icon" type="image/png" href="images/favicon.png" /> 
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
        <!-- Dropzone.js -->
        <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="chargedImages.php" class="site_title"><span>Inicio</span></a>
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
                                <h4> 
                                    Listado Slides Cupones
                                </h4>
                            </div>
                            <div class="title_right"> 

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12"> 
                                <div class="x_panel">                  
                                    <div class="x_content"><!---->

                                        <p class="text-muted font-13 m-b-30"></p>
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Convenio</th>
                                                    <th>Nombre Imagen</th>                                                                                                      
                                                    <th>Imagen</th> 
                                                    <th>Peso</th>  
                                                    <th><span class="fa fa-wrench"></span> Acciones</th>                         
                                                </tr>
                                            </thead>
                                            <tbody id="listDirectorios">
                                                <?php
                                                if ($conexion->getTotalFilas() > 0) {
                                                    foreach ($object as $value) {
                                                        ?>  
                                                        <tr>                                                             
                                                            <td style="vertical-align: middle"><?php echo $value->id_convenio ?></td> 
                                                            <td style="vertical-align: middle"><?php echo $value->nombre ?></td>  
                                                            <td style="width:30%;height:20;text-align:center;vertical-align: middle" >
                                                                    <?php 
                                                                        $im = "";
                                                                        $findme   = 'img_slides_conv';
                                                                        $img = strpos($value->img, $findme);
                                                                    if ($img === false) {
                                                                        $im = "../../".$value->img;
                                                                    } else {
                                                                       $im = "../".str_replace("adminDocumentos/","",$value->img);
                                                                    } ?>

                                                                <img src="<?php echo $im;  ?>" width="150" height="100" alt="base64 test">
                                                                <a data-placement="bottom"  title="Cambiar Imagen" data-toggle="tooltip">
                                                                    <span  style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                           data-toggle="modal" 
                                                                           data-target="#newDocument"
                                                                           onclick="setIdUpdate('<?php echo $value->id ?>')"  class="fa fa-cloud-upload">                                        
                                                                    </span></a>
                                                            </td>
                                                            <td style="vertical-align: middle"><?php echo $value->peso ?></td>                                                              

                                                            <td style="vertical-align: middle"> 
                                                                <a data-placement="top"  title="Editar" data-toggle="tooltip">
                                                                    <span style="font-size:15px;cursor:pointer;display:inline-block"
                                                                          data-toggle="modal" data-target="#viewFiles" 
                                                                          onclick="viewToUpdate('<?php echo $value->id_convenio ?>',<?php echo $value->id ?>)" 
                                                                          class="fa fa fa-pencil"></span></a> | 

                                                                <a data-placement="right"  title="Eliminar" data-toggle="tooltip">
                                                                    <span class="fa fa-eraser" 
                                                                          style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                          data-toggle="modal" data-target="#ConfirmDelete"
                                                                          onclick="setIdTodelete('<?php echo $value->id ?>')" ></span></a>
                                                            </td>                                                                                                                
                                                        </tr>  

                                                        <?php
                                                    }
                                                }
                                                ?>                                          
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Small modal -->
                    <div class="modal fade bs-example-modal-sm" id="ConfirmDelete" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Eliminar Slide</h4>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Esta Seguro de Eliminar El Slide..?<b></h5>  
                                                <input type="hidden" id="idupdate2">                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-danger" onclick="updateDeleteSlide(2)" >Eliminar</button>                                                    
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                <!-- /modals -->

                                                <!-- Small modal view-->
                                                <div class="modal fade bs-example-modal-sm" id="viewFiles" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" style="width:500px !important;">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel2">Contenido del Directorio</h4>
                                                            </div>
                                                            <div class="modal-body" id="resultFiles">
                                                                <form class="form-horizontal form-label-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="convenio">Convenio<span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <select  id="convenio2" name="convenio2" style="width: 100%;height: 33px;">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                if ($conexion->getTotalFilas() > 0) {
                                                                                    foreach ($object2 as $value) {
                                                                                        ?>
                                                                                        <option value="<?php echo $value->nit ?>"><?php echo $value->nombre ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                $conexion->desconectar();
                                                                                ?>
                                                                            </select>
                                                                            <input type='hidden' id='idupdate' name='idupdate'/>
                                                                        </div>
                                                                    </div>                            
                                                                </form> 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button id="tempClose" type="button" class="btn btn-success" data-dismiss="modal" onclick="updateDeleteSlide(1)">Guardar</button> 
                                                                <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                            
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /modals view-->



                                                <!-- Small modal view-->
                                                <div class="modal fade bs-example-modal-sm" id="newDocument" tabindex="-1" role="dialog" aria-hidden="true" onmouseout="oculto()">
                                                    <div class="modal-dialog modal-sm" style="width:500px !important;">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel2">Subir Imagen</h4>
                                                            </div>
                                                            <div class="modal-body" id="resultFiles2">
                                                                <!-- page content -->   
                                                                <div class="clearfix"></div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="x_panel">                                      
                                                                            <div class="x_content" style="height: 320px;">                                       
                                                                                <form id="drop" action="" class="uploadform dropzone">                                                                                 

                                                                                    <input type='hidden' id='update' name='update'/>
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
                                                <!-- bootstrap-progressbar -->
                                                <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
                                                <!-- iCheck -->
                                                <script src="../vendors/iCheck/icheck.min.js"></script>
                                                <!-- Datatables -->
                                                <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
                                                <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
                                                <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
                                                <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
                                                <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
                                                <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
                                                <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
                                                <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
                                                <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
                                                <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
                                                <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>   
                                                <script src="../vendors/jszip/dist/jszip.min.js"></script>
                                                <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
                                                <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
                                                <!-- PNotify -->
                                                <script src="../vendors/pnotify/dist/pnotify.js"></script>
                                                <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
                                                <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

                                                <!-- Dropzone.js -->
                                                <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>



                                                <!-- Custom Theme Scripts -->
                                                <script src="../build/js/custom.min.js"></script>

                                                <!-- Datatables -->
                                                <script>
                                                                    $(document).ready(function () {
                                                                        
                                                                        Dropzone.autoDiscover = false;
                                                                        $(".uploadform").dropzone({
                                                                            url: 'Model/updateImageSlide.php',
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
                                                                                    showAlert("red", "Información..!", "El documento supera el tamaño Máximo permitido de 4MB", "info");
                                                                                    setTimeout("redirect()", 2000);
                                                                                }
                                                                                ;
                                                                                if (x == 2) {
                                                                                    showAlert("red", "Información..!", "El lugar y la posicion no deben estar vacios", "info");
                                                                                    setTimeout("redirect()", 2000);
                                                                                }
                                                                                ;
                                                                                if (x == 3) {
                                                                                    showAlert("red", "Información..!", "El documento supera el tamaño Máximo permitido de 4MB ó el documento no tiene contenido", "info");
                                                                                    setTimeout("redirect()", 2000);
                                                                                }
                                                                                ;
                                                                                if (x == 4) {
                                                                                    showAlert("red", "Información..!", "Solo se permiten documentos en formato pdf ò xls / xlsx", "info");
                                                                                    setTimeout("redirect()", 2000);
                                                                                }
                                                                                ;
                                                                                if (x == 5) {
                                                                                    showAlert("red", "Información..!", "El Disco esta lleno", "info");
                                                                                    setTimeout("redirect()", 2000);
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

                                                                        var handleDataTableButtons = function () {
                                                                            if ($("#datatable-buttons").length) {
                                                                                $("#datatable-buttons").DataTable({
                                                                                    dom: "Bfrtip",
                                                                                    buttons: [
                                                                                        {
                                                                                            extend: "copy",
                                                                                            className: "btn-sm"
                                                                                        },
                                                                                        {
                                                                                            extend: "csv",
                                                                                            className: "btn-sm"
                                                                                        },
                                                                                        {
                                                                                            extend: "excel",
                                                                                            className: "btn-sm"
                                                                                        },
                                                                                        {
                                                                                            extend: "pdfHtml5",
                                                                                            className: "btn-sm"
                                                                                        },
                                                                                        {
                                                                                            extend: "print",
                                                                                            className: "btn-sm"
                                                                                        },
                                                                                    ],
                                                                                    responsive: true
                                                                                });
                                                                            }
                                                                        };

                                                                        TableManageButtons = function () {
                                                                            "use strict";
                                                                            return {
                                                                                init: function () {
                                                                                    handleDataTableButtons();
                                                                                }
                                                                            };
                                                                        }();

                                                                        $('#datatable').dataTable();

                                                                        $('#datatable-keytable').DataTable({
                                                                            keys: true
                                                                        });

                                                                        $('#datatable-responsive').DataTable();

                                                                        $('#datatable-scroller').DataTable({
                                                                            ajax: "js/datatables/json/scroller-demo.json",
                                                                            deferRender: true,
                                                                            scrollY: 380,
                                                                            scrollCollapse: true,
                                                                            scroller: true
                                                                        });

                                                                        $('#datatable-fixed-header').DataTable({
                                                                            fixedHeader: true
                                                                        });

                                                                        var $datatable = $('#datatable-checkbox');

                                                                        $datatable.dataTable({
                                                                            'order': [[1, 'asc']],
                                                                            'columnDefs': [
                                                                                {orderable: false, targets: [0]}
                                                                            ]
                                                                        });
                                                                        $datatable.on('draw.dt', function () {
                                                                            $('input').iCheck({
                                                                                checkboxClass: 'icheckbox_flat-green'
                                                                            });
                                                                        });

                                                                        TableManageButtons.init();
                                                                    });

                                                                    function setIdUpdate(id) {
                                                                        $("#update").val(id);
                                                                    }

                                                                    function setRuta(directorio) {
                                                                        $("#ruta").val("../" + directorio);
                                                                    }


                                                                    function redirect() {
                                                                        window.location.href = "ListSlidesConv.php";
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
                                                                                PNotify.update({
                                                                                    title: PNotify.options.title + " - Enjoy your Stay",
                                                                                    before_close: null
                                                                                });
                                                                                PNotify.queueRemove();
                                                                                return true;
                                                                            }
                                                                        });
                                                                    }



                                                                    function viewToUpdate(convenio, id) {
                                                                        $('#convenio2 > option[value="' + convenio + '"]').attr('selected', 'selected');
                                                                        $('#idupdate').val(id)
                                                                    }


                                                                    function setIdTodelete(id) {
                                                                        $('#idupdate2').val(id)
                                                                    }


                                                                    function updateDeleteSlide(opc) {
                                                                        var parametros, convenio2, idupdate, msn2;

                                                                        if (opc == 1) {
                                                                            convenio2 = $("#convenio2").val();
                                                                            idupdate = $("#idupdate").val();
                                                                            parametros = {"id": idupdate, "convenio": convenio2, "opc": opc};
                                                                            msn2 = "Ocurrio un error al actualizar el Slide";
                                                                        } else {
                                                                            idupdate = $("#idupdate2").val();
                                                                            parametros = {"id": idupdate, "opc": opc};
                                                                            msn2 = "Ocurrio un error al eliminar el Slide";
                                                                        }
                                                                        $.ajax({
                                                                            data: parametros,
                                                                            url: 'Model/updateDeleteSlides.php',
                                                                            type: 'post',
                                                                            beforeSend: function () {
                                                                                //$("#responseKm").html("...");
                                                                            },
                                                                            success: function (response) {
                                                                                console.log(response);
                                                                                if (response == 1) {
                                                                                    redirect();
                                                                                } else {
                                                                                    showAlert("red", "Aviso..!", msn2, "danger");
                                                                                }
                                                                            }
                                                                        });
                                                                    }
                                                                    function oculto() {
                                                                        if (!$('#newDocument').is(":visible")) {
                                                                            cleanModalDrop();
                                                                        }
                                                                    }
                                                                    function redireccionarPagina(pagina) {
                                                                        window.location.href = pagina;
                                                                    }
                                                                    function oculto() {
                                                                        if (!$('#newDocument').is(":visible")) {
                                                                            cleanModalDrop();
                                                                        }
                                                                    }
                                                </script>
                                                <!-- /Datatables -->
                                                </body>
                                                </html>
