<?php 
  session_start(); 
  $inactivo = 3600;
  if (isset($_SESSION['tiempo'])) {
    $vida_session = time() - $_SESSION['tiempo'];
    if ($vida_session>$inactivo) {
      session_destroy();
      header('Location: index.php');
    }
  }
  $_SESSION['tiempo']=time();
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
    <title>Asignar Documentos - Perfil</title>
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
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
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
                      <li><a href="ListDirectories.php">Listar</a></li>                                        
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
                <h4>Asignar Documentos a Perfil</h4>
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
                          <th>Perfil</th>                                                   
                          <th><span class="fa fa-wrench"></span> Acciones</th>                         
                        </tr>
                      </thead>
                      <tbody id="listDocuments">
                            <?php 
                              include ("Model/funciones_mysql.php");
                              $conexion = conectar("expresop_convenios");                           
                              $sql = "SELECT * FROM  tbl_utemp  ORDER BY descripcion";
                              $resultado = ejecutar($sql,$conexion);
                              if (mysql_num_rows($resultado)>0) { 
                                while ($campo = mysql_fetch_row($resultado)){
                                  ?>
                                   <tr>                                    
                                    <td><?php echo $campo[1] ?></td>                                       
                                    <td>                                      
                                      <a data-placement="bottom"  title="Asignar Documentos" data-toggle="tooltip" href="Model/partialPerfilDoc.php?token=<?php echo base64_encode($campo[0]); ?>&ping=<?php echo base64_encode($campo[1]); ?>"><span  style="font-size:15px;cursor:pointer;" class="fa fa-plus-circle"></span></a> | 
                                      <a data-placement="bottom"  title="Eliminar Perfil" data-toggle="tooltip"><span class="fa fa-eraser" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#ConfirmDelete"  onclick="setPerfilToDelete(<?php echo $campo[0]; ?>)" ></span></a>
                                      | 
                                      <a data-placement="bottom"  title="Cambiar contraseña" data-toggle="tooltip"><span class="fa fa-lock" style="font-size:15px;cursor:pointer;" data-toggle="modal" data-target="#updatePass"  onclick="setPerfilToUpdate(<?php echo $campo[0]; ?>)" ></span></a>
                                      | 
                                      <a data-placement="right"  title="Contraseña Actual: <?php echo  $campo[2] ?>" data-toggle="tooltip"><span class="fa fa-key" style="font-size:15px;cursor:pointer;"></span></a>
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
                          <h4 class="modal-title" id="myModalLabel2">Eliminar Perfil</h4>
                        </div>
                        <div class="modal-body">
                          <h6><b>¿Ésta seguro de eliminar el perfil ?<br><br>Esta acción quitará todos los privilegios sobre documentos asociados a el.<b></h6>  
                           <input type="hidden" id="perfilToDelete">                                                
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal('perfilToDelete')">Cancelar</button>
                          <button type="button" class="btn btn-primary" onclick="deletePerfil();" >Eliminar</button>
                          <input type="hidden" data-dismiss="modal" id="tempClose">
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->      

                 <!-- Small modal -->
                   <div class="modal fade bs-example-modal-sm" id="updatePass" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="width:50%;">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Cambiar Contraseña</h4>
                        </div>
                        <div class="modal-body">
                              <form class="form-horizontal form-label-left">
                                <div class="form-group">
                                  <label class="control-label col-md-3" for="first-name">Contraseña Nueva: <span class="required">*</span>
                                  </label>
                                  <div class="col-md-7">
                                    <input type="text" id="Update" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="perfilToUpdate"> 
                                  </div>
                                </div>                               
                              </form>                                             
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModalU('perfilToUpdate', 'Update')">Cancelar</button>
                          <button type="button" class="btn btn-primary" onclick="UpdatePassword();" >Guardar</button>
                          <input type="hidden" data-dismiss="modal" id="tempClose3">
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



    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>

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
        $('#datatable2').dataTable();

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

     function setPerfilToDelete(perfil){ 
        $("#perfilToDelete").val(perfil);                   
     } 

    function setPerfilToUpdate(perfil){ 
        $("#perfilToUpdate").val(perfil);                   
     }

     function  cleanModal(campo){  
      $("#"+campo).val("");      
     } 

      function cleanModalU(campo, campo2){  
      $("#"+campo).val("");  
      $("#"+campo2).val("");     
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

      function deletePerfil(){  
         var perfilToDelete = $("#perfilToDelete").val();           
         
             var parametros = {"perfil" : perfilToDelete};
              $.ajax({
                data:  parametros,
                url:   'Model/deletePerfil.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {    
                  console.log(response) ;                                             
                    if(response==1){
                      showAlert("green", "Información..!","El Perfil fue eliminado con éxito","info");
                      $("#perfilToDelete").val("");                        
                      $("#tempClose").trigger("click");
                        $.ajax({                            
                            url:   'Model/PartialTablePerfil.php',
                            type:  'post',
                            beforeSend: function () {
                              
                            },
                            success:  function (table) {
                              $("#listDocuments").html(table);                                                                            
                            }
                          });                  
                    } else{                      
                    showAlert("red", "Aviso..!","Ocurrio un error al eliminar el perfil","danger");
                    $("#perfilToDelete").val("");                   
                  }                  
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


      function UpdatePassword(){  
         var Update = $("#Update").val(); 
         var perfil = $("#perfilToUpdate").val();                  
         if (Update!="") {
             var parametros = {"Update" : Update, "perfil" : perfil };
              $.ajax({
                data:  parametros,
                url:   'Model/UpdatePass.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {    
                  console.log(response) ;                                             
                    if(response==1){
                       $("#tempClose3").trigger("click"); 
                       showAlert("green", "Información..!","La contraseña se actualizó con éxito","info"); 
                          setTimeout("redireccionarPagina()", 1000);                                                        
                    } else{                      
                    showAlert("red", "Aviso..!","Ocurrio un error al actializar la contraseña","danger");
                    $("#tempClose3").trigger("click");
                    $("#Update").val("");   
                    $("#perfilToUpdate").val("");                 
                  }                  
                }
              });
            }else{
               showAlert("red", "Aviso..!","El campo Contraseña no debe estar vacio..!","danger");
                $("#Update").focus();
            }       

      }  



    </script>
    <!-- /Datatables -->
  </body>
</html>
