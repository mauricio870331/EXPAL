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
  include ("Model/funciones_mysql.php");
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
                <h3>Listado de Dirtectorios</h3>
              </div>
               <div class="title_right"> 
                <div id="#progresB">
                 <?php 
                     $totalUsado_mb = 0;
                     $classBar="progress-bar-success";
                     $conexion = conectar("expresop_convenios");                           
                     $sqlt = "SELECT sum(size_doc) FROM tbl_documentos";
                     $resultado = ejecutar($sqlt,$conexion);
                     if (mysql_num_rows($resultado)>0) { 
                       if ($campo = mysql_fetch_row($resultado)){
                          $bytes=$campo[0];
                          $totalUsado_mb = $bytes / 1000000; 
                        }
                        $porcientoMegas = (round(number_format($totalUsado_mb, 5, '.',','))/500)*100 ;
                        if ($porcientoMegas>=60 && $porcientoMegas<=80) {
                          $classBar="progress-bar-warning";
                        }
                        if ($porcientoMegas>80) {
                          $classBar="progress-bar-danger";
                        }
                     }
                     ?>
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">                 
                  Espacio total: 500Mb -- Usado: <?php  echo  number_format($totalUsado_mb, 1, '.',',')."Mb" ?>
                  <div class="progress" data-placement="bottom"  title="<?php echo 'Espacio del disco utilizado: '.$porcientoMegas.'%' ?>" data-toggle="tooltip">
                        <div class="progress-bar <?php echo $classBar ?>" data-transitiongoal="<?php  echo  $porcientoMegas; ?>"></div>
                  </div>                  
                </div>
              </div>
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
                          <th>Directorio</th>
                          <th>Ruta</th> 
                          <th><span class="fa fa-wrench"></span> Acciones</th>                         
                        </tr>
                      </thead>
                      <tbody id="listDirectorios">
                        <?php 
                            $directorio = "../Documentos";                           
                            function listar_directorios_ruta($ruta){ 
                              $directorios = array();
                             // abrir un directorio y listarlo recursivo 
                             if (is_dir($ruta)) {     
                                if ($dh = opendir($ruta)) { 
                                  $carpeta = @scandir($ruta); 
                                  if (count($carpeta) > 2){
                                     $objectDir = array();                                
                                     while (($file = readdir($dh)) !== false) { 
                                      //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                                      //mostraría tanto archivos como directorios 
                                      //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);     
                                      if (is_dir($ruta . $file) && $file!="." && $file!=".."){
                                         $objectDir['ruta']= $ruta;
                                         $objectDir['nombre']= $file;
                                         $objectDir['tipo']= "dir";
                                         array_push($directorios,$objectDir);
                                         //solo si el archivo es un directorio, distinto que "." y ".."                 
                                         //echo "<li> $file/ &nbsp<i class='fa fa-folder-o'></i></li>"; 
                                         //listar_directorios_ruta($ruta . $file . "/"); 
                                      } 
                                      if (is_file($ruta . $file) && $file!="." && $file!=".."){
                                          $objectDir['ruta']= $ruta;
                                          $objectDir['nombre']= $file;
                                          $objectDir['tipo']= "file";
                                          $objectDir['ext']= end( explode('.', $file));
                                          array_push($directorios,$objectDir); 
                                         //solo si el archivo es un directorio, distinto que "." y ".."                 
                                         //echo "<li>$file &nbsp<i class='fa fa-file-o'></i></li>";  
                                         //listar_directorios_ruta($ruta . $file . "/"); 
                                      } 
                                    }                                    
                                    closedir($dh);                                     
                                  }//else{echo "<ul><li>El directorio esta vacio</li></ul>";}
                                
                                } 
                             }//else {echo "<br>No es ruta valida"; }
                             return $directorios;
                          }                         
                          $directorios = listar_directorios_ruta($directorio."/");                      
                              if (count($directorios)>0) {                                
                                  foreach ($directorios as $key => $objDir) {  
                                            $tip = $objDir['tipo'];
                                            if ($tip=="dir") {
                                              $icon="fa fa-folder-o";
                                            } else{
                                              $icon="fa fa-file-o";
                                            }                                 
                                  ?>                              

                                    <tr>
                                     <td style="font-size:14px"><i class='<?php echo $icon; ?>'>&nbsp;</i><?php echo $objDir['nombre'] ?></td>
                                    <td><?php echo $objDir['ruta'].$objDir['nombre'] ?></td>     
                                    <td>
                                    <?php if ($tip=="dir") { ?>
                                      <a data-placement="left"  title="Ver ó Crear Sub-Directorio" data-toggle="tooltip" href="Model/CrearSubdirectorios.php?token=<?php echo base64_encode("../".$objDir['ruta'].$objDir['nombre']); ?>&ping=<?php echo base64_encode($objDir['nombre']); ?>"><span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa-plus-square"></span></a> | 

                                      <a data-placement="bottom"  title="Subir Documento" data-toggle="tooltip"><span  style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#newDocument" onclick="setRuta('<?php echo $objDir['ruta'].$objDir['nombre']; ?>')"  class="fa fa-cloud-upload"></span></a> | 

                                      <a data-placement="top"  title="Ver Contenido" data-toggle="tooltip"><span style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#viewFiles" onclick="viewDirectorie('<?php echo "../".$objDir['ruta'].$objDir['nombre'] ?>')"  class="fa fa fa-eye"></span></a> | 

                                      <a data-placement="right"  title="Eliminar Directorio" data-toggle="tooltip"> <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#ConfirmDelete" onclick="setDirectorie('<?php echo $objDir['ruta'].$objDir['nombre']; ?>')" ></span></a>
                                      </td> 
                                      <?php }?>                                        
                                      <?php if ($tip=="file") { 
                                                if ($objDir['ext']=="PDF" || $objDir['ext']=="pdf") {                   
                                               
                                        ?>
                                        <a href="Model/viewFile.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank"><span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa-eye" data-placement="bottom"     title="Ver Documento" data-toggle="tooltip" ></span></a> | 
                                        <?php
                                          }else{
                                         ?> 
                                          <a href="Model/downloadFiles.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank"><span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa-cloud-download" data-placement="bottom"     title="Descargar Documento" data-toggle="tooltip" ></span></a> |
                                          <?php } ?>       
                                        <a data-placement="bottom"  title="Eliminar Documento" data-toggle="tooltip">
                                        <span class="fa fa-eraser" style="font-size:15px;cursor:pointer;display:inline-block" data-toggle="modal" data-target="#docModal" onclick="setDocument('<?php echo $objDir['ruta'] ?>', '<?php echo $objDir['nombre']; ?>')" ></span></a>
                                       </td> 
                                      <?php  }?>                                                                            
                                    </tr>  

                                  <?php 
                                  }                               
                              }else{
                                ?>
                                  <tr>
                                    <td colspan="3">
                                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <strong>No hay directorios</strong>
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
                          <h4 class="modal-title" id="myModalLabel2">Eliminar Directorios</h4>
                        </div>
                        <div class="modal-body">
                          <h5><b>Esta Seguro de Eliminar el directorio..?<b></h5>  
                           <input type="hidden" id="name_directorie">                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal(name_directorie)">Cancelar</button>
                          <button type="button" class="btn btn-primary" onclick="deleteDirectories();" >Eliminar</button>
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
                                          <input type="hidden" id="ruta" name="ruta"/>
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
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleanModal(PerfilS)">Cancelar</button>
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
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
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
      $(document).ready(function() {
       Dropzone.autoDiscover = false;
       $(".uploadform").dropzone({        
        url: 'Model/uploadFiles.php',
        //maxFiles: 1, // Number of files at a time
        maxFilesize: 4, //in MB
        maxfilesexceeded: function(file)
        {
          alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
        },
        success: function (response) {
       var x = JSON.parse(response.xhr.responseText);      
        if (x==1) {
          showAlert("green", "Información..!","Documento Subido con éxito","info");   
          setTimeout("redirect()", 1000);        
        };
        if (x==0) {
          showAlert("red", "Información..!","El documento supera el tamaño Máximo permitido de 4MB","info");
        };
        if (x==2) {
          showAlert("blue", "Información..!","El documento ya existe en este directorio","info");
        };
        if (x==3) {
          showAlert("red", "Información..!","El documento supera el tamaño Máximo permitido de 4MB ó el documento no tiene contenido","info");
        };
        if (x==4) {
          showAlert("red", "Información..!","Solo se permiten documentos en formato pdf ò xls / xlsx","info");
        };
        if (x==5) {
          showAlert("red", "Información..!","El Disco esta lleno","info");
          setTimeout("redirect()", 1000); 
        };
        $('.icon').hide(); // Hide Cloud icon
        $('#uploader').modal('hide'); // On successful upload hide the modal window
        $('.img').attr('src',x.img); // Set src for the image
        $('.thumb').attr('src',x.thumb); // Set src for the thumbnail
        $('img').addClass('imgdecoration');
        this.removeAllFiles(); // This removes all files after upload to reset dropzone for next upload
        console.log(x); // Just to return the JSON to the console.
        },
        addRemoveLinks: true,
        removedfile: function(file) {
        var _ref; // Remove file on clicking the 'Remove file' button
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
        });  
       
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

     function setDirectorie(directorio){ 
        $("#name_directorie").val(directorio);         
     } 

      function setRuta(directorio){ 
         $("#ruta").val("../"+directorio);         
     }   

     function  cleanModal(campo){  
      $("#"+campo).val("");      
     } 

     function  cleanModalDrop(campo){      
         $("#drop").html("<input type='hidden' id='ruta' name='ruta'/><div class='dz-default dz-message'><span>Arrastre hasta aqui los archivos que desea subir..!</span></div>");      
     } 


 function redirect(){  
   window.location.href = "ListarDirectorios.php";
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

      function deleteDirectories(){  
         var directorio = $("#name_directorie").val();        
         if (directorio!="") {
             var parametros = {"directorio" : directorio};
              $.ajax({
                data:  parametros,
                url:   'Model/deleteDirectoriosModel.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {                                                                
                    if(response==1){
                      showAlert("green", "Información..!","El Directorio fue eliminado con éxito","info");
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
                    }else if(response==2){                     
                      showAlert("blue", "Aviso..!","El directorio no esta  vacio","danger");
                      $("#name_directorie").val("");  
                    } else{                      
                    showAlert("red", "Aviso..!","Ocurrio un error al eliminar el directorio","danger");
                    $("#name_directorie").val("");                   
                  }                  
                }
              });
        }else{
          showAlert("red", "Aviso..!","El campo Directorio es requerido","danger");
          $("#name_directorie").focus();
        }

      }  


       function viewDirectorie(directorio){          
        
             var parametros = {"directorio" : directorio};
              $.ajax({
                data:  parametros,
                url:   'Model/viewFilesInDirectorio.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {                 
                      $("#resultFiles").html(response);     
                                  
                }
              });
        

      }  

      function redireccionarPagina(pagina) {
        window.location.href = pagina;  
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
                    if(response==1){
                       $("#tempClose2").trigger("click"); 
                        showAlert("green", "Información..!","El Perfil fue creado con éxito","info"); 
                          setTimeout("redireccionarPagina('AsignarPermisos.php')", 1000);                                                        
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


      function oculto(){        
        if(!$('#newDocument').is(":visible") ){
            cleanModalDrop();            
        }
      }
  

      

    </script>
    <!-- /Datatables -->
  </body>
</html>
