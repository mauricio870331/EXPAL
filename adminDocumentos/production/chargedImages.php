<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_convenios");
$object = $conexion->findAll("imagenesEP");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de Imagenes</title>
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
                                <h6> 
                                    <input type="radio" class="boton" name="opc" value="inicio" onclick="setOpc()"> Inicio |
                                    <input type="radio" class="boton" name="opc" value="promocion" onclick="setOpc()"> Promociones |
                                    <input type="radio" class="boton" name="opc" value="modalPromo" onclick="setOpc()"> Modal Promo |
                                    <input type="radio" class="boton" name="opc" value="slidePromos" onclick="setOpc()"> Slide Promo |  
                                    Posicion: <input style="width: 45px;" id="number" type="number" min="0" max="10" step="1" value="1" size="2">
                                    <a data-placement="bottom"  title="Subir Imagen" data-toggle="tooltip"><span  style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#newDocument" onclick="setPos();setAction('create');"  class="fa fa-cloud-upload"></span></a>
                                </h6>
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
                                                    <th>Imagen</th>
                                                    <th>Nombre</th>
                                                    <th>Ubicación</th>  
                                                    <th>Posición</th> 
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

                                                            <td style="width:30%;height:40px;text-align:center" >
                                                                <img src="data:image/jpeg;base64,<?php echo $value->imagen ?>" style="width: 200px;height: 116px;" alt="base64 test">
                                                                <a data-placement="bottom"  title="Cambiar Imagen" data-toggle="tooltip">
                                                                    <span  style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                           data-toggle="modal" 
                                                                           data-target="#newDocument"
                                                                           onclick="setIdUpdate('<?php echo $value->id ?>');setAction('update');"  class="fa fa-cloud-upload">                                        
                                                                    </span></a>
                                                            </td>
                                                            <td><?php echo $value->nombre ?></td> 
                                                            <td><?php echo $value->lugar ?></td>  
                                                            <td><?php echo $value->posicion ?></td>  
                                                            <td><?php echo $value->peso ?></td>     
                                                            <td>                            



                                                                <a data-placement="top"  title="Ver Contenido" data-toggle="tooltip"><span style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#viewFiles" onclick="viewToUpdate('<?php echo $value->id ?>')"  class="fa fa fa-pencil"></span></a> | 

                                                                <a data-placement="right"  title="Eliminar Directorio" data-toggle="tooltip"> <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#ConfirmDelete" onclick="setIdTodelete('<?php echo $value->id ?>')" ></span></a>
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
                                    <h4 class="modal-title" id="myModalLabel2">Eliminar Imagen</h4>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Esta Seguro de Eliminar la imagen..?<b></h5>  
                                                <input type="hidden" id="id_delete">                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal('id_delete')">Cancelar</button>
                                                    <button type="button" class="btn btn-primary" onclick="deleteImage()" >Eliminar</button>
                                                    <input type="hidden" data-dismiss="modal" id="tempClose">
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

                                                            </div>
                                                            <div class="modal-footer">
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
                                                                                    <input type="hidden" id="opcH" name="opcH"/>
                                                                                    <input type="hidden" id="pos" name="pos"/>
                                                                                    <input type="hidden" id="action" name="action"/>
                                                                                    <input type='hidden' id='update' name='update'/>
                                                                                </form>
                                                                                <br />
                                                                                <br />
                                                                                <br />
                                                                                <br />
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


                                                <!-- Small modal -->
                                                <div class="modal fade bs-example-modal-sm" id="crearPerfil" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel2">Crear Perfil</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal form-label-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3" for="first-name">Perfil <span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-7">
                                                                            <input type="text" id="PerfilS" class="form-control col-md-7 col-xs-12">
                                                                        </div>
                                                                    </div>                               
                                                                </form>                                             
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal('PerfilS')">Cancelar</button>
                                                                <button type="button" class="btn btn-primary" onclick="savePerfil();" >Guardar</button>
                                                                <input type="hidden" data-dismiss="modal" id="tempClose2">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /modals -->   



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
                                                                        var opc = $('input:radio[name=opc]:checked').val();
                                                                        Dropzone.autoDiscover = false;
                                                                        $(".uploadform").dropzone({
                                                                            url: 'Model/uploadImages.php',
                                                                            //maxFiles: 1, // Number of files at a time
                                                                            maxFilesize: 4, //in MB
                                                                            maxfilesexceeded: function (file)
                                                                            {
                                                                                alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
                                                                            },
                                                                            success: function (response) {
                                                                                var x = JSON.parse(response.xhr.responseText);
                                                                                if (x == 1) {
                                                                                    showAlert("green", "Información..!", "Imagen Subida con éxito", "info");
                                                                                    setTimeout("redirect()", 1000);
                                                                                }
                                                                                ;
                                                                                if (x == 0) {
                                                                                    showAlert("red", "Información..!", "El documento supera el tamaño Máximo permitido de 4MB", "info");
                                                                                }
                                                                                ;
                                                                                if (x == 2) {
                                                                                    showAlert("red", "Información..!", "El lugar y la posicion no deben estar vacios", "info");
                                                                                }
                                                                                ;
                                                                                if (x == 3) {
                                                                                    showAlert("red", "Información..!", "El documento supera el tamaño Máximo permitido de 4MB ó el documento no tiene contenido", "info");
                                                                                }
                                                                                ;
                                                                                if (x == 4) {
                                                                                    showAlert("red", "Información..!", "Solo se permiten documentos en formato pdf ò xls / xlsx", "info");
                                                                                }
                                                                                ;
                                                                                if (x == 5) {
                                                                                    showAlert("red", "Información..!", "El Disco esta lleno", "info");
                                                                                    setTimeout("redirect()", 1000);
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

                                                                    function setDirectorie(directorio) {
                                                                        $("#name_directorie").val(directorio);
                                                                    }

                                                                    function setRuta(directorio) {
                                                                        $("#ruta").val("../" + directorio);
                                                                    }

                                                                    function  cleanModal(campo) {
                                                                        $("#" + campo).val("");
                                                                    }

                                                                    function  cleanModalDrop(campo) {
                                                                        $("#drop").html("<input type='hidden' id='opcH' name='opcH'/><input type='hidden' id='pos' name='pos'/><input type='hidden' id='action' name='action'/><input type='hidden' id='update' name='update'/><div class='dz-default dz-message'><span>Arrastre hasta aqui los archivos que desea subir..!</span></div>");
                                                                    }


                                                                    function setOpc() {
                                                                        $("#opcH").val($('input:radio[name=opc]:checked').val());
                                                                        //$("#formulario").submit();

                                                                    }

                                                                    function setPos() {
                                                                        $("#pos").val($("#number").val());
                                                                        //$("#formulario").submit();

                                                                    }

                                                                    function setIdUpdate(id) {
                                                                        $("#update").val(id);
                                                                    }


                                                                    function setAction(action) {
                                                                        $("#action").val(action);
                                                                    }



                                                                    function setIdTodelete(id) {
                                                                        $("#id_delete").val(id);

                                                                    }


                                                                    function redirect() {
                                                                        window.location.href = "chargedImages.php";
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

                                                                    function deleteDirectories() {
                                                                        var directorio = $("#name_directorie").val();
                                                                        if (directorio != "") {
                                                                            var parametros = {"directorio": directorio};
                                                                            $.ajax({
                                                                                data: parametros,
                                                                                url: 'Model/deleteDirectoriosModel.php',
                                                                                type: 'post',
                                                                                beforeSend: function () {
                                                                                    //$("#responseKm").html("...");
                                                                                },
                                                                                success: function (response) {
                                                                                    if (response == 1) {
                                                                                        showAlert("green", "Información..!", "El Directorio fue eliminado con éxito", "info");
                                                                                        $("#name_directorie").val("");
                                                                                        $("#tempClose").trigger("click");
                                                                                        setTimeout("redirect()", 1000);
                                                                                        /*$.ajax({                            
                                                                                         url:   'Model/PartialTableDirectories.php',
                                                                                         type:  'post',
                                                                                         beforeSend: function () {
                                                                                         //$("#responseKm").html("...");
                                                                                         },
                                                                                         success:  function (table) {
                                                                                         //$("#listDirectorios").html(table);  
                                                                                         
                                                                                         }
                                                                                         }); */
                                                                                    } else if (response == 2) {
                                                                                        showAlert("blue", "Aviso..!", "El directorio no esta  vacio", "danger");
                                                                                        $("#name_directorie").val("");
                                                                                    } else {
                                                                                        showAlert("red", "Aviso..!", "Ocurrio un error al eliminar el directorio", "danger");
                                                                                        $("#name_directorie").val("");
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            showAlert("red", "Aviso..!", "El campo Directorio es requerido", "danger");
                                                                            $("#name_directorie").focus();
                                                                        }

                                                                    }


                                                                    function viewToUpdate(id) {

                                                                        var parametros = {"id": id};
                                                                        $.ajax({
                                                                            data: parametros,
                                                                            url: 'Model/formUpdateImages.php',
                                                                            type: 'post',
                                                                            beforeSend: function () {
                                                                                //$("#responseKm").html("...");
                                                                            },
                                                                            success: function (response) {
                                                                                $("#resultFiles").html(response);

                                                                            }
                                                                        });


                                                                    }


                                                                    function deleteImage() {
                                                                        var id = $("#id_delete").val();
                                                                        var parametros = {"id": id};
                                                                        $.ajax({
                                                                            data: parametros,
                                                                            url: 'Model/deleteImage.php',
                                                                            type: 'post',
                                                                            beforeSend: function () {
                                                                                //$("#responseKm").html("...");
                                                                            },
                                                                            success: function (response) {
                                                                                console.log(response);
                                                                                if (response == 1) {
                                                                                    redirect();
                                                                                } else {
                                                                                    showAlert("red", "Aviso..!", "Error al eliminar la imagen", "danger");
                                                                                }
                                                                            }
                                                                        });


                                                                    }


                                                                    function redireccionarPagina(pagina) {
                                                                        window.location.href = pagina;
                                                                    }



                                                                    function savePerfil() {
                                                                        var perfilS = $("#PerfilS").val();
                                                                        if (perfilS != "") {
                                                                            var parametros = {"perfil": perfilS};
                                                                            $.ajax({
                                                                                data: parametros,
                                                                                url: 'Model/savePerfil.php',
                                                                                type: 'post',
                                                                                beforeSend: function () {
                                                                                    //$("#responseKm").html("...");
                                                                                },
                                                                                success: function (response) {
                                                                                    if (response == 1) {
                                                                                        $("#tempClose2").trigger("click");
                                                                                        showAlert("green", "Información..!", "El Perfil fue creado con éxito", "info");
                                                                                        setTimeout("redireccionarPagina('AsignarPermisos.php')", 1000);
                                                                                    } else if (response == 2) {
                                                                                        showAlert("blue", "Información..!", "El Perfil ya existe", "info");
                                                                                        $("#PerfilS").val("");
                                                                                    } else {
                                                                                        showAlert("red", "Aviso..!", "Ocurrio un error al crear el perfil", "danger");
                                                                                        $("#tempClose2").trigger("click");
                                                                                        $("#PerfilS").val("");
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            showAlert("red", "Aviso..!", "El campo perfil no debe estar vacio..!", "danger");
                                                                        }


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
