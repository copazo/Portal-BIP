
{capture name=path}{l s='Shipping' mod='cashondelivery'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h2>Resumen de su pedido</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

<h3>Pago por Webpay</h3>

<form action="{$urlBase}cgi-bin/tbk_bp_pago.cgi" method="post">
    <INPUT TYPE="hidden" NAME="TBK_MONTO" VALUE="{$total}00">
    <INPUT TYPE="hidden" NAME="TBK_TIPO_TRANSACCION" VALUE="TR_NORMAL">
    <INPUT TYPE="hidden" NAME="TBK_ORDEN_COMPRA" VALUE="OC_{$transaccionId}">
    <INPUT TYPE="hidden" NAME="TBK_ID_SESION" VALUE="OC_{$transaccionId}">
    <INPUT TYPE="hidden" NAME="TBK_URL_EXITO" SIZE="40" VALUE="{$urlBase}modules/blockwebpay/transaccionOk.php" SIZE="2000">
    <INPUT TYPE="hidden" NAME="TBK_URL_FRACASO" SIZE="40" VALUE="{$urlBase}modules/blockwebpay/transaccionKo.php" SIZE="2000">
    
    
	<p>
		<img src="{$urlBase}modules/blockwebpay/web-pay-adq.gif" alt="Pago con Webpay" style="float:left; margin: 0px 10px 5px 0px;" />
		Ha elegido el metodo de pago por Webpay
		<br/><br />
		El monto total de su pedido es 
		<span id="amount_{$currencies.0.id_currency}" class="price">{convertPrice price=$total}</span>
		{if $use_taxes == 1}
		    tasas incluidas
		{/if}
	</p>
	<p>
		<br /><br />
		<br /><br />
		<b>Por favor, confirme su orden</b>
	</p>
	<p class="cart_navigation">
		<a href="{$link->getPageLink('order.php', true)}?step=3" class="button_large">Otros Modos de pago</a>
		<input type="submit" name="submit" value="Confirme su pedido" class="exclusive_large" />
	</p>
</form>
