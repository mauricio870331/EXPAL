<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">

        <?php include_once('inclu2.php'); ?>

    </head>
    <body>
        <?php include('header2.html'); ?>

        <div id="slider-sombra"></div>

        <div id="mainint">            
            <div class="tresTercios">
                <h2>Tiquetes Entregados</h2>
                <form class="form-inline" role="form" action="" method="post">
                    <div class="form-group">
                        <label for="FecIni">Fecha Inicial</label>
                        <input type="date" class="form-control" id="fecINI" name="fecINI">
                    </div>

                    <div class="form-group">
                        <label for="email">Fecha Final</label>
                        <input type="date" class="form-control" id="fecFin" name="fecFin">
                    </div>

                    <button type="button" class="btn btn-default m" onclick="cargarPremiados()">Consultar</button>

                    <button type="button" class="btn btn-default m" data-toggle="modal" data-target="#myModalClente" title="Consultar datos del cliente" onclick="cleanModal('cedula', 'responsecli')">Cliente</button>

                    <button type="button" class="btn btn-default m" data-toggle="modal" data-target="#modalKilometros" title="Consultar Kilometraje del cliente" onclick="cleanModal('cedulaK', 'responseKm')">Kilometros</button>

                    <button type="button" class="btn btn-default m" data-toggle="modal" data-target="#modalPremios" title="Consultar Premios por cliente" onclick="cleanModal('cedulaP', 'responseP')">Premios</button>

                    <button type="button" class="btn btn-default m" data-toggle="modal" data-target="#modalVencidos" onclick="cleanModal('cedulaV', 'responseV')" title="Consultar puntos a vencer">Puntos</button>
                    
                    <button type="button" class="btn btn-default m"  onclick="reporte(0)" >Reporte</button>
                    <br>
                     <input type="radio" name="opc" class="micheckbox" value="ultra" checked>Reporte Ultra<br>
                     <input type="radio" name="opc" class="micheckbox" value="ganador" >Reporte Tiquete Ganador<br>
                     <input type="radio" name="opc" class="micheckbox" value="t_ultra" >Reporte Tiquetes Ultra<br>

                </form>

                <br>
                <div id="resultConsulta">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><b>Cédula</b></th>
                                <th><b>Nombre</b></th>
                                <th><b>Origen</b></th>
                                <th>Destino</th>
                                <th>Fecha</th>
                                <th>Servicio</th>            
                            </tr>
                        </thead>                   
                        <tbody> 
                        </tbody>
                    </table>  
                </div>
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


            <!-- Modal DATOS detalle CLIENTE--> 
            <div id="modalDetalleCliente" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:800px;">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Información detallada de Tiquetes</h4>
                        </div>
                        <div class="modal-body">
                            <div>                       
                                <form class="form-horizontal form-inline" role="form">
                                    <input type="hidden" id="cccliente" value=""/>   
                                    <input type="hidden" id="alta" value=""/>                       
                                    <div class="radio radio-inline">
                                        <label><input type="radio" name="opt" id="opt1"  value="1">Tiquetes Registrados</label>
                                    </div>
                                    <div class="radio" style="padding-left: 10px;">
                                        <label><input type="radio" name="opt" id="opt2" value="2">Tiquetes Redimidos</label>
                                    </div>
                                    <div class="radio" style="padding-left: 10px;">
                                        <label><input type="radio" name="opt" id="opt3" value="3" >Puntos Acumulados</label>    
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-8">
                                            <button id="presionar" type="button" class="btn btn-primary" onclick="getDatos()">Consultar</button>
                                        </div>
                                    </div>
                                </form>                 
                            </div>
                            <p>
                            <div id="responseDetalle"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>  
            <!-- FIN MODAL detalle  CLIENTE-->

            <!-- Modal DATOS CLIENTE--> 
            <div id="myModalClente" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:700px;">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Datos del Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <div>               	
                                <form class="form-horizontal form-inline" role="form">
                                    <div class="form-group">            			
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cedula"
                                                   placeholder="Cédula">
                                        </div>
                                    </div>             	
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="button" class="btn btn-primary" onclick="consultarCliente(0)">Buscar</button>
                                        </div>
                                    </div>
                                </form>	 		
                            </div>
                            <p>
                            <div id="responsecli"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>	
            <!-- FIN MODAL DATOS CLIENTE-->


            <!-- Modal DATOS Kilometros CLIENTE--> 
            <div id="modalKilometros" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:700px;">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Kilometros del Cliente</h4> 
                        </div>
                        <div class="modal-body">
                            <div>               	
                                <form class="form-horizontal form-inline" role="form">
                                    <div class="form-group">            			
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cedulaK"
                                                   placeholder="Cédula">
                                        </div>
                                    </div>             	
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="button" class="btn btn-primary" onclick="consultarKilometros()">Buscar</button>
                                        </div>
                                    </div>
                                </form>	 		
                            </div>
                            <p>
                            <div id="responseKm"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>	
            <!-- FIN MODAL DATOS  Kilometros CLIENTE-->

            <!-- Modal DATOS Premio CLIENTE--> 
            <div id="modalPremios" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:800px;">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Premios del Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <div>               	
                                <form class="form-horizontal form-inline" role="form">
                                    <div class="form-group">            			
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cedulaP"
                                                   placeholder="Cédula">
                                        </div>
                                    </div>             	
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="button" class="btn btn-primary" onclick="consultarPremios()">Buscar</button>
                                        </div>
                                    </div>
                                </form>	 		
                            </div>
                            <p>
                            <div id="responseP"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>	
            <!-- FIN MODAL DATOS  Premio CLIENTE-->


            <!-- Modal DATOS vencidos CLIENTE--> 
            <div id="modalVencidos" class="modal fade" role="dialog" >
                <div class="modal-dialog" style="width:800px;">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Puntos a Vencer</h4>
                        </div>
                        <div class="modal-body">
                            <div>    
                                <p><b>Se muestran solo los puntos a vencer de tiquetes no premiados aùn..!</b></p>                                
                                <form class="form-horizontal form-inline" role="form">
                                    <div class="form-group">            			
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cedulaV"
                                                   placeholder="Cédula">
                                        </div>
                                    </div>             	
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button  type="button" class="btn btn-primary" onclick="consultarVencidos()">Buscar</button>
                                        </div>
                                    </div>
                                </form>	 		
                            </div>
                            <p>
                            <div id="responseV"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>	
            <!-- FIN MODAL DATOS  vencidos CLIENTE-->

            <!-- modal solicitar tiquete -->
			<div id="requestTiquet" class="modal fade" tabindex="-1" >
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <!-- dialog body -->
			      <div class="modal-body">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        ¿Desea solicitar un tiquete?
			        <?php           
			          echo '<form name="rquest" method="post" id="rquest" > </form>';
			        ?> 
			        <hr>
			        <label> Seleccione la ruta:</span>
			        <div class="radio">
					  <label><input type="radio" id="opciones_1" name="optradio" checked><span id="r1"></span></label>
					</div>
					<div class="radio">
					  <label><input type="radio" id="opciones_2" name="optradio"><span  id="r2"></span></label>
					</div>	
			      </div> 
			      <!-- dialog buttons -->
			      <div class="modal-footer">
			      <button type="button" class="btn btn-success" onclick=ValidarKilometros2()>Si</button>
			      <button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
			      </div>

			    </div>
			  </div>
			</div>  

			<!-- fin modal solicitar tiquete -->	

			<!-- modal solicitar tiquete -->
				<div id="requestNoTiquet" class="modal fade" tabindex="-1" >
				  <div class="modal-dialog" style="width:500px;">
				    <div class="modal-content"> 
				      <!-- dialog body -->
				      <div class="modal-body">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <b>Información...!  </b> 
				        <hr>     
						<div class="radio">
						  <label><b>Aún no se han validado los tiquetes ó te faltan puntos</b></label>
						</div>	
				      </div> 
				      <!-- dialog buttons -->
				      <div class="modal-footer">
				   
				      <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
				      </div>

				    </div>
				  </div>
				</div>

				<!-- fin modal solicitar tiquete -->	

        </div>
        <?php include('footer.html'); ?>
    </body>
</html>
