<?php

date_default_timezone_set('America/Bogota');
header("Content-Type: text/html;charset=utf-8");
include ("funciones_mysql.php");
$conexion = Conexion::conectar("expresop_vultra");
$date = new DateTime();
$and = "";
$producto = base64_decode($_GET['prod']);
$convenio = base64_decode($_GET['conv']);
$usuario = base64_decode($_GET['token']);
if ($producto != "") {
    $and = " AND producto = '" . $producto . "'";
}
$queryc = "SELECT count(*) as cantidad FROM usuarios_cupones "
        . "WHERE id_convenio = '" . $convenio . "' "
        . "AND doc_usuario = '" . $usuario . "' "
        . "AND date_format(fecha_creacion, '%Y-%m') = '" . $date->format('Y-m') . "'" . $and;

//echo $queryc;die;

$error = false;
$msn = "";
$img = "";
$web = "";
$parafo1 = "";
$parafo2 = "";
$parafo3 = "";
$texto1 = "";
$multitext = "";
$multitext2 = "";
$multitext3 = "";
$multitext4 = "";
$multitext5 = "";
switch (base64_decode($_GET['conv'])) {
    case "APARTAHOTELDELRIO":
        $stmt = $conexion->prepare($queryc);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
        if ($numfilas > 0) {
            $error = true;
            $msn = "Solo se puede descargar un cupon al mes por persona.";
        }
        $img = "../imgs/slideslandingUltra/delrio.jpg";
        $web = "www.apartahoteldelrio.com";
        $parafo1 = "10% de descuento en";
        $parafo2 = "las habitaciones.";
        $texto1 = "10% de descuento en habitaciones dobles y sencillas.";
        $multitext = "- Aplica los 7 dias de la semana.\n"
                . "- Se debe realizar reserva.\n"
                . "- No aplica para promociones.\n"
                . "- Valido hasta el 30 de Junio de 2017\n."
                . "- 1 cupón al mes por persona\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Cali: Dirección: Avenida 2 Norte Nº 1ª-21.\n"
                . "Cali: Dirección: Avenida 6 Nº 16N - 30.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 179;
        $x2 = 203;
        $y2 = 179;
        $fontsize = 14;
        $redimibley = 180;
        $multitext2y = 185;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "ROLLINGFASHION":
        $stmt = $conexion->prepare($queryc);
        $stmt->execute();
        $row2 = $rs->fetch(PDO::FETCH_OBJ);
        if ($row2->cantidad > 0) {
            $error = true;
            $msn = "Solo se puede descargar un cupon al mes por persona.";
        }
        $img = "../imgs/slideslandingUltra/rollinfashion.jpg";
        $web = "www.rollingfashion.com.co";
        $parafo1 = "10% En todas las prendas y accesorios";
        $parafo2 = "exhibidos en el establecimiento..";
        $texto1 = "10% En todas las prendas y accesorios exhibidos en el establecimiento..";
        $multitext = "- No acumulable con otras promociones.\n"
                . "- Vigencia de 6 meses.\n"
                . "- 1 cupón al mes por persona.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Cali: Sede Sur: Calle 10 Nº 65ª-36.\n"
                . "Cali: Sede Norte: Calle 52N Nº 3C-124 Local 101.\n"
                . "Teléfonos: 387 90 47 - 383 08 78.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 170;
        $x2 = 203;
        $y2 = 170;
        $fontsize = 20;
        $redimibley = 172;
        $multitext2y = 177;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "BILLOSCOMIDASRAPIDAS":
        $stmt = $conexion->prepare($queryc);
        $stmt->execute();
        $row2 = $rs->fetch(PDO::FETCH_OBJ);
        if ($row2->cantidad > 0) {
            $error = true;
            $msn = "Solo se puede descargar un cupon al mes por producto.";
        }
        $img = "../imgs/slideslandingUltra/billos.jpg";
        $web = "Siguenos en facebook.";
        $parafo1 = "10% de descuento en";
        $parafo2 = "hamburguesas y perros.";
        $parafo3 = "Producto: " . ucwords($producto);
        $texto1 = "10% de descuento en hamburguesas y perros para los 7 dias de la semana.";
        $multitext = "- No acumulables.\n"
                . "- No aplica para domicilios."
                . "- Valido hasta el 01 de Junio de 2017.\n"
                . "- 1 cupón al mes por producto.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Palmira: Carrera 28Nº37-08 .\n"
                . "Palmira: local 523-524 ubicado en el centro comercial llano grande.\n";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 171;
        $x2 = 203;
        $y2 = 171;
        $fontsize = 15;
        $redimibley = 173;
        $multitext2y = 179;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "SUBWAY":
        $img = "../imgs/slideslandingUltra/subway.jpg";
        $web = "www.subwaycolombia.com";
        $parafo1 = "Gratis bebida en Vaso 16 oz";
        $parafo2 = "para acompañar tu sándwich.";
        $texto1 = "Por la compra de cualquier sándwich clásico, tradicional o Premium reclama completamente gratis una bebida en vaso de 16 oz.";
        $multitext = "- No aplica para promociones como: Sándwich del día, Baratísimo o Trio.\n"
                . "- No acumulable.\n"
                . "- Válido hasta el 15 de septiembre del 2017.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Subway terminal Cali, local 151.\n"
                . "Subway Buenaventura, Calle 3 Nº 2-18, Centro Boulevard local 01.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 173;
        $x2 = 203;
        $y2 = 173;
        $fontsize = 27;
        $redimibley = 175;
        $multitext2y = 180;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "CARAMELOTORTAS":
        $img = "../imgs/slideslandingUltra/caramelo.jpg";
        $web = "www.caramelo.com.co";
        $parafo1 = "10% de descuento en todos";
        $parafo2 = "los postres y ponqués.";
        $texto1 = "10% en todos los postres y ponqués de 400 gramos en adelante elaborados por tortas y postres Caramelo.";
        $multitext = "- Valido para los 7 días de la semana.\n"
                . "- No aplica para desechables, vinos, bebidas, velas y porciones inferiores a 400 gramos.\n"
                . "- No acumulable con otras promociones.\n"
                . "- Valido hasta el 31 de Diciembre de 2017.\n"
                . "- 1 cupón por producto.\n"
                . "- Aplica a nivel nacional.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";
        $multitext2 = "------ Cali ------\n"
                . "-Limonar: Autopista sur 66ª 16.\n"
                . " Teléfono: 330 82 98.\n"
                . "-El ingenio: Calle 16 Nº 85-10 Local 2\n"
                . " Teléfono: 330 30 72.\n"
                . "-C:C Colon plaza: Carrera 1 Nº 61ª-30 Local 89-90.\n"
                . " Teléfono: 439 40 98.\n"
                . "-Las Ceibas: Carrera 8 Nº 63-13.\n"
                . " Teléfono: 662 73 47.\n"
                . "------ Tuluá ------\n"
                . "-Dirección: Calle 27 Nº 30 - 04.\n"
                . " Teléfono: 657 43 79\n"
                . "------ Yumbo ------\n"
                . "-Dirección: Carrera 4 Nº 11- 64.\n"
                . " Teléfono: 657 43 79.\n";
        $multitext3 = "------ Pereira ------\n"
                . "-Dirección: Manzana 44 Casa 25 corales.\n"
                . " Carrera 25 Nº 79-65.\n"
                . " Teléfono: 337 44 22.\n"
                . "------ Palmira ------\n"
                . "-Dirección: Calle 32 Nº 28-63.\n"
                . " Teléfono: 275 87 36.\n"
                . "------ Cartago ------\n"
                . "-Dirección: Carrera 3 Nº 15 – 81.\n"
                . " Teléfono: 210 29 99.\n"
                . "------ Santander de Quilichao ------\n"
                . "-Dirección: Carrera 12 Nº 5-81.\n"
                . " Teléfono: 829 74 68.\n";
        $multitext4 = "------ Buenaventura  ------\n"
                . "-Centro: Calle 1 Nº 7-09.\n"
                . " Teléfono: 210 29 99.\n"
                . "-San Luis: Calle 6 Nº 33 – 44\n"
                . " Teléfono: 244 32 63.\n"
                . "------ Jamundí  ------\n"
                . "-Dirección: Carrera 10 Nº 12 - 71.\n"
                . " Teléfono: 590 27 30.\n"
                . "------ Roldanillo   ------\n"
                . "-Dirección: Calle 8 Nº 8-68.\n"
                . " Teléfono: 229 54 64.\n"
                . "------ Armenia   ------\n"
                . "-Dirección: Avenida Bolivar 9N - 15.\n"
                . " Teléfono: 745 43 10.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 187;
        $x2 = 203;
        $y2 = 187;
        $fontsize = 12;
        $redimibley = 190;
        $multitext2y = 195;
        $multitext3y = 195;
        $multitext4y = 195;
        $multitext2x = 6;
        $multitext3x = 80;
        $multitext4x = 140;
        $multifont = 8;
        break;
    case "HOTELESMS":
        $img = "../imgs/slideslandingUltra/ms.jpg";
        $web = "www.hotelesms.com";
        $parafo1 = "10% de descuento en";
        $parafo2 = "las habitaciones.";
        $texto1 = "10% de descuento en las habitaciones dobles y sencillas, los 7 dias de la semana. Ver el detalle en la sección:  \"Redimible en\"";
        $multitext = "- Se debe realizar reserva 48 horas antes de utilizar el cupón.\n"
                . "- No aplica para temporada alta (Enero, agosto, diciembre, ni semana santa programada en 2017 para el mes de abril).\n"
                . "- Valido en Cali, Bogotá, Lago Calima y Villavicencio.\n"
                . "- Valido hasta el 31 de Diciembre de 2017.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.\n"
                . "Contacto - Reservas: 6504001 Informes: 317 635 4880";

        $multitext2 = "-------- Tarifas Cali por noche --------\n"
                . "-Hotel MS Estación superior al norte de Cali.\n"
                . " (más seguro hotelero $8.300).\n"
                . "Habitación superior sencilla ................$130.000\n"
                . "Habitación superior doble....................$150.000\n"
                . "Persona adicional.................................$50.000\n\n"
                . "Hotel MS Chipichape superior\n"
                . "(más seguro hotelero $8.500)\n"
                . "Habitación superior sencilla ................$147.000\n"
                . "Habitación superior doble....................$167.000\n"
                . "Persona adicional..................................$50.000\n\n"
                . "Hotel MS Centenario superior\n"
                . "(más seguro hotelero $8.300)\n"
                . "Habitación superior sencilla ................$135.000\n"
                . "Habitación superior doble....................$155.000\n"
                . "Persona adicional..................................$50.000\n";

        $multitext3 = "--------Tarifas Cali por noche--------\n"
                . "Hotel MS Blue 66 superior\n"
                . "(más seguro hotelero $8.300).\n"
                . "Habitación superior sencilla ...................$150.000\n"
                . "Habitación superior doble.......................$170.000\n"
                . "Persona adicional.....................................$50.000\n\n"
                . "Hotel MS Ciudad Jardin Plus\n"
                . "(más seguro hotelero $8.900)\n"
                . "Habitación superior sencilla ...................$180.000\n"
                . "Habitación superior doble.......................$200.000\n"
                . "Persona adicional.....................................$50.000\n\n"
                . "Hotel MS Castellana Confort\n"
                . "(más seguro hotelero $7.300)\n"
                . "Habitación superior sencilla ...................$120.000\n"
                . "Habitación superior doble.......................$140.000\n"
                . "Persona adicional.....................................$50.000\n";

        $multitext4 = "--------Tarifas Bogtá por noche--------\n"
                . "Hotel MS Oceania Confort\n"
                . "(más seguro hotelero $7.300)\n"
                . "Habitación superior sencilla ...................$115.000\n"
                . "Habitación superior doble.......................$135.000\n"
                . "Persona adicional.....................................$50.000\n\n"
                . "-------- Tarifas Lago Calima --------\n"
                . "Hotel MS La Huerta Plus - Semana\n"
                . "Habitación sencilla..................................$120.000\n"
                . "Habitación doble.....................................$140.000\n"
                . "Fin de semana normal\n"
                . "Habitación sencilla..................................$150.000\n"
                . "Habitación doble.....................................$170.000\n"
                . "Puente\n"
                . "Habitación sencilla..................................$150.000\n"
                . "Habitación doble.....................................$170.000\n"
                . "Persona adicional.....................................$50.000\n";

        $multitext5 = "-------- Tarifas Villavicencio --------\n"
                . "Hotel MS Campestre La Potra\n"
                . "(Seguro Hotelero $14.000)\n"
                . "Semana\n"
                . "Habitación sencilla..................................$160.000\n"
                . "Habitacion doble.....................................$190.000\n"
                . "Fin de semana normal\n"
                . "Habitación doble.....................................$200.000\n"
                . "Puente\n"
                . "Habitación sencilla..................................$250.000\n"
                . "Persona adicional....................................$100.000\n"
                . "Habitación doble.....................................$250.000\n"
                . "Persona adicional....................................$120.000\n";

        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 179;
        $x2 = 203;
        $y2 = 179;
        $fontsize = 25;
        $redimibley = 180;
        $multitext2x = 6;
        $multitext3x = 53;
        $multitext4x = 103;
        $multitext5x = 153;
        $multitext2y = 186;
        $multitext3y = 186;
        $multitext4y = 186;
        $multitext5y = 186;
        $multifont = 6;
        break;
    case "MRSALNGMEYER":
        $img = "../imgs/slideslandingUltra/meyer.jpg";
        $web = "www.meyer.edu.co";
        $parafo1 = "20% de descuento en";
        $parafo2 = "todos los cursos de inglés.";
        $texto1 = "20% de descuento en todos los cursos que dicten del idioma inglés";
        $multitext = "- No acumulables.\n"
                . "- No aplica para cursos con descuentos ya establecidos.\n"
                . "- Valido hasta el 18 de Febrero de 2018.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Dirección: Calle 22 Nº 2N-58.\n"
                . "Teléfono: 660 26 67 o 661 44 44.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 174;
        $x2 = 203;
        $y2 = 174;
        $fontsize = 14;
        $redimibley = 175;
        $multitext2y = 180;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "MARDENHOGAR":
        $img = "../imgs/slideslandingUltra/marden3.jpg";
        $web = "www.comercializadoramarden.com";
        $parafo1 = "5% de descuento en muebles";
        $parafo2 = "y accesorios tecnológicos.";
        $texto1 = "5% de descuento en muebles modulares y accesorios tecnológicos.";
        $multitext = "- No aplica en caso de que hayan descuentos especiales o promociones de algún producto en oferta.\n"
                . "- Al momento de cancelar en la caja debe informar que es  CLIENTE ULTRA  de expreso palmira.\n"
                . "- No acumulable.\n"
                . "- Valido hasta el 10 de Marzo de 2018.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Palmira: Marden centro Carrera 28 Nº 29-60.\n"
                . "Palmira: C.Comercial Súper Marden la 47 local 30 calle 47-33 esquina.\n"
                . "Palmira: C.Comercial Súper Marden el Bosque local 20 carrera 1 transversal 32 esquina.\n"
                . "Cali Zona sur: C.Comercial Cañaveral carrera 32 Nº20-26.\n"
                . "Cali Zona norte: Avenida 3 Norte calle 38a-19 esquina.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 174;
        $x2 = 203;
        $y2 = 174;
        $fontsize = 25;
        $redimibley = 175;
        $multitext2y = 180;
        $multitext2x = 6;
        $multifont = 9;
        break;

    case "MARDENESCOLAR":
        $img = "../imgs/slideslandingUltra/marden1.jpg";
        $web = "www.comercializadoramarden.com";
        $parafo1 = "10% de descuento en productos";
        $parafo2 = "escolares, de oficina y papelería.";
        $texto1 = "10% de descuento en productos escolares, de oficina y papelería.";
        $multitext = "- No aplica en caso de que hayan descuentos especiales o promociones de algún producto en oferta.\n"
                . "- Al momento de cancelar en la caja debe informar que es  CLIENTE ULTRA  de expreso palmira.\n"
                . "- No acumulable.\n"
                . "- Valido hasta el 10 de Marzo de 2018.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Palmira: Marden centro Carrera 28 Nº 29-60.\n"
                . "Palmira: C.Comercial Súper Marden la 47 local 30 calle 47-33 esquina.\n"
                . "Palmira: C.Comercial Súper Marden el Bosque local 20 carrera 1 transversal 32 esquina.\n"
                . "Cali Zona sur: C.Comercial Cañaveral carrera 32 Nº20-26.\n"
                . "Cali Zona norte: Avenida 3 Norte calle 38a-19 esquina.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 174;
        $x2 = 203;
        $y2 = 174;
        $fontsize = 25;
        $redimibley = 175;
        $multitext2y = 180;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "MARDENESCOLAR":
        $img = "../imgs/slideslandingUltra/marden2.jpg";
        $web = "www.comercializadoramarden.com";
        $parafo1 = "7% de descuento en productos";
        $parafo2 = "de piñatería, fiesta y juguetería.";
        $texto1 = "7% de descuento en productos de piñatería, fiesta y juguetería.";
        $multitext = "- No aplica en caso de que hayan descuentos especiales o promociones de algún producto en oferta.\n"
                . "- Al momento de cancelar en la caja debe informar que es  CLIENTE ULTRA  de expreso palmira.\n"
                . "- No acumulable.\n"
                . "- Valido hasta el 10 de Marzo de 2018.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Palmira: Marden centro Carrera 28 Nº 29-60.\n"
                . "Palmira: C.Comercial Súper Marden la 47 local 30 calle 47-33 esquina.\n"
                . "Palmira: C.Comercial Súper Marden el Bosque local 20 carrera 1 transversal 32 esquina.\n"
                . "Cali Zona sur: C.Comercial Cañaveral carrera 32 Nº20-26.\n"
                . "Cali Zona norte: Avenida 3 Norte calle 38a-19 esquina.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 174;
        $x2 = 203;
        $y2 = 174;
        $fontsize = 25;
        $redimibley = 175;
        $multitext2y = 180;
        $multitext2x = 6;
        $multifont = 9;
        break;

    case "HAUSMUEBLES":
        $img = "../imgs/slideslandingUltra/haus.jpg";
        $web = "www.hauscolombia.com";
        //www.hauscolombia.com
        $parafo1 = "25% de descuento en";
        $parafo2 = "todos los muebles.";
        $texto1 = "25% de descuento en todos los muebles exhibidos en el establecimiento ubicado en Cali.";
        $multitext = "- El pago debe hacerse de contado.\n"
                . "- Valido los 6 dias de la semana..\n"
                . "- No acumulable con otras ofertas.\n"
                . "- Valido hasta el 18 de Febrero de 2018\n"
                . "- 1 cupón por producto.\n"
                . "- Es indispensable presentar al momento de la compra el cupón y la cédula del cliente ultra\n"
                . "  para hacer efectivo el descuento.\n"
                . "- El cupón no es redimible por dinero en efectivo.";

        $multitext2 = "Cali: Dirección: Calle 9 Nº23-51 Barrio alameda.\n"
                . " Teléfono: 514 10 28.\n"
                . "Celular: 312 806 02 76.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 179;
        $x2 = 203;
        $y2 = 179;
        $fontsize = 14;
        $redimibley = 180;
        $multitext2y = 185;
        $multitext2x = 6;
        $multifont = 9;
        break;

    case "COI":
        $img = "../imgs/slideslandingUltra/coi.jpg";
        $web = "www.odontologiacoi.com";
        $parafo1 = "Hasta el 45% de descuento en los";
        $parafo2 = "tratamientos.";
        $texto1 = "Obtén hasta 45% de descuento en los tratamientos de estética, implantes, prevención, ortodoncia, periodoncia y más";
        $multitext = "- No acumulable con otras promociones y/o descuentos.\n"
                . "- Vigencia hasta el 17 de abril de 2018";

        $multitext2 = "Cali:\n" .
                "Sede Norte: Calle 39N 2BN-121, Prados del norte\n" .
                "Tel: 666 11 56  Cel. 317 331 90 08\n" .
                "Sede Oriente: Transversal 103 Diagonal 26 P 13 No. 96 - 24, Barrio Marroquín II\n" .
                "Tel: 422 12 52 Cel. 3166921819\n\n"
                . "Buenaventura\n"
                . "Dirección: Carrera 2 No. 3 - 33  Edificio Vistamar, Hotel Cosmos\n"
                . "Tel: 297 87 47  Cel. 316 877 02 25.";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 150;
        $x2 = 203;
        $y2 = 150;
        $fontsize = 12;
        $redimibley = 151;
        $multitext2y = 157;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "EPEXPRESS":
        $img = "../imgs/slideslandingUltra/epx.jpg";
        $web = "www.epexpress.co";
        $parafo1 = "25% de descuento para";
        $parafo2 = "envíos entre 1 y 5 kg.";
        $texto1 = "25% de descuento para envíos entre 1 kilo a 5 kilos.";
        $multitext = "  Aplica para origen y destino entre las ciudades:\n"
                . "- Bogotá, Cali, Medellin Barranquilla, Bucaramanga, Ibagué, Pereira, Manizales, Armenia, Popayán y Pasto.\n"
                . "- Aplica para envíos realizados desde el 1 de junio hasta el 31 de diciembre de 2017.\n"
                . "- Indispensable presentar el cupón de descuento y la cedula del cliente ULTRA.\n"
                . "- El cupón no es redimible por dinero en efectivo.\n"
                . "- No se transportan títulos valores, armas, alucinógenos, material inflamable, insumos químicos, líquidos, animales vivos, mercancía sin empaque adecuado.\n"
                . "  Visite www.epexpress.co para ampliación de productos y servicios, puntos de venta en todo el país.\n";

        $multitext2 = " Teléfono: 314 617 87 82 \n"
                . " Correo: servicioalcliente@epexpress.co.\n";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 179;
        $x2 = 203;
        $y2 = 179;
        $fontsize = 14;
        $redimibley = 180;
        $multitext2y = 185;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "HDORADO":
        $img = "../imgs/slideslandingUltra/dorado.jpg";
        $web = "www.hotelesdoradogold.com";
        $parafo1 = "20% de descuento en";
        $parafo2 = "habitaciones";
        $texto1 = "20% de descuento en las habitaciones dobles y sencillas, los 7 días de la semana.";
        $multitext = "- Vigencia de 1 año.\n"
                . "- No aplica para otras promociones.\n"
                . "- Ilimitado.\n"
                . "- Reserva cuarenta y ocho (48) horas antes de utilizar el beneficio.\n"
                . "- Presentar cedula original y cupón virtual\n"
                . "- Incluye impuestos y desayuno.\n"
                . "- Reservas:hoteldoradoplatino@gmail.com con copia a doradoventashdg@gmail.com y gerenciaplatino@hotelesdoradogold.com.\n"
                . "- Contacto: Informes: 031 700 89 97 Asesor, Fernando Agudelo: 300 854 26 84";

        $multitext2 = "------ Hotel Dorado Gold Platino ------\n"
                . "-Dirección: Av. Caracas 51-39, sector chapinero.\n"
                . " Habitación sencilla...........$110.000.\n"
                . " Habitación doble..............$150.000.\n";

        $multitext3 = "------ Hotel Dorado ------\n"
                . "-Dirección: Calle 53 # 73-49, sector Normandía.\n"
                . " Habitación sencilla...........$120.000.\n"
                . " Habitación doble..............$160.000.\n";


        $multitext4 = "------ Hotel Dorado Prime ------\n"
                . "-Dirección: Av. Rojas 66-14.\n"
                . " Habitación sencilla...........$120.000.\n"
                . " Habitación doble..............$160.000.\n";

        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 185;
        $x2 = 203;
        $y2 = 185;
        $fontsize = 12;
        $redimibley = 189;
        $multitext2y = 195;
        $multitext3y = 195;
        $multitext4y = 195;
        $multitext2x = 6;
        $multitext3x = 78;
        $multitext4x = 150;
        $multifont = 8;
        break;
    case "UKUMARI":
        $img = "../imgs/slideslandingUltra/ukumari.jpg";
        $web = "www.ukumari.co";
        $parafo1 = "15% de descuento en los";
        $parafo2 = "pasaportes suricato y ceiba.";
        $texto1 = "15% de descuento en el valor de los pasaportes suricato y ceiba, tanto para el cliente ultra como para el acompañante.";
        $multitext = "- Vigencia de 1 año.\n"
                . "- No aplica para otras promociones y/o descuentos.\n"
                . "- Presentar cupón impreso y cedula del cliente ultra.\n"
                . "- Ilimitado.\n"
                . "- 7 días de la semana.";

        $multitext2 = " Dirección: km 14 vía Pereira – Cerritos sector Galicia \n"
                . " Teléfono: 311 81 00.\n";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 166;
        $x2 = 203;
        $y2 = 166;
        $fontsize = 14;
        $redimibley = 168;
        $multitext2y = 175;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "VERSILIA":
        $img = "../imgs/slideslandingUltra/versilia.jpg";
        $web = "www.facebook.com/versiliaoficial/#";
        $parafo1 = "10% de descuento en todos";
        $parafo2 = "los zapatos.";
        $texto1 = "10% de descuento en el calzado los 7 días de la semana.";
        $multitext = "- Vigencia de 1 año.\n"
                . "- No aplica para otras promociones ni descuentos.\n"
                . "- Aplica a nivel nacional.\n"
                . "- Ilimitado.\n";
        $multitext2 = "Más información\n
                       - Instagram: @versiliaoficial Facebook: @versiliaoficial\n
                       - Redimible a nivel nacional";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 160;
        $x2 = 203;
        $y2 = 160;
        $fontsize = 14;
        $redimibley = 163;
        $multitext2y = 168;
        $multitext2x = 6;
        $multifont = 9;
        break;
    case "MIS CARNES":
        $img = "../imgs/slideslandingUltra/miscarnes.jpg";
        $web = "www.miscarnesparrilla.com";
        $parafo1 = "10% de descuento en todos los";
        $parafo2 = "platos exhibidos en la carta.";
        $texto1 = "10% de descuento en todos los platos exhibidos en la carta a nivel nacional.";
        $multitext = "- Aplica los siete días de la semana.\n"
                . "- No aplica con otras promociones ni descuentos.\n"
                . "- No aplica para las bebidas.\n"
                . "- No aplica para el mis del mes.\n"
                . "- No aplica para los días martes y jueves de hamburguesa.";
        $multitext2 = "Más información sobre los puntos de venta en\n"
                ."- www.miscarnesparrilla.com\n".
                "- Redimible en todos los puntos de venta nacionales";
        $mw = 190;
        $mh = 5;
        $mw2 = 190;
        $mh2 = 5;
        $x1 = 6;
        $y1 = 165;
        $x2 = 203;
        $y2 = 165;
        $fontsize = 14;
        $redimibley = 167;
        $multitext2y = 173;
        $multitext2x = 6;
        $multifont = 9;
        break;
}

