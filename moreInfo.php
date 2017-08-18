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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body altura">
                <div id="contenedor">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <!--<li data-target="#myCarousel" data-slide-to="3"></li>-->
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img id="imgmin1" alt="Chania">
                            </div>
                            <div class="item">
                                <img id="imgmin2"  alt="Chania">
                            </div>
                            <div class="item">
                                <img id="imgmin3"  alt="Flower">
                            </div>
                            <!--                                    <div class="item">
                                                                    <img src="imgs/elastislide/small/Sin título-4.jpg" alt="Flower">
                                                                </div>-->
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
                        <img id="imgminZ" class="auto" alt="Flower">
                    </div>                            
                </div>                         
            </div>
            <div id="contenedor2" class="modal-body altura2">
                <div class="tab">
                    <button id="btn1" class="tablinks active" onclick="openPanel(event, 'Condiciones')">Condiciones y Restricciones</button>
                    <button class="tablinks" onclick="openPanel(event, 'Detalle')">Detalles del Descuento</button>
                    <!--<button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>-->
                </div>
                <div id="Condiciones" class="tabcontent" style="display: block;">
                    <h3>London</h3>
                    <p>London is the capital city of England.</p>
                </div>

                <div id="Detalle" class="tabcontent">
                    <h3>Paris</h3>
                    <p>Paris is the capital of France.</p> 
                </div>                       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
