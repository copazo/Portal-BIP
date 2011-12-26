<?php
include('../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/blockwebpay.php');
include(_PS_ROOT_DIR_.'/header.php');



$hostname = _DB_SERVER_;
$database = _DB_NAME_;
$username = _DB_USER_;
$password = _DB_PASSWD_;



$conexion = mysql_connect($hostname, $username, $password);
mysql_select_db($database ,$conexion) or die("Error seleccionando la base de datos."); 

$sql_webpay = "SELECT * FROM webpay order by TBK_ORDEN_COMPRA DESC Limit 1 ";

//$result_port = mysql_query($sql_port, $conn);
$fechapedido = date("Y-m-d");
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

switch($pagos){
   case VN:
      $vn = ("Sin Cuotas");
      break;
   case SI:
      $vn= ("Sin Intereses");
      break;
   case VC:
      $vn= ("Cuotas Comercio");
      break;
 }
 
	?>	
    	<table align="center">
        	<tr>
            	<td colspan="2"><strong>La transacci&oacute;n se ha efectuado correctamente </strong></td>
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="2"><strong>Detalles del pago con Webpay</strong></td>
            </tr>
            <tr>
            	<td><strong>Fecha del Pedido</strong></td>
                <?php 
				$blockwebpay = new BlockWebpay();
?>
                <td><?php echo $fechapedido; $id_cart = $cookie->id_cart;echo $id_cart;$blockwebpay->validateOrder($id_cart, _PS_OS_PREPARATION_, $cart->getOrderTotal(true, Cart::BOTH), 'Webpay', NULL,  array( 'payment_status' => 2), NULL, false, false); ?></td>
            </tr>
            <tr>
            	<td><strong>Codigo de Autorizaci&oacute;n </strong></td>
                <td><?php echo "$autorizacion" ?></td>
            </tr>
            <tr>
            	<td><strong>Numero de Tarjeta </strong></td>
                <td>XXXXXXXXXXXX-<?php echo "$tar_final" ?></td>
            </tr>
            <tr>
            	<td><strong>Cantidad de Cuotas</strong></td>
                <td><?php echo "$cuotas" ?></td>
            </tr>
            <tr>
            	<td><strong>Tipo de Cuotas</strong></td>
                <td><?php echo "$vn" ?></td>
            </tr>
    	</table>
    <?php	

	echo '<table><tr><td><a class="exclusive_large" href="'.__PS_BASE_URI__.'carrito">Regresar al Carrito</a></td></tr></table>';
?>
         
            
<?php
include(dirname(__FILE__).'/../../footer.php');