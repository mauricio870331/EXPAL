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
              <a href="ListDirectories.php" class="site_title"><span>Inicio</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                <?php if ($_SESSION['descripcion']=="Admin" || $_SESSION['descripcion']=="admintemp" ) { ?>
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
                  <?php if ($_SESSION['descripcion']=="Admin" | $_SESSION['descripcion']=="admintemp") { ?>              
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
                <h3><a href="ListDirectories.php">Documentos <i class="fa fa-folder"></i></a></h3>
              </div>              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">                  
                
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">  
                    <?php 
                          $directorio = "../Documentos";                           
                            function listar_directorios_ruta($ruta){ 
                              $directories = array();
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
                                         array_push($directories,$objectDir);                                         
                                      } 
                                    
                                    }                                    
                                    closedir($dh);                                     
                                  }//else{echo "<ul><li>El directorio esta vacio</li></ul>";}
                                
                                } 
                             }//else {echo "<br>No es ruta valida"; }
                             return $directories;
                          }                         
                          $directorios = listar_directorios_ruta($directorio."/");  
                          //echo "<pre>";print_r($directorios); echo "</pre>";

                         include ("Model/funciones_mysql.php");
                          $conexion = conectar("expresop_convenios"); 
                          if ($_SESSION['id_utemp']==15) {
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
                          $rutas =  array();
                          while ($campo2 = mysql_fetch_row($resultado2)){
                                  //$permisos[]=$campo2[3];
                                  $r = explode("/", $campo2[4]);
                                  $rcomp = $r[1]."/".$r[2]."/".$r[3];                                 
                                  if (!in_array($rcomp, $rutas)) {
                                    $rutas[]=$rcomp;
                                    
                                  }
                          }

                             //echo "<pre>";print_r($rutas); echo "</pre>";
                             // echo "<pre>";print_r($directorios); echo "</pre>";
                    
                    //ruta ../Documentos/
                    //echo count($directorios)." ".count($permisos);

                    if (count($directorios)>0) {    
                                                
                        foreach ($directorios as $key => $objDir) { //for 1   
                          if ($_SESSION['id_utemp']==15 || $_SESSION['id_utemp']==63) {
                        ?>
                          <div class="col-md-55">
                          <div class="thumbnail">
                            <div class="image view view-first">
                              <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                              <div class="mask">
                                <p><?php echo (strlen($objDir['nombre'])>20) ? substr($objDir['nombre'], 0, 17)."..." : $objDir['nombre']; ?></p>
                                <div class="tools tools-bottom">                               
                                  <a href="ListContentDirectories.php?ping=<?php echo base64_encode($objDir['nombre']); ?>"><i class="fa fa-eye" data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip" ></i></a>
                                </div>
                              </div>
                            </div>
                            <div class="caption">
                              <p data-placement="bottom"  title="Directorio: <?php echo $objDir['nombre'] ?>" data-toggle="tooltip" ><?php  echo "Directorio : ".substr($objDir['nombre'], 0, 9)."..." ?><br>
                                 Modificado: <?php echo substr($objDir['fecha'], 0, -9) ;?></p>
                            </div>
                          </div>
                        </div>  
                        <?php                              
                          }else{       

                          for ($i=0; $i < count($rutas); $i++) { 
                            if ($rutas[$i]==$objDir['ruta'].$objDir['nombre']) {                                   
                       ?>
                       <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                            <div class="mask">
                              <p><?php echo (strlen($objDir['nombre'])>20) ? substr($objDir['nombre'], 0, 17)."..." : $objDir['nombre']; ?></p>
                              <div class="tools tools-bottom">                               
                                <a href="ListContentDirectories.php?ping=<?php echo base64_encode($objDir['nombre']); ?>"><i class="fa fa-eye" data-placement="bottom"  title="Ver Contenido" data-toggle="tooltip" ></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p data-placement="bottom"  title="Directorio: <?php echo $objDir['nombre'] ?>" data-toggle="tooltip" ><?php  echo "Directorio : ".substr($objDir['nombre'], 0, 9)."..." ?><br>
                               Modificado: <?php echo substr($objDir['fecha'], 0, -9) ;?></p>
                          </div>
                        </div>
                      </div>    
                    <?php
                        }
                      }
                      } 
                       
                     }//end for 1
                    }else{
                            ?>                             
                                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>No hay directorios ni documentos</strong>
                                  </div>
                               
                            <?php
                          } 
                     ?>   
                 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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

      <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script>

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
   

      function  cleanModal(campo){  
      $("#"+campo).val("");      
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
  </body>
</html>