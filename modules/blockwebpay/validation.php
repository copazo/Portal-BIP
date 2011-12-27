<?php


include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
	/* or ask for confirmation */ 
	$smarty->assign(array(
		'total' => $cart->getOrderTotal(true, Cart::BOTH),
		'urlBase' => Tools::getShopDomainSsl(true, true).__PS_BASE_URI__,
		'transaccionId' => date("YmdHis"),
		'this_path_ssl' => Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.'modules/blockwebpay/'
	));

	$smarty->assign('this_path', __PS_BASE_URI__.'modules/blockwebpay/');
	$template = 'validation.tpl';
	echo Module::display('blockwebpay', $template);

include(dirname(__FILE__).'/../../footer.php');