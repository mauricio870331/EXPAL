<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include ("Model/funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include('inclu2.php'); ?>

    </head>
    <body>
        <?php include('header2.html'); ?>

        <div id="slider-sombra"></div>

        <div id="mainint">
            <div class="unterciom">
                <h2>Información de Proceso</h2>
                En esta vista podremos administrar los tiquetes que nuestros clientes ultras han solicitado, la tabla de los tiquetes nos mostrara todos los tiquetes que hacen falta por validar o cancelar para los tiquetes.
            </div>
            <div class="dosterciosm">
                <h2>Tiquetes Pendientes</h2>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><b>Cédula</b></th>
                            <th><b>Nombre</b></th>
                            <th><b>Origen</b></th>
                            <th>Destino</th>
                            <th>Kl</th>
                            <th>Fecha Solicitud</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>                   
                    <tbody>
                <?php

                        $kilom = 0;
                        $sql = "SELECT a.codigooUsu codigooUsu,
                                       b.cod_usuario cod_usuario,
                                       b.nombre nombre, 
                                       c.ruta ruta, 
                                       c.destino destino, 
                                       c.kilometros kilometros, 
                                       c.codigo codigo, 
                                       a.fechaPedido fechaPedido                                       
                                 FROM  tbl_usuarioTiquete a,  tbl_usuario b,  parametrosGanador c
                                 WHERE a.estado =  'Pendiente'
                                 AND a.cod_persona = b.cod_usuario
                                 AND a.cod_tiquete = c.codigo";
                        $stmt = $conexion->prepare($sql);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                 ?>         <tr>
                                <td><?php echo $row->cod_usuario; ?></td>
                                <td><?php echo $row->nombre; ?></td>
                                <td><?php echo $row->ruta; ?></td>
                                <td><?php echo $row->destino; ?></td>
                                <td><?php echo $row->kilometros; ?></td>
                                <td><?php echo $row->fechaPedido; ?></td>
                                <td><a class="myIcons" title="Seleccionar"  onclick="Acept(<?php echo $row->kilometros;?>,<?php echo $row->cod_usuario;?>,'1',<?php echo $row->codigooUsu;?>,<?php echo $row->codigo;?>)"><i class="fa fa-check-circle" ></i></a>
                                    | <a class="myIcons" title="Rechazar"   onclick="Acept(<?php echo $row->kilometros;?>,<?php echo $row->cod_usuario;?>,'3',<?php echo $row->codigooUsu;?>,<?php echo $row->codigo;?>)" ><i class="fa fa-close" ></i></a>
                                </td>
                            </tr>  
                            <?php
                        }

                        $stmt = null;
                        $conexion = null;
                        ?>

                    </tbody>
                </table>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form id="formRegistro" name="formRegistro" action="" method="post" class="wpcf7-form"  style="width:100%;" novalidate >

                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:78px;">Nombre</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Nombre" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:72px;">Apellidos</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Apellidos" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:88px;">Cédula</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="cedula" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>



                                <p>
                                    <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                        <p style="display:inline;margin-right:74px; ">Teléfono</p>
                                        <select name="Tele" style="display:inline;width:150px;height:40px;">
                                            <option value="-1">Seleccione</option>
                                            <option value="-1">Fijo</option>
                                            <option >Celular</option>
                                        </select> 
                                        <input style="display:inline!important;width:257px!important;" type="text" name="Telefono" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:8px;">Correo Electrónico</p>
                                        <input style="display:inline!important;width:410px!important;" type="text" name="Correo_Electronico" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>


                                <p style="display:inline!important;width:100%!important;"><span class="wpcf7-form-control-wrap Emprersa">
                                        <p style="display:inline!important;width:20%!important;margin-right:8px;">Fecha de nacimiento</p>
                                        <input style="display:inline!important;width:390px!important;" type="date" name="nacimiento" id="nacimiento" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="" />
                                    </span>
                                </p>

                                <p>
                                    <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                        <p style="display:inline;margin-right:9px; " name="ciudades">Ciudad Residencia</p>
                                        <select  style="display:inline;width:260px;height:40px;" name="ciudad" id="ciudad" >
                                            <option value="-1">Seleccione</option>
                                            <option> ARMENIA </option>
                                            <option>BOGOT&#193</option>                                  
                                            <option>BUENAVENTURA</option>                            
                                            <option>BUGA</option>                                    
                                            <option>CAICEDONIA</option>                              
                                            <option>CALI</option>                                    
                                            <option>CARTAGO</option>                                 
                                            <option>CHINCHIN&#193</option>                              
                                            <option>GUACAR&#205</option>                                 
                                            <option>IBAGU&#201</option>                                  
                                            <option>MANIZALES</option>                               
                                            <option>MEDELL&#205N</option>                                
                                            <option>PALMIRA</option>                                 
                                            <option>PEREIRA</option>                                 
                                            <option>POPAY&#193N</option>                                 
                                            <option>SANTANDER DE QUILICHAO</option>                  
                                            <option>SEVILLA</option>                                 
                                            <option>TULU&#193</option>                                   
                                            <option>YUMBO</option>                                   
                                            <option>ZARZAL</option>  
                                            <option>OTRO</option>  
                                        </select>
                                    </span>
                                </p>

                                <span class="wpcf7-form-control-wrap nombre"  style="width:100%;">
                                    <p style="display:inline;margin-right:105px; ">Sexo</p>
                                    <select  style="display:inline;width:150px;height:40px;" name="sexo">
                                        <option> Masculino </option>                                             
                                        <option>Femenino</option>                                  
                                    </select>
                                    </select>
                                </span>
                                </p>
                                <input type="hidden" name="opc" value="2">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarUsuario()" >Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin Modal inscribete-->

        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
