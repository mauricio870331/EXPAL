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
  }else{
    include ("Model/funciones_mysql.php");   
    $nom_directorio=base64_decode($_GET['ping']);
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
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                <?php if ($_SESSION['descripcion']=="Admin" || $_SESSION['descripcion']=="admintemp") { ?>
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
                  <?php if ($_SESSION['descripcion']=="Admin"  || $_SESSION['descripcion']=="admintemp") { ?>              
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
                <?php $dir_separate = explode("/", $nom_directorio); 
                      $cantdir=count($dir_separate)-1;
                      $leftdir = "";
                      $cont = 0;
                ?>
                <h4><a href="ListDirectories.php">Documentos <i class="fa fa-folder-open"></i></a>/
                    <?php foreach ($dir_separate as $key => $dir) {
                        if ($cont==0) {
                         $leftdir.=$dir_separate[$cont];
                        }else{
                          $leftdir.="/".$dir_separate[$cont];
                        }                        
                         if ($cont==$cantdir) {
                           $clsf = "fa fa-folder";                           
                           $ruta = "javascript: void(0)";
                         }else{
                          $clsf = "fa fa-folder-open";                            
                          $ruta = "ListContentDirectories.php?ping=".base64_encode($leftdir);                          
                         }
                     ?>
                       <a href="<?php echo $ruta ?>">
                       <?php echo $dir; ?> <i class="<?php echo $clsf; ?>"></i><?php if ($cont!=$cantdir) { echo "/"; }else { echo "";} ?></a>
                    <?php $cont++; } ?>
                   
                </h4>
              </div>              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">                  
                
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"><!---->

                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre</th>                          
                          <th><span class="fa fa-wrench"></span> Acciones</th>                         
                        </tr>
                      </thead>
                      <tbody id="listDirectorios">
                    <?php     
                    // $_SESSION['id_utemp'] -> prefil de usuario logeado                  
                    $directorio = "../Documentos/".$nom_directorio;                           
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
                                         $objectDir['fecha']=  date("Y-m-d H:i:s.", filectime($ruta . $file));
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
                                          $objectDir['fecha']=  date("Y-m-d H:i:s.", filectime($ruta . $file));
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
                         
                          $conexion = conectar("expresop_convenios"); 
                          if ($_SESSION['id_utemp']==15 || $_SESSION['id_utemp']==63) {
                            $sql2 = "SELECT id_doc,
                                            tipo_doc,
                                            nombre_doc,
                                            ruta
                                    FROM  tbl_documentos";
                          }else{
                             $sql2 = "SELECT t1.id_doc,
                                          t1.id_utemp,
                                          t2.nombre_doc,
                                          CONCAT(t2.ruta,'/',t2.nombre_doc),
                                          t2.ruta
                                   FROM  tbl_documentos_utemp t1  
                                   INNER JOIN tbl_documentos t2 ON t1.id_doc = t2.id_doc
                                   INNER JOIN tbl_utemp t3 ON t3.id_utemp = t1.id_utemp
                                   WHERE t3.id_utemp = ".$_SESSION['id_utemp']."";
                          }

                            $resultado2 = ejecutar($sql2,$conexion);
                            
                            $permisos = array();
                            $nomfile= array();
                            $rutas =  array();
                            while ($campo2 = mysql_fetch_row($resultado2)){
                                   $pos = strpos($campo2[4], $directorio);                            
                                   if ($pos!==false) {
                                        //validar si la ruta existe en el array permisos, si ya existe una coincidencia no ponerla
                                       if (!in_array($campo2[4],$permisos)) {
                                          $permisos[]=$campo2[4];   
                                       }
                                       $nomfile[]=$campo2[2];
                                    }                            
                            }                         
                              /*echo "<pre>";print_r($directorio); echo "</pre>"; 
                              echo "<pre>";print_r($directorios); echo "</pre>";
                              echo "<pre>";print_r($permisos); echo "</pre>";  
                            /*echo "<pre>";print_r($nomfile); echo "</pre>";  */  



                    //ruta ../Documentos/
                    //echo count($directorios)." ".count($permisos);
                  if (count($directorios)>0) {    
                       if ($_SESSION['id_utemp']==15 || $_SESSION['id_utemp']==63) {                        
                        foreach ($directorios as $key => $objDir) { //for 1                                                               
                          foreach ($permisos as $key => $value) {
                            $pos = strpos($value, $findme);
                            $pos2 = strpos($value, $findme2);
                            if (!$pos===false && !$pos2===false) {
                                $show = true;                                
                            }else{
                              $show = false;                              
                            }
                          }                                              
                        $tip = $objDir['tipo'];
                        if ($tip=="dir") {
                          $icon="fa fa-folder-o";
                        } else{
                          $icon="fa fa-file-o";
                        }    
                     ?>
                       <tr>
                         <td style="font-size:12px"><i class='<?php echo $icon; ?>'>&nbsp;</i><?php echo $objDir['nombre'] ?></td>                         
                        <td>
                        <?php if ($tip=="dir") { ?>                           
                          <a style="font-size:15px;cursor:pointer;" href="ListContentDirectories.php?ping=<?php echo base64_encode($nom_directorio."/".$objDir['nombre']); ?>"><i class="fa fa-eye" data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip" ></i></a>
                         
                          </td> 
                          <td>
                          <?php }?>                                        
                          <?php if ($tip=="file") { 
                              if ($objDir['ext']=="PDF" || $objDir['ext']=="pdf") { 

                            ?>
                            <a href="Model/viewFile.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank"><span  style="font-size:15px;cursor:pointer;" class="fa fa-eye" data-placement="bottom"     title="Ver Documento" data-toggle="tooltip" ></span></a>                                    
                          <?php
                            }else{
                          ?>
                             <a href="Model/downloadFiles.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank">
                                              <span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa-cloud-download" data-placement="bottom"  title="Descargar Documento" data-toggle="tooltip" ></span></a> 
                            <?php } ?> 
                           </td> 
                          <?php }?>                                                                            
                        </tr>     
                    <?php                     
                         }//end for 1
                     }else{                        
                         foreach ($directorios as $key => $objDir) {  
                            $tip = $objDir['tipo'];
                            if ($tip=="dir") {
                              $icon="fa fa-folder-o";
                            } else{
                              $icon="fa fa-file-o";
                            }
                                                
                             foreach ($permisos as $key2 => $value2) {
                              //echo $value2."<br>"; 
                                $pos = strpos("../".$objDir['ruta'].$objDir['nombre'],  $value2);                            
                                if ($pos!==false) {
                                    
                                    if ($tip=="dir") {
                                    ?>
                                     <tr>
                                       <td style="font-size:12px"><i class='<?php echo $icon; ?>'>&nbsp;</i><?php echo $objDir['nombre'] ?></td>                         
                                      <td>
                                      <?php if ($tip=="dir") { ?>                           
                                        <a style="font-size:15px;cursor:pointer;" href="ListContentDirectories.php?ping=<?php echo base64_encode($nom_directorio."/".$objDir['nombre']); ?>"><i class="fa fa-eye" data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip" ></i></a>
                                        </td> 
                                        
                                        <?php }?>                                        
                                        <?php if ($tip=="file") { 
                                            if ($objDir['ext']=="PDF" || $objDir['ext']=="pdf") { 
                                          ?>
                                          <td>
                                          <a href="Model/viewFile.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank"><span  style="font-size:15px;cursor:pointer;" class="fa fa-eye" data-placement="bottom"     title="Ver Documento" data-toggle="tooltip" ></span></a>                                    
                                        <?php
                                          }else{
                                        ?>
                                           <a href="Model/downloadFiles.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank">
                                                            <span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa-cloud-download" data-placement="bottom"  title="Descargar Documento" data-toggle="tooltip" ></span></a> 
                                                            </td> 
                                          <?php } ?> 
                                         
                                        <?php }?>                                                                            
                                      </tr>     
                                  <?php 
                                  }else{ 
                                     if (in_array($objDir['nombre'],$nomfile)) { ?>
                                      <tr>
                                       <td style="font-size:12px"><i class='<?php echo $icon; ?>'>&nbsp;</i><?php echo $objDir['nombre'] ?></td>                         
                                      <td>
                                      <?php if ($tip=="dir") { ?>                           
                                        <a style="font-size:15px;cursor:pointer;" href="ListContentDirectories.php?ping=<?php echo base64_encode($nom_directorio."/".$objDir['nombre']); ?>"><i class="fa fa-eye" data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip" ></i></a>
                                       
                                        </td> 
                                        <td>
                                        <?php }?>                                        
                                        <?php if ($tip=="file") { 
                                            if ($objDir['ext']=="PDF" || $objDir['ext']=="pdf") { 

                                          ?>
                                          <a href="Model/viewFile.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank"><span  style="font-size:15px;cursor:pointer;" class="fa fa-eye" data-placement="bottom"     title="Ver Documento" data-toggle="tooltip" ></span></a>                                    
                                        <?php
                                          }else{
                                        ?>
                                           <a href="Model/downloadFiles.php?documento=<?php echo base64_encode($objDir['nombre']); ?>" target="_blank">
                                                            <span  style="font-size:15px;cursor:pointer;display:inline-block" class="fa fa-cloud-download" data-placement="bottom"  title="Descargar Documento" data-toggle="tooltip" ></span></a> 
                                          <?php } ?> 
                                         </td> 
                                        <?php }?>                                                                            
                                      </tr> 
                                      <?php
                                    }
                                  }
                                  
                                } 
                                
                             }  
                         }
                     }
                    } 
                     ?>  
                     </tbody>
                    </table>
                   <!--cerrar datata¿ble-->
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
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
    </script>
  </body>
</html>