<?php
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("categorias_cupones");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de categorias</title>
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
                                <h4> 
                                    Listado de Categorias
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
                                                    <th>Id</th>
                                                    <th>Nombre</th>                                                                                                    
                                                    <th><span class="fa fa-wrench"></span> Acciones</th>                         
                                                </tr>
                                            </thead>
                                            <tbody id="listDirectorios">
                                                <?php
                                                if ($conexion->getTotalFilas() > 0) {
                                                    foreach ($object as $value) {
                                                        ?>  
                                                        <tr>                                                             
                                                            <td style="vertical-align: middle"><?php echo $value->id_categoria ?></td> 
                                                            <td style="vertical-align: middle"><?php echo $value->categoria ?></td> 

                                                            <td style="vertical-align: middle"> 
                                                                <a data-placement="top"  title="Actualizar Categoria" data-toggle="tooltip">
                                                                    <span style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                          data-toggle="modal" data-target="#viewFiles"
                                                                          onclick="viewToUpdate('<?php echo $value->id_categoria ?>', '<?php echo $value->categoria ?>', 1)"
                                                                          class="fa fa fa-pencil">
                                                                    </span>
                                                                </a> | 
                                                                <a data-placement="right"  title="Eliminar Categoria" data-toggle="tooltip">
                                                                    <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                          data-toggle="modal"
                                                                          data-target="#deleteCat"
                                                                          onclick="viewToUpdate('<?php echo $value->id_categoria ?>', '<?php echo $value->categoria ?>', 2)" ></span></a>
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



                    <!-- Small modal view-->
                    <div class="modal fade bs-example-modal-sm" id="viewFiles" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="width:500px !important;">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Actualizar Categoria</h4>
                                </div>
                                <div class="modal-body" id="resultFiles">
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">
                                                Categoria
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="cat" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="id_cat" class="form-control col-md-7 col-xs-12">

                                            </div>
                                        </div>                                                          


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="tempClose" type="button" class="btn btn-success" onclick="updateDelete(1)">Guardar</button>
                                    <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                            
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /modals view-->                                            


                    <!-- Small modal -->
                    <div class="modal fade bs-example-modal-sm" id="deleteCat" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="width:500px !important;">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Eliminar Categoria</h4>
                                </div>
                                <div class="modal-body" id="resultFiles">
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">
                                                Categoria
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input disabled type="text" id="catU" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="id_catU" class="form-control col-md-7 col-xs-12">

                                            </div>
                                        </div>                                                          


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="tempClose" type="button" class="btn btn-danger" onclick="updateDelete(2)">Eliminar</button>
                                    <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                            
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

                                        function  cleanModal(campo) {
                                            $("#" + campo).val("");
                                        }

                                        function redirect() {
                                            window.location.href = "ListCategorias.php";
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

                                        function viewToUpdate(id, categoria, opc) {
                                            if (opc == 1) {
                                                $("#id_cat").val(id);
                                                $("#cat").val(categoria);
                                            } else {
                                                $("#id_catU").val(id);
                                                $("#catU").val(categoria);
                                            }
                                        }

                                        function updateDelete(opc) {
                                            var id, categoria;
                                            if (opc == 1) {
                                                id = $("#id_cat").val();
                                                categoria = $("#cat").val();
                                            } else {
                                                id = $("#id_catU").val();
                                                categoria = $("#catU").val();
                                            }

                                            var campos = {"id": id, "categoria": categoria, "opc": opc};

                                            var msn = "Error al actualizar la categoria.";
                                            if (opc == 2) {
                                                msn = "Error al eliminar la categoria.";
                                            }
                                            $.ajax({
                                                data: campos,
                                                url: 'Model/updateDeletecat.php',
                                                type: 'post',
                                                beforeSend: function () {
                                                    //$("#responseKm").html("...");
                                                },
                                                success: function (response) {
                                                    console.log(response);
                                                    if (response == 1) {
                                                        redirect();
                                                    } else {
                                                        showAlert("red", "Aviso..!", msn, "danger");
                                                        if (opc == 1) {
                                                            $("#id_cat").val("");
                                                            $("#cat").val("");
                                                        } else {
                                                            $("#id_catU").val("");
                                                            $("#catU").val("");
                                                        }
                                                    }
                                                }
                                            });
                                        }

                                        function redireccionarPagina(pagina) {
                                            window.location.href = pagina;
                                        }

        </script>
        <!-- /Datatables -->
    </body>
</html>