//echo $_SESSION['cod_usuario'];
if (!$error) {
    $sql = "SELECT cod_usuario,
              nombre,
              apellido,
              telefono, 
              ciudad,
              correo,
              fecha_nac
       FROM tbl_usuario       
       WHERE cod_usuario = '" . $usuario . "'";
    $stmt = $conexion->prepare($sql);
    $rs = $stmt->execute();
    $numfilas = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    if ($numfilas > 0) {

        $query = "SELECT concat(prefijo,consecutivo) as con, nombre FROM convenios_ultra WHERE nit = '" . $convenio . "'";
        $stmt = $conexion->prepare($query);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
        $row2 = $stmt->fetch(PDO::FETCH_OBJ);
        if ($numfilas > 0) {
            $consecutivo = $row2->con;
            $nom_convenio = $row2->nombre;
        }

        if ($nom_convenio == "EPEXPRESS") {
            $nom_convenio = "MENSAJERÍA Y PAQUETES";
        }

        //set it to writable location, a place for temp generated PNG files
//        $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..\tempQR' . DIRECTORY_SEPARATOR;
        //html PNG location prefix
        $PNG_WEB_DIR = '../tempQR/';
        include "../libreriraQR/phpqrcode/qrlib.php";
        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_WEB_DIR))
            mkdir($PNG_WEB_DIR);
