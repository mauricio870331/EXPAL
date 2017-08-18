<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:cliente-ultra.php');
}
include 'Model/Conex.php';
$conexion = new Conex("expresop_vultra");
$object = $conexion->findAll("categorias_cupones");
$object2 = $conexion->findAll("convenios_ultra", " order by orden");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Expreso Palmira   –  Cliente Ultra</title>
        <meta name="description" content="Es el programa que premia tu fidelidad, cada vez que viajas utilizando cualquiera de nuestras rutas y destinos, podrás ir acumulando kilometraje que te harán ganador de tiquetes sin costo.">
        <?php include('inclu2.php'); ?>
        <script>
            function openPanel(evt, cityName) {
                // Declare all variables
                var i, tabcontent, tablinks;
                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                // Show the current tab, and add an "active" class to the button that opened the tab
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    </head>
    <body>
        <?php include('header3.php'); ?>
        <div id="mainint">
            <h3>¡Disfruta de los mejores descuentos!</h3>            

            <div class="unterciomcupon">
                <h2>Categorias</h2>                
                <div>
                    <ul>
                        <?php foreach ($object as $obj) { ?>
                            <li id="<?php echo $obj->id_categoria ?>" class="<?php echo $obj->class ?>" onclick="mostrar(this.id)"><?php echo $obj->categoria ?></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
            <div class="dosterciosmcupon">   
                <div id="imgContainer">
                    <?php foreach ($object2 as $obj2) { ?>
                        <div class="int <?php echo $obj2->class; ?>"><img  onclick="setConvenio('<?php echo $obj2->nit; ?>')"  src="data:image/jpeg;base64,<?php echo $obj2->img  ?>" alt="<?php echo $obj2->nomb_img  ?>"  data-toggle="modal" data-target="#myModal"/></div>
                    <?php } ?>                  
                </div>
            </div>

            <!--modal cupon -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div id="cuerpomodal" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 id="mtt" class="modal-title">Modal Header</h5>
                        </div>
                        <div class="modal-body altura">
                            <div id="contenedor">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>                                        
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img id="imgmin1" src="" alt="Chania">
                                        </div>
                                        <div class="item">
                                            <img id="imgmin2" src="" alt="Chania">
                                        </div>
                                        <div  class="item">
                                            <img id="imgmin3" src="" alt="Flower">
                                        </div>                                      
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div id="myCarousel2"> 
                                    <div id="desc1">
                                        <ul id="listap">
                                            <li id="li_p1" class="li_p1"></li>
                                            <li id="li_p2" class="li_p2"></li>
                                            <li id="li_p3" class="li_p3"></li>
                                            <li id="li_p4" class="li_p4"></li>
                                        </ul>
                                    </div>
                                    <div id="desc2">
                                        <a id="btndescargar" href="javascript:void(0)" data-conv onclick="PrintElem('<?php echo $_SESSION['cod_usuario'] ?>')" class="descCupon">
                                            <b>Descarga tu cupón</b>
                                        </a>
                                        <a id="btndog" href="javascript:void(0)" data-prod onclick="setProducto('perro', this.id)" >
                                            <b>Perro</b>
                                        </a>
                                        <a id="btnham" href="javascript:void(0)" data-prod onclick="setProducto('hamburguesa', this.id)"  >
                                            <b>Hamburguesa</b>
                                        </a>
                                    </div>
                                </div>                            
                            </div>                         
                        </div>
                        <div id="contenedor2" class="modal-body altura2">
                            <div class="tab">
                                <button id="btn1" class="tablinks active" onclick="openPanel(event, 'Condiciones')">Condiciones y Restricciones</button>
                                <button class="tablinks" onclick="openPanel(event, 'Detalle')">Detalles del Descuento</button>                                
                            </div>

                            <div id="Condiciones" class="tabcontent" style="display: block;">
                                <h5 id="tituloCond"></h5>
                                <p id="parrafoCond1"></p> 
                                <p id="parrafoCond2"></p> 
                                <p id="parrafoCond3"></p> 
                                <ul id="lista">
                                    <li id="li1"></li>
                                    <li id="li2"></li>
                                    <li id="li3"></li>
                                    <li id="li4"></li>
                                    <li id="li5"></li>
                                    <li id="li6"></li>
                                </ul>
                                <p id="parrafoCond4"></p> 
                            </div>   

                            <div id="Detalle" class="tabcontent" >
                               

                                <!--inicio contlado2-->
                                
                                
                              
                                <!--fin contlado2-->

                                
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--fin modal cupon -->

        </div>
        <div id="infocupones">Ten en cuenta: para redimir los cupones debes llevar el cupón impreso junto con copia de tu cedula al establecimiento.</div>
        <?php include('footer.html'); ?>
    </body>
</html>
