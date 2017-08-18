<?php

include("funciones_mysql.php");
$conexion = conectar("expresop_epexpress");

$idProducto = $_POST['idProducto'];
//producto = 2 expreso
//producto = 3 super expreso
$origen = $_POST['origen'];

$and = "expreso = 1";
if ($idProducto==3) {
	$and = "super_expreso = 1";
}

$sql = "select cod_dane, nombre from destinos where id_origen  = ".$origen." and ".$and;

$resultado = ejecutar($sql, $conexion);

if (mysql_num_rows($resultado) > 0) {
	while ($campo = mysql_fetch_row($resultado)) {         
		

    }
}


?>


<label>Destino *</label>&nbsp;<label id="m_destino" style="display:none;color:red;">Campo Requerido</label>
				<select class="form-control" name="destino" id="destino" required="">
					<option value="">-- Seleccione --</option>
					<option value="05059">Armenia</option>
					<option value="68081">Barrancabermeja</option>
					<option value="08001">Barranquilla</option>
					<option value="11001">Bogota</option>
					<option value="68001">Bucaramanga</option>
					<option value="76109">Buenaventura</option>
					<option value="76111">Buga</option>
					<option value="76122">Caicedonia</option>
					<option value="76001">Cali</option>
					<option value="19142">Caloto</option>
					<option value="13001">Cartagena</option>
					<option value="76147">Cartago</option>
					<option value="54001">Cucuta</option>
					<option value="73268">Espinal</option>
					<option value="18001">Florencia</option>
					<option value="25307">Girardot</option>
					<option value="73001">Ibague</option>	
					<option value="52356">Ipiales</option>
					<option value="70400">La Union (N)</option>
					<option value="17001">Manizales</option>
					<option value="05001">Medellin</option>
					<option value="73449">Melgar</option>
					<option value="41001">Neiva</option>
					<option value="76520">Palmira</option>
					<option value="52001">Pasto</option>
					<option value="66001">Pereira</option>
					<option value="41551">Pitalito</option>
					<option value="19001">Popayan</option>
					<option value="86568">Puerto Asis</option>
					<option value="19573">Puerto Tejada</option>
					<option value="05615">Rionegro</option>
					<option value="52678">Samaniego</option>
					<option value="52683">Sandona</option>
					<option value="19698">Santander de Quilichao</option>
					<option value="47001">Santa Marta</option>
					<option value="76736">Sevilla</option>
					<option value="52835">Tumaco</option>
					<option value="76834">Tulua</option>
					<option value="52838">Tuquerres</option>											
				</select>