<?php 
  session_start(); 
  if (empty($_SESSION['descripcion'])){
    header('Location: index.php');
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
    <title>Admin Documentos</title>
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
              <a href="ListarDocumentos.php" class="site_title"><span>Inicio</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                <?php if ($_SESSION['descripcion']=="Admin") { ?>
                 <li><a><i class="fa fa-folder"></i> Directorios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ListarDirectorios.php">Listar</a></li>
                      <li><a href="CrearDirectorios.php">Crear</a></li>                      
                      </ul>
                  </li>
                  <?php } ?>
                  <li><a><i class="fa fa-file-text"></i> Documentos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ListarDocumentos.php">Listar</a></li>                                        
                    </ul>
                  </li>   
                  <?php if ($_SESSION['descripcion']=="Admin") { ?>              
                  <li><a><i class="fa fa-lock"></i> Permisos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ListarPermisos.php">Listar</a></li>     
                      <li><a href="AsignarPermisos.php">Asignar</a></li>  
                      <li><a data-toggle="modal" data-target="#crearPerfil" >Crear Perfil</a></li>                     
                    </ul>
                  </li> 
                  <?php } ?>                 
                </ul>
              </div>
             

            </div>
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

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.png" alt=""><?php echo $_SESSION['descripcion']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">                    
                    <li><a href="Model/cerrarSession.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Listado de Documentos</h3>
              </div>             
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">                  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Directorio</th>
                          <th>Documento</th> 
                          <th>Fecha Creación</th> 
                          <th><span class="fa fa-wrench"></span> Acciones</th>                         
                        </tr>
                      </thead>
                      <tbody id="listDocuments">
                            <?php 
                              include ("Model/funciones_mysql.php");
                              $conexion = conectar("expresop_convenios");  
                              if ($_SESSION['descripcion']=="Admin") {                         
                                   $sql = "SELECT d.nom_directorio,
                                                  d2.nombre_doc,
                                                  d2.fecha_creacion,
                                                   d2.id_doc,
                                                    d2.id_directorio,
                                                     d.ruta_directorio,
                                                     d2.nombre_doc 
                                      FROM tbl_directorios d INNER JOIN  tbl_documentos d2
                                      ON d.id_directorio = d2.id_directorio ORDER BY d.nom_directorio";
                              }else{
                                $sql = "SELECT d.nom_directorio, d2.nombre_doc, d2.fecha_creacion, d2.id_doc, d2.id_directorio, d.ruta_directorio, d2.nombre_doc  
                                        FROM tbl_directorios d 
                                        INNER JOIN  tbl_documentos d2 ON d.id_directorio = d2.id_directorio
                                        INNER JOIN  tbl_documentos_utemp t3  ON d2.id_doc = t3.id_doc WHERE t3.id_utemp = ". $_SESSION['id_utemp']."  ORDER BY d.nom_directorio";
                              }
                              $resultado = ejecutar($sql,$conexion);
                              if (mysql_num_rows($resultado)>0) { 
                                while ($campo = mysql_fetch_row($resultado)){
                                  ?>
                                   <tr>
                                    <td><b><?php echo $campo[0] ?></b></td>
                                    <td><?php echo $campo[1] ?></td>   
                                    <td><?php echo $campo[2] ?></td>  
                                    <td>                                    
                                      <a data-placement="bottom"  title="Ver Documento" data-toggle="tooltip" href="Model/viewFile.php?directorio=<?php echo $campo[4]; ?>&documento=<?php echo $campo[3]; ?>" target="_blank"><span style="font-size:15px;cursor:pointer;" class="fa fa-eye"></span></a> | 
                                      <?php if ($_SESSION['descripcion']=="Admin") { ?>
                                       <a data-placement="bottom"  title="Descargar Documento" data-toggle="tooltip" href="Model/downloadFiles.php?directorio=<?php echo $campo[4]; ?>&documento=<?php echo $campo[3]; ?>" target="_blank"><span style="font-size:15px;cursor:pointer;" class="fa fa-cloud-download"></span></a> | 
                                      <a data-placement="bottom"  title="Eliminar Documento" data-toggle="tooltip"><span class="fa fa-eraser" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#ConfirmDelete" onclick="setDirectorie(<?php echo $campo[4]; ?>,<?php echo $campo[3]; ?>)" ></span></a>
                                       <?php } ?>
                                      </td>                             
                                  </tr>  
                                  <?php                                
                                }
                              }else{
                                ?>
                                  <tr>
                                    <td colspan="4">
                                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <strong>No hay resultados</strong>
                                      </div>
                                    </td>
                                  </tr>
                                <?php
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
                          <h4 class="modal-title" id="myModalLabel2">Eliminar Documentos</h4>
                        </div>
                        <div class="modal-body">
                          <h6><b>Esta Seguro de Eliminar el Documento..?<b></h6>  
                           <input type="hidden" id="idDir">   
                           <input type="hidden" id="idDoc">                      
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal()">Cancelar</button>
                          <button type="button" class="btn btn-primary" onclick="deleteDocument();" >Eliminar</button>
                          <input type="hidden" data-dismiss="modal" id="tempClose">
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->   

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
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal()">Cancelar</button>
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
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
         var handleDataTableButtons = function() {
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

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
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
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });

     function setDirectorie(directorio, documento){ 
        $("#idDir").val(directorio);   
        $("#idDoc").val(documento);         
     } 

     function  cleanModal(campo){ 
       $("#PerfilS").val("");  
       $("#idDir").val("");   
       $("#idDoc").val("");      
     } 

       function showAlert(color, titulo, cuerpo, icono){
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
            before_close: function(PNotify) {
              PNotify.update({
                title: PNotify.options.title + " - Enjoy your Stay",
                before_close: null
              });
              PNotify.queueRemove();
              return true;
            }
          });
        }  

      function deleteDocument(){  
         var directorio = $("#idDir").val();   
         var documento = $("#idDoc").val();     
        
             var parametros = {"directorio" : directorio, "documento":documento};
              $.ajax({
                data:  parametros,
                url:   'Model/deleteDocumentos.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {    
                  console.log(response) ;                                             
                    if(response==1){
                      showAlert("green", "Información..!","El Documento fue eliminado con éxito","info");
                      $("#idDir").val(""); 
                      $("#idDoc").val("");    
                      $("#tempClose").trigger("click");
                        $.ajax({                            
                            url:   'Model/PartialTableDocuments.php',
                            type:  'post',
                            beforeSend: function () {
                              //$("#responseKm").html("...");
                            },
                            success:  function (table) {
                              $("#listDocuments").html(table);                                                                            
                            }
                          });                      
                    }else if(response==2){                     
                      showAlert("blue", "Aviso..!","El Docuemnto no Existe","danger");
                      $("#tempClose").trigger("click");
                      $("#idDir").val("");  
                      $("#idDoc").val("");
                    } else{                      
                    showAlert("red", "Aviso..!","Ocurrio un error al eliminar el directorio","danger");
                      $("#tempClose").trigger("click");
                      $("#idDir").val("");  
                      $("#idDoc").val("");                 
                  }                  
                }
              });
       
      }  


       function viewFile(directorio, documento){          
        
             var parametros = {"directorio" : directorio, "documento":documento};
              $.ajax({
                data:  parametros,
                url:   'Model/downloadFiles.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {                  
                      $("#resultFiles").html(response);                      
                                  
                }
              });
        

      }  



      function redireccionarPagina() {
        window.location.href = "AsignarPermisos.php";  
      }



      function savePerfil(){  
         var perfilS = $("#PerfilS").val();           
         if (perfilS!="") {
             var parametros = {"perfil" : perfilS };
              $.ajax({
                data:  parametros,
                url:   'Model/savePerfil.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {    
                  console.log(response) ;                                             
                    if(response==1){
                       $("#tempClose2").trigger("click"); 
                      showAlert("green", "Información..!","El Perfil fue creado con éxito","info"); 
                          setTimeout("redireccionarPagina()", 1000);                                                        
                    }else if(response==2){
                      showAlert("blue", "Información..!","El Perfil ya existe","info");
                      $("#PerfilS").val("");                                                           
                    } else{                      
                    showAlert("red", "Aviso..!","Ocurrio un error al crear el perfil","danger");
                    $("#tempClose2").trigger("click");
                    $("#PerfilS").val("");                   
                  }                  
                }
              });
            }else{
               showAlert("red", "Aviso..!","El campo perfil no debe estar vacio..!","danger");
            }
        

      } 

      

      

    </script>
    <!-- /Datatables -->
  </body>
</html>
