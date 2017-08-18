<!DOCTYPE html>
<html>
    <head><title>Expreso Palmira - Promociones</title>
        <meta name="description" content="Expreso palmira tiene las mejores promociones a nivel nacional, para que viajes economica y tranquilamente">
        <?php include('inclu.php'); ?>
    </head>
    <body>
        <?php
        include('header.html');
        include ("Model/funciones_mysql.php");
    
        $conexion = Conexion::conectar("expresop_convenios");
     
        $sqlPromos = "SELECT * FROM imagenesEP WHERE (lugar = 'promocion' or lugar = 'modalPromo') and estado = 1 order by posicion";
        
        $stmt = $conexion->prepare($sqlPromos);
        $stmt->execute();
        $numfilas = $stmt->rowCount();         

        $promosComplete = array();
        $promos = array();
        $promosModal = array();
        while ($row=$stmt->fetch(PDO::FETCH_OBJ)) {
            if ($row->lugar == 'promocion') {
                $promos[] = $row->imagen;
            } else {
                $promosModal[] = $row->imagen;
            }
        }
        for ($i = 0; $i < count($promos); $i++) {
            $promosComplete[] = $promos[$i] . "," . $promosModal[$i];
        }



        $sqlslidePromos = "SELECT * FROM imagenesEP WHERE lugar = 'slidePromo' and estado = 1 order by posicion";
        
        
        $stmt2 = $conexion->prepare($sqlslidePromos);
        $stmt2->execute();
        $numfilas2 = $stmt2->rowCount();       
        
        
        ?>

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php
                while ($row2=$stmt2->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <img src="data:image/jpeg;base64,<?php echo $row2->imagen; ?>" >
                    <?php
                }
                ?>    	
            </div>
        </div>
        <div id="slider-sombra"></div>


        <div id="mainint">
            <h3>VIAJA POR COLOMBIA</h3>
            <h4>CON LAS MEJORES PROMOCIONES</h4>
            <ul id="ulpromos">
                <li><img src="imgs/tempPromo/1/tarjeta-1.jpg" promo="imgs/tempPromo/1/dc-cl42000.png"></li>   
                <li><img src="imgs/tempPromo/2/tarjeta-2.jpg" promo="imgs/tempPromo/2/md-cl45000.png"></li> 
                <li><img src="imgs/tempPromo/3/Dc-Pr48000.jpg" promo="imgs/tempPromo/3/pr-dc-48000.png"></li> 
                <li><img src="imgs/tempPromo/4/Dc-Mz58000.jpg" promo="imgs/tempPromo/4/mz-dc-58000.png"></li> 
                <li><img src="imgs/tempPromo/5/5.manizales-armenia15000.png" promo="imgs/tempPromo/5/5.manizales-armenia.png"></li> 
                <li><img src="imgs/tempPromo/6/6.cali--pereira-promox_3.jpg" promo="imgs/tempPromo/6/6.cali-pereira30000.png"></li> 
                <li><img src="imgs/tempPromo/7/7.cali--pereira-25000.png" promo="imgs/tempPromo/7/7.calipereira.png"></li> 
                <li><img src="imgs/tempPromo/8/9.cali-tulua10500.png" promo="imgs/tempPromo/8/9.cali-tulua.png"></li> 
                <li><img src="imgs/tempPromo/9/10.cali-buga8500.png" promo="imgs/tempPromo/9/10.Cali-buga.png"></li> 
                <li><img src="imgs/tempPromo/10/11.manizales-pereiraT.png" promo="imgs/tempPromo/10/11.manizales-pereira.png"></li> 
                <li><img src="imgs/tempPromo/11/PR-AR6500.png" promo="imgs/tempPromo/11/Promocion-06.png"></li> 
                <li><img src="imgs/tempPromo/12/8.cali-manizales.jpg" promo="imgs/tempPromo/12/8.cali-manizales.png"></li> 
          

<!--<li><img src="data:image/jpeg;base64,<?php //echo $img[0];   ?>" promo="data:image/jpeg;base64,<?php //echo $img[1];   ?>"></li>-->   

                <?php /* for ($i=0; $i < count($promosComplete); $i++) { 
                  $img = explode(",", $promosComplete[$i]);
                  ?>
                  <li><img src="data:image/jpeg;base64,<?php echo $img[0]; ?>" promo="data:image/jpeg;base64,<?php echo $img[1]; ?>"></li>
                  <?php
                  }
                 */ ?>
                <li><img  promo="img/Pop-Up-Cali-Caicedonia.png"><li>		
            </ul>
        </div>

        <?php include('footer.html'); ?>
    </body>
</html>
