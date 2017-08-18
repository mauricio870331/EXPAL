<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Expreso Palmira   &#8211;  Cliente Ultra    </title>
    </head>

    <body>
        <?php
        $usuario = addcslashes($_POST['cedula'], '%#');
        $clave = $_POST['clave'];
//usa la funcion conexiones() que se ubica dentro de funciones.php
        include ("Model/funciones_mysql.php");
        $conexion = Conexion::conectar("expresop_vultra");
        $rol = '';
        //si es valido accedemos a ingreso.php
        include ("Model/encriptar.php");
        $clave_encriptada = Encrypter::encrypt($clave);
        $sql = "SELECT cod_usuario, Rol, nombre, apellido Estado, cambio_clave, correo FROM tbl_usuario WHERE cod_usuario = '" . $usuario . "' and clave='" . $clave_encriptada . "'";
        $stmt = $conexion->prepare($sql);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
        if ($numfilas > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $usu = $row->cod_usuario;
                $rol = $row->Rol;
                $nombre = $row->nombre;
                $apellido = $row->apellido;
                $Estado = $row->Estado;
                $cambio_clave = $row->cambio_clave;
                $correo = $row->correo;
            }
            $conexion = null;
            $stmt = null;
            if ($Estado == 'INACTIVO') {
                echo '<script>  
             location.href="cliente-ultra.php";           
             alert("Para poder participar debes activar tu cuenta haciendo clic en el link que se te ha enviado al correo: ' . $correo . '"); 
            </script>';
            } else {
                if ($cambio_clave == 'S' && $rol == 'cliente') {
                    session_cache_limiter('nocache,private');
                    session_start();
                    $_SESSION['usuario'] = $nombre . " " . $apellido;
                    $_SESSION['cod_usuario'] = $usu;
                    ?>
                    <input type="hidden" id="cl" data-toggle="modal" data-target="#myModal" />
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Cambiar Contraseña</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" role="form">              
                                        <div class="form-group">
                                            <label for="pass" class="col-lg-2 control-label">Contraseña</label>
                                            <div class="col-lg-10">
                                                <input type="password" class="form-control" id="pass" maxlength="8"  placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button type="button" class="btn btn-default" id="cb" data-id="<?php echo $usuario ?>" onclick="setPass();" >cambiar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" id="close"  onclick="setClose();" data-dismiss="modal" >Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin Modal -->   
                    <?php
                } else {
                    if ($rol == 'cliente') {
                        echo 'entro cliente';
                        session_cache_limiter('nocache,private');
                        session_start();
                        $_SESSION['usuario'] = $nombre . " " . $apellido;
                        $_SESSION['cod_usuario'] = $usu;
                        $_SESSION['rol'] = $rol;
                        header('Location:MenuUltra.php');
                        //header('Location:MenuUltra.php');
                    } elseif ($rol == 'admon') {
                        session_cache_limiter('nocache,private');
                        session_start();
                        $_SESSION['usuario'] = $nombre . " " . $apellido;
                        $_SESSION['cod_usuario'] = $usu;
                        $_SESSION['rol'] = $rol;
                        header('Location:MenuUltraAdmon.php');
                    }
                }
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Clave o usuario incorrecta");
                location.href = 'cliente-ultra.php';
            </script>
            <?php
        }
        ?>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">




                $(document).ready(function () {
                    $("#cl").trigger("click");
                });

                function setClose() {
                    location.href = 'cliente-ultra.php';
                }


                function  setPass() {
                    var value = $("#pass").val();
                    var id = $('#cb').data('id');
                    if (value == "") {
                        $("#pass").attr("placeholder", "Campo Obligatorio");
                        $("#pass").focus();
                    } else {
                        var parametros = {"id": id, "pass": value};
                        $.ajax({
                            data: parametros,
                            url: 'Model/updatePass.php',
                            type: 'post',
                            beforeSend: function () {
                            },
                            success: function (response) {
                                if (response == 1) {
                                    alert('La contraseña fue actualizada');
                                    location.href = "MenuUltra.php?<?php session_name() . "=" . session_id() ?>";
                                } else {
                                    alert('Error al actualizar la  contraseña');
                                    location.href = "cliente-ultra.php";
                                }
                            }
                        });

                    }

                }

        </script> 
    </body>
</html>