//        $filename = $PNG_TEMP_DIR . $convenio . $usuario . '.png';
        $matrixPointSize = 2;
        $errorCorrectionLevel = 'L';

        $filename = $PNG_WEB_DIR . $convenio . $usuario . '.png';
        QRcode::png('http://www.expresopalmira.com.co/Model/chekConv.php?id_conv=' . $convenio . '&consec=' . $consecutivo . '&user=' . $usuario, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


        $cc = $row->cod_usuario;
        $nombre = $row->nombre;
        $apellido = $row->apellido;
        $telefono = $row->telefono;
        $ciudad = $row->ciudad;
        $correo = $row->correo;
        $fecha_nac = $row->fecha_nac;
        //insertar datos en usuarios_cupones
        $sql = "INSERT INTO usuarios_cupones values (null,'" . $usuario . "',"
                . "'" . $nombre . " " . $apellido . "',"
                . "'" . $convenio . "',"
                . "'" . $consecutivo . "',"
                . "'" . $date->format('Y-m-d H:i:s') . "',"
                . "0,"
                . "'" . $PNG_WEB_DIR . basename($filename) . "', 'A', '" . $date->format('Y-m-d H:i:s') . "', '" . $producto . "')";
        $stmt = $conexion->prepare($sql);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
        //
        $query = "UPDATE convenios_ultra set consecutivo = consecutivo+1 where nit = '" . $convenio . "'";
        $stmt = $conexion->prepare($query);
        $rs = $stmt->execute();
        $numfilas = $stmt->rowCount();
    }
    $stmt = null;
    $conexion = null;
    define('FPDF_FONTPATH', 'font/');
    require('../fpdf17/fpdf_js.php');

    class PDF_AutoPrint extends PDF_Javascript {

        function AutoPrint($dialog = true) {
            //Embed some JavaScript to show the print dialog or start printing immediately
            $param = ($dialog ? 'true' : 'false');
            $script = "print($param);";
            $this->IncludeJS($script);
        }

    }

    $pdf = new PDF_AutoPrint();
    $pdf->Open();

    $pdf->AddPage();
