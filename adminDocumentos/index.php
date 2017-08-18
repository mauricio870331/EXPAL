<?php
session_start();
function detect()
{
  $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
  $os=array("WIN","MAC","LINUX"); 
  # definimos unos valores por defecto para el navegador y el sistema operativo
  $info['browser'] = "OTHER";
  $info['os'] = "OTHER"; 
  # buscamos el navegador con su sistema operativo
  foreach($browser as $parent)
  {
    $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
    $f = $s + strlen($parent);
    $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
    $version = preg_replace('/[^0-9,.]/','',$version);
    if ($s)
    {
      $info['browser'] = $parent;
      $info['version'] = $version;
    }
  } 
  # obtenemos el sistema operativo
  foreach($os as $val)
  {
    if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
      $info['os'] = $val;
  }
   # devolvemos el array de valores
  return $info;
}
/*$info=detect();
//echo "Navegador: ".$info["browser"];
if ($info["browser"]=='FIREFOX') {  
       //echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
      header('Location: production/IncompatibilityDetected.php');    
}*/

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio de Sesión  </title>  
    <link rel="icon" type="image/png" href="production/images/favicon.png" /> 
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">
        <!-- PNotify -->
    <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <img width="100%" src="production/images/logos3s.jpg">
            <form>
              <h1>Inicio de Sesión</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuario" id="user" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" id="pass" />
              </div>
              <div>
                <a class="btn btn-default submit" onclick="login()">Ingresar</a>
                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!--<p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-file-text"></i> DOCUMENTOS  SISTEMA DE GESTION</h1>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> --</h1>
                  <p>--</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>


   <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>  
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>

    $(document).keypress(function(e) {
       if(e.which == 13) {
          login();
       }
    });


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


      function redireccionarPagina() {
        window.location.href = "production/ListDirectories.php";  
      }

      




      function login(){  
         var user = $("#user").val();    
          var pass = $("#pass").val();       
         if (user=="") {
            showAlert("red", "Aviso..!","El campo usuario no debe estar vacio..!","danger");
            $("#user").focus();
            return false;
         }

         if (pass=="") {
            showAlert("red", "Aviso..!","El campo password no debe estar vacio..!","danger");
            $("#pass").focus();
            return false;
         }
               var parametros = {"user" : user,"pass" : pass  };
              $.ajax({
                data:  parametros,
                url:   'production/Model/login.php',
                type:  'post',
                beforeSend: function () {
                  //$("#responseKm").html("...");
                },
                success:  function (response) {    
                  console.log(response) ;                                             
                    if(response==0){
                     showAlert("red", "Aviso..!","Usuario ó Password Incorrecto","danger"); 
                      $("#user").val("");    
                      $("#pass").val(""); 
                      $("#user").focus();                                                     
                    }
                    if(response==1){
                      redireccionarPagina();
                    }                 
                }
              });
      }  


        

    </script>
    <!-- /Datatables -->

  </body>
</html>