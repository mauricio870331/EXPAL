<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findById("subtitulo_conv", "id_header", $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista Subtitulos </title>
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
                                <h5> 
                                    Titulo Seleccionado:
                                </h5>
                                <h5> 
                                    "<?php echo $_GET['titulo']; ?>"  
                                </h5>
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
                                                    <th>Subtitulo</th>                                                   
                                                    <th><span class="fa fa-wrench"></span> Acciones</th>                         
                                                </tr>
                                            </thead>
                                            <tbody id="listDirectorios">
                                                <?php
                                                if ($conexion->getTotalFilas() > 0) {
                                                    foreach ($object as $value) {
                                                        ?>  
                                                        <tr>                                                          
                                                            <td style="vertical-align: middle"><?php echo $value->descripcion ?></td> 
                                                            <td style="vertical-align: middle"> 
                                                                <a href="ListdetalleSubtitulo.php?id=<?php echo $value->id ?>&subtitulo=<?php echo $value->descripcion ?>&back=<?php echo $_GET['titulo']; ?>&back2=<?php echo $_GET['id'] ?>" data-placement="top"  title="Ver Detalle" data-toggle="tooltip"><span style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa fa-eye"></span></a> | 

                                                                <a href="CrearDetalleSubt.php?id=<?php echo $value->id ?>&subtitulo=<?php echo $value->descripcion ?>&back=<?php echo $_GET['titulo']; ?>&back2=<?php echo $_GET['id'] ?>" data-placement="top"  title="Agregar detalle al subtitulo" data-toggle="tooltip"><span style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa fa-plus"></span></a> | 

                                                                <a data-placement="top"  title="Editar" data-toggle="tooltip">
                                                                    <span style="font-size:15px;cursor:pointer;display:inline-block"
                                                                          data-toggle="modal" data-target="#viewFiles" 
                                                                          onclick="viewToUpdate('<?php echo $value->id ?>', '<?php echo $value->descripcion ?>')" 
                                                                          class="fa fa fa-pencil"></span></a> | 

                                                                <a data-placement="right"  title="Eliminar" 
                                                                   data-toggle="tooltip">
                                                                    <span class="fa fa-eraser"
                                                                          style="font-size:15px;cursor:pointer;display:inline-block"
                                                                          data-toggle="modal" data-target="#ConfirmDelete"
                                                                          onclick="setIdTodelete('<?php echo $value->id ?>')" ></span></a>
                                                            </td>                                                                                                                
                                                        </tr>  

                                                        <?php
                                                    }
                                                }
                                                $conexion->desconectar();
                                                ?>                                          
                                            </tbody>
                                        </table>                     


                                    </div>

                                </div>
                                <button type="button" class="btn btn-primary" onclick="redireccionarPagina('ListTitulos.php')">Regresar</button>
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
                                    <h4 class="modal-title" id="myModalLabel2">Eliminar Subtitulo</h4>
                                </div>
                                <div class="modal-body">
                                    <h5><b>Esta Seguro de Eliminar el Subtitulo ?<b></h5>  
                                                <input type="hidden" id="id_delete">                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-danger" onclick="updateDeleteSubTitulo(2)" >Eliminar</button>
                                                    
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
                                                                <h4 class="modal-title" id="myModalLabel2">Editar Subtitulo</h4>
                                                            </div>
                                                            <div class="modal-body" id="resultFiles">
                                                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">
                                                                            Descripcion
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <textarea rows="4" cols="50" id="desc" class="form-control col-md-7 col-xs-12">
                                                                            </textarea>    

                                                                            <input id="id_update" type="hidden">
                                                                        </div>
                                                                    </div> 

                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
                                                                <button type="button" class="btn btn-success" onclick="updateDeleteSubTitulo(1)">Guardar</button>    
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

                                                                    function updateDeleteSubTitulo(opc) {
                                                                        var parametros, msn, msn2;
                                                                        if (opc == 1) {
                                                                            msn = "El Subtitulo se actualizo con exito";
                                                                            msn2 = "Error al actualizar el Subtitulo";
                                                                            parametros = {"id": $('#id_update').val(), "desc": $('#desc').val(), "opc": opc};
                                                                        } else {
                                                                            msn = "El Subtitulo se elimino con exito";
                                                                            msn2 = "Error al eliminar el Subtitulo";
                                                                            parametros = {"id": $('#id_delete').val(), "opc": opc};
                                                                        }

                                                                        $.ajax({
                                                                            data: parametros,
                                                                            url: 'Model/updateDeleteSubTitulo.php',
                                                                            type: 'post',
                                                                            beforeSend: function () {
                                                                                //$("#responseKm").html("...");
                                                                            },
                                                                            success: function (response) {
                                                                                console.log(response);
                                                                                if (response == 1) {
                                                                                    showAlert("green", "Aviso..!", msn, "success");
                                                                                    setTimeout("redirect()", 2000);

                                                                                } else {
                                                                                    showAlert("red", "Aviso..!", msn2, "danger");
                                                                                    setTimeout("redirect()", 2000);
                                                                                }
                                                                            }
                                                                        });

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
                                                                        window.location.href = "ListSubtitulos.php?id=<?php echo $_GET['id']; ?>&titulo=<?php echo $_GET['titulo']; ?>";
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


                                                                    function viewToUpdate(id, descripcion) {
                                                                        $('#id_update').val(id);
                                                                        $('#desc').val(descripcion);
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