//Inicio Formato
//ancho, alto '', borde
//$pdf->Cell(206, 50, '', 1); //Linea bordeada
    $pdf->Image('../base/logotopdf.png', 0, 0, 0);
    $pdf->Image('../imgs/convenioUltra/pie.png', 0, 279, 0);

    $pdf->Image($img, 15, 78, 41, 40);
    $pdf->Image($PNG_WEB_DIR . basename($filename), 148, 78, 41, 40);

    $pdf->SetXY(70, 87);
    $pdf->SetFont('Arial', 'B', $fontsize);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->SetFont('Arial', '', 15);
    $pdf->Cell(30, 5, utf8_decode($nom_convenio), 0);

    $pdf->SetXY(70, 93);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(50, 5, $web, 0);

    $pdf->SetXY(70, 98);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(60, 5, $parafo1, 0);

    $pdf->SetXY(70, 103);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(70, 5, utf8_decode($parafo2), 0);

    $pdf->SetXY(70, 109);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(70, 5, utf8_decode($parafo3), 0);


    $pdf->SetXY(6, 124);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(30, 5, utf8_decode($nom_convenio), 0);

    $pdf->SetXY(6, 129);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(190, 5, utf8_decode($texto1), 0);


    $pdf->SetXY(6, 134);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(60, 5, "Condiciones y restricciones:", 0);

    $pdf->SetXY(6, 138);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell($mw, $mh, utf8_decode($multitext), 0);

    $pdf->SetXY(6, $redimibley);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(60, 5, "Redimible en:", 0);

    $pdf->SetXY($multitext2x, $multitext2y);
    $pdf->SetFont('Arial', '', $multifont);
    $pdf->MultiCell($mw2, $mh2, utf8_decode($multitext2), 0);

    $pdf->SetXY($multitext3x, $multitext3y);
    $pdf->SetFont('Arial', '', $multifont);
    $pdf->MultiCell($mw2, $mh2, utf8_decode($multitext3), 0);


    $pdf->SetXY($multitext4x, $multitext4y);
    $pdf->SetFont('Arial', '', $multifont);
    $pdf->MultiCell($mw2, $mh2, utf8_decode($multitext4), 0);

    $pdf->SetXY($multitext5x, $multitext5y);
    $pdf->SetFont('Arial', '', $multifont);
    $pdf->MultiCell($mw2, $mh2, utf8_decode($multitext5), 0);




