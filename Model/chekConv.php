<!doctype html>
<html>
    <head>
        <title>Formulario HTML5 Responsive</title>    
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery-1.10.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>        
        <script src="../js/bootstrap.js"></script>
        <script src="../js/conv.js"></script>
        <style> 
            body{
                font-family: "Open Sans", Arial, sans-serif;
                font-size: 14px;
                font-weight: 350px;
                color: #333;
            }
            input[type=text]{                
                width: 70%;
                height: 70px;
                font: 300 24px "Open Sans", Arial, sans-serif;
                /*margin-top: 100px;*/
                margin-bottom: 28px;
                margin-left: 15%;
                font-size: 60px;
                border: solid 1px;
            }
            input[type=button]{
                background-color:#FF9900;
                width: 70%;
                height: 70px;
                font-weight:400;
                letter-spacing:2px;
                color:#FFFFFF;
                margin-left: 15%;
                font-size: 60px;
            }
            #imagen{
                margin-left:35%;
                width: 300px;
            }
            .alert{
                margin-top: 10px;
                margin-left: 15%;
                width: 70%; 
                display: none;
                font-size: 28px;
            }
        </style>
    </head>
    <body>
        <?php
        $id_conv = $_GET['id_conv'];
        $consec = $_GET['consec'];
        $user = $_GET['user'];
        ?>
        <form id="form">
            <img id="imagen" src="android.png" />
            <input type="text" id="validar" placeholder="<?php echo utf8_decode('Codigo de verificación') ?>">
            <input type="hidden" id="nit" value="<?php echo $id_conv; ?>">
            <input type="button" value="Verificar" onclick="verificarCupon('<?php echo $consec; ?>', '<?php echo $user; ?>')">            
        </form>
        <div id="alert1" class="alert alert-success alert-dismissable fade in" >
            <strong>Correcto..!</strong> Ya puedes cerrar el navegador.
        </div>
        <div id="alert2" class="alert alert-warning alert-dismissable fade in" >
            <strong>Aviso..!</strong> Este cupon no existe o ya fue redimido.
        </div>
        <div id="alert3" class="alert alert-danger alert-dismissable fade in" >
            <strong>Error..!</strong> Usuario incorrecto.
        </div>
        <div id="alert4" class="alert alert-danger alert-dismissable fade in" >
            <strong>Error..!</strong> El campo codigo no debe estar vacio.
        </div>
    </body>
</html>