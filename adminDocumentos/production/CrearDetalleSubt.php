<?php
session_start();
unset($_SESSION['objectl']);
include ("Model/Conex.php");
$conexion = new Conex("expresop_vultra");
$object = $conexion->findById("subtitulo_conv", "id", $_GET['id'], "One");
$conexion->desconectar();
$_SESSION['id'] = $_GET['id'];
if ($object->detalle != "") {
    $detalle = explode(",", $object->detalle);
    $_SESSION['objectl'] = $detalle;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear Items Subtitulo</title>
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
                                <h5>Crear Items Para:</h5>
                                <h5>"<?php echo $_GET['subtitulo'] ?>"</h5>
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
                                                        <th>Acciones</th>   
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTable">
                                                    <?php
                                                    if (isset($_SESSION['objectl']) && count($_SESSION['objectl']) > 0) {


                                                        for ($index = 0; $index < count($_SESSION['objectl']); $index++) {
                                                            ?>
                                                            <tr>  
                                                                <td style = "vertical-align: middle"><?php echo $_SESSION['objectl'][$index] ?></td> 
                                                                <td style = "vertical-align: middle">
                                                                    <a data-placement="top"  title="Editar Item" data-toggle="tooltip">
                                                                        <span style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#viewFiles" onclick="viewToUpdate(<?php echo $_GET['id'] ?>,<?php echo $index ?>, '<?php echo $_SESSION['objectl'][$index] ?>', 1)"  class="fa fa fa-pencil"></span></a> | 
                                                                    <a data-placement="right" title="Eliminar Item" data-toggle="tooltip">
                                                                        <span class="fa fa-eraser" 
                                                                              style="font-size:15px;cursor:pointer;display:inline-block" 
                                                                              data-toggle="modal" data-target="#ConfirmDelete"
                                                                              onclick="viewToUpdate(<?php echo $_GET['id'] ?>,<?php echo $index ?>, '<?php echo $_SESSION['objectl'][$index] ?>', 2)">
                                                                        </span>
                                                                    </a>
                                                                </td> 
                                                            </tr>  
                                                        <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <div class="ln_solid"></div>


                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="button" class="btn btn-primary" onclick="redireccionarPagina('ListSubtitulos.php?id=<?php echo $_GET['back2']; ?>&titulo=<?php echo $_GET['back']; ?>')">Regresar</button>
                                                    <button type="button" class="btn btn-success" onclick="saveParrafo()">Guardar</button>                          
                                                </div>
                                            </div>

                                        </form>
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
                                    <h4 class="modal-title" id="myModalLabel2">Item a actualizar</h4>
                                </div>
                                <div class="modal-body" id="resultFiles">
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">
                                                Descripcion
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input style="font-size: 12px;width: 150%;" type="text" id="descU" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="pos" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="id_update" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="save" type="button" class="btn btn-success" onclick="updateItem(1)" >Guardar</button> 
                                    <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal()">Cerrar</button>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modals view-->




                    <!-- Small modal delete-->
                    <div class="modal fade bs-example-modal-sm" id="ConfirmDelete" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="width:500px !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Item a Eliminar</h4>
                                </div>
                                <div class="modal-body" id="resultFiles">
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">
                                                Descripcion
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input disabled style="font-size: 12px;width: 150%;" type="text" id="descU2" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="pos2" class="form-control col-md-7 col-xs-12">
                                                <input type="hidden" id="id_delete" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="save" type="button" class="btn btn-danger" onclick="updateItem(2)" >Eliminar</button> 
                                    <button id="tempClose" type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal()">Cerrar</button>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modals delete-->



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

                                            var campos = {"desc": desc, "opc": opc};
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
                                                url: 'Model/addDetalleSubtitulo.php',
                                                type: 'post',
                                                beforeSend: function () {
                                                    //$("#responseKm").html("...");
                                                },
                                                success: function (response) {
                                                    $("#bodyTable").html(response);
                                                    if (opc == 1) {
                                                        $("#desc").val("");
                                                    } else {
                                                        $("#desc").val("");
                                                        redirect2("CrearDetalleSubt.php?id=<?php echo $_GET['id']; ?>&subtitulo=<?php echo $_GET['subtitulo']; ?>&back=<?php echo $_GET['back']; ?>&back2=<?php echo $_GET['back2']; ?>");
                                                    }
                                                }
                                            });
                                        }

                                        function saveParrafo() {
                                            $.ajax({
                                                data: "",
                                                url: 'Model/saveDetalleSubti.php',
                                                type: 'post',
                                                beforeSend: function () {
                                                    //$("#responseKm").html("...");
                                                },
                                                success: function (response) {
                                                    if (response == 1) {
                                                        showAlert("green", "Información..!", "Items creados o actualizados con éxito", "info");
                                                        setTimeout("redirect()", 2000);
                                                    } else {
                                                        showAlert("red", "Aviso..!", "Ocurrio un error al crear o actualizar los items", "info");
                                                        setTimeout("redirect2()", 2000);
                                                    }
                                                }
                                            });
                                        }


                                        function viewToUpdate(id, pos, item, opc) {
                                            if (opc == 1) {
                                                $("#descU").val(item);
                                                $("#pos").val(pos);
                                                $("#id_update").val(id);
                                            } else {
                                                $("#descU2").val(item);
                                                $("#pos2").val(pos);
                                                $("#id_delete").val(id);
                                            }
                                        }







                                        function updateItem(opc) {
                                            var desc, pos, id, msn, msn2;
                                            if (opc == 1) {
                                                desc = $("#descU").val();
                                                pos = $("#pos").val();
                                                id = $("#id_update").val();
                                                msn = "Item actualizado con éxito";
                                                msn2 = "Ocurrio un error al actualizar el item";

                                            } else {
                                                desc = $("#descU2").val();
                                                pos = $("#pos2").val();
                                                id = $("#id_delete").val();
                                                msn = "Item eliminado con éxito";
                                                msn2 = "Ocurrio un error al eliminar el item";
                                            }

                                            var campos = {"desc": desc, "pos": pos, "id": id, "opc": opc};
                                            $.ajax({
                                                data: campos,
                                                url: 'Model/updateItem.php',
                                                type: 'post',
                                                beforeSend: function () {
                                                    //$("#responseKm").html("...");
                                                },
                                                success: function (response) {
                                                    if (response == 1) {
                                                        showAlert("green", "Información..!", msn, "info");
                                                        setTimeout("redirect()", 2000);
                                                    } else {
                                                        showAlert("red", "Aviso..!", msn2, "info");
                                                        setTimeout("redirect()", 2000);
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
                                            window.location.href = "CrearDetalleSubt.php?id=<?php echo $_GET['id']; ?>&subtitulo=<?php echo $_GET['subtitulo']; ?>&back=<?php echo $_GET['back']; ?>&back2=<?php echo $_GET['back2']; ?>";
                                        }

                                        function redirect2(pagina) {
                                            window.location.href = pagina;
                                        }

                                        function redireccionarPagina(pagina) {
                                            window.location.href = pagina;
                                        }

                                        function setIdconvenio(id) {
                                            $("#convenio").val(id);
                                        }




                                        function cleanModal() {
                                            $("#descU").val("");
                                            $("#pos").val("");
                                            $("#id_update").val("");
                                        }






        </script>


    </body>
</html>