//$pdf->Image('../imgs/convenioUltra/qr.png', 150, 80, 0);
//            x1, y1  , x2, y2
    $pdf->SetDrawColor(85, 84, 84);
    $pdf->Line(45, 35, 203, 35);
    $pdf->Line(53, 73, 203, 73);
    $pdf->Line(46, 121, 203, 121);
    $pdf->Line($x1, $y1, $x2, $y2); //4ta linea

    $pdf->SetXY(5, 4);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(85, 84, 84);
    $pdf->Cell(5, 60, 'Datos del cliente Ultra');

    $pdf->SetXY(5, 42);
    $pdf->Cell(0, 60, utf8_decode('Información del Descuento'));

    $pdf->SetXY(5, 90);
    $pdf->Cell(0, 60, utf8_decode('Detalles del descuento'));

    $pdf->SetXY(10, 14);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 60, 'Nombre: ');
    $pdf->SetXY(27, 14);
    $pdf->Cell(0, 60, $nombre);
//
    $pdf->SetXY(90, 14);
    $pdf->Cell(0, 60, 'Ciudad: ');
    $pdf->SetXY(107, 14);
    $pdf->Cell(0, 60, utf8_decode($ciudad)); //php
//
    $pdf->SetXY(90, 20);
    $pdf->Cell(0, 60, utf8_decode('Teléfono: '));
    $pdf->SetXY(107, 20);
    $pdf->Cell(0, 60, $telefono); //php
