<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
$hostname = _DB_SERVER_;
$database = _DB_NAME_;
$username = _DB_USER_;
$password = _DB_PASSWD_;

$conexion = mysql_connect($hostname, $username, $password);
mysql_select_db($database ,$conexion) or die("Error seleccionando la base de datos."); 

$sql_webpay = "SELECT * FROM webpay order by TBK_ORDEN_COMPRA DESC Limit 1 ";

//$result_port = mysql_query($sql_port, $conn);
$fechapedido = date("Y-m-d");
$result_pagos = mysql_query($sql_pagos, $conexion);
$result_webpay = mysql_query($sql_webpay, $conexion);

$i=0;
while($myrow_not = mysql_fetch_array($result_webpay))
			{
			$i++;
			 $t_compra=$myrow_not[Tbk_Orden_Compra]; 
			 $t_monto = $myrow_not[Tbk_Monto]; 
			 $tar_final=$myrow_not[Tbk_Final_numero_Tarjeta]; 
			 $cuotas=$myrow_not[Tbk_Numero_Cuotas]; 
			 $autorizacion=$myrow_not[Tbk_Codigo_Autorizacion]; 
		     $pagos=$myrow_not[Tbk_Tipo_Pago]; 
			} //Fin While
	$e=0;		


?> 