//
    $pdf->SetXY(90, 26);
    $pdf->Cell(0, 60, utf8_decode('Correo Electrónico: '));
    $pdf->SetXY(121, 26);
    $pdf->Cell(0, 60, $correo);
//
    $pdf->SetXY(10, 20);
    $pdf->Cell(0, 60, 'Apellidos: ');
    $pdf->SetXY(27, 20);
    $pdf->Cell(0, 60, $apellido);
//
    $pdf->SetXY(10, 26);
    $pdf->Cell(0, 60, utf8_decode('Cédula: '));
    $pdf->SetXY(27, 26);
    $pdf->Cell(0, 60, $cc);
//
    $pdf->SetXY(10, 32);
    $pdf->Cell(0, 60, 'Fecha de Nacimiento: ');
    $pdf->SetXY(45, 32);
    $pdf->Cell(0, 60, $fecha_nac);
//$pdf->SetXY(39, 10);
//$pdf->Cell(10, 15, 'Descuento:');
//
//$pdf->SetXY(39, 15);
//$pdf->Cell(10, 15, 'Condiciones del Servicio:');


    $pdf->Ln(7);

    $pdf->Output();
} else {
    echo "<script languaje='javascript' type='text/javascript'>alert('" . $msn . "');window.close();</script>";
}


/* * *********************************FIN HOJA ******************** */
?>



