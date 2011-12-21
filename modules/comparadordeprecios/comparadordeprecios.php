<?php
/*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 8005 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class ComparadorDePrecios extends Module
{
	function __construct($dontTranslate = false)
	{
		$this->name = 'comparadordeprecios';
		$this->version = '1.0';
		$this->author = 'EXE';
		$this->tab = 'front_office_features';


		parent::__construct();

		if(!$dontTranslate)
		{
			$this->displayName = $this->l('Comparador de Precios');
			$this->description = $this->l('Permite hacer comparaciones de precios de otras tiendas.');
		}
	}

	function install()
	{
		$comparadorprecios ="CREATE TABLE IF NOT EXISTS comparadorprecios (
							  dacoId bigint(20) NOT NULL AUTO_INCREMENT,
							  dacoBip bigint(20) NOT NULL,
							  dacoEmail varchar(200) NOT NULL,
							  dacoUsuario varchar(200) NOT NULL,
							  dacoFecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
							  dacoURL varchar(2000) NOT NULL,
							  dacoValida int(1) NOT NULL DEFAULT '0',
							  dacoRelacion varchar(100) NOT NULL,
							  dacoPrecioComparacion bigint(20) NOT NULL,
							  dacoComparacionActiva int(11) NOT NULL DEFAULT '0',
							  dacoFuncionando int(11) NOT NULL DEFAULT '0',
							  dacoTienda varchar(50) NOT NULL DEFAULT '',
							  PRIMARY KEY (`dacoId`)
							) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
							
		$comparadorprecioshist  = "CREATE TABLE IF NOT EXISTS comparadorprecioshist (
							cophId BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
							dacoId BIGINT NOT NULL ,
							cophBIP BIGINT NOT NULL ,
							cophNombre VARCHAR( 1000 ) NOT NULL ,
							cophPrecioBip BIGINT NOT NULL ,
							cophPrecioComparacion BIGINT NOT NULL ,
							cohpFecha TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
							) ENGINE = MYISAM ";
		
		$viewProdPriceType = "CREATE OR REPLACE VIEW view_prod_price_type AS select pa.id_product AS id_product,al.name AS name,pa.price AS price from (((((ps_product_attribute pa join ps_product_attribute_combination pac) join ps_attribute a) join ps_attribute_lang al) join ps_attribute_group ag) join ps_attribute_group_lang agl) where ((pac.id_product_attribute = pa.id_product_attribute) and (a.id_attribute = pac.id_attribute) and (a.id_attribute = al.id_attribute) and (a.id_attribute_group = ag.id_attribute_group) and (ag.id_attribute_group = agl.id_attribute_group) and (al.id_lang = 3) and (agl.id_lang = al.id_lang) and (agl.name = 'PRECIO'))";
		$viewProdPrice = "CREATE OR REPLACE VIEW view_prod_price AS select t.id_product AS id_product,i.price AS internet,t.price AS tienda,m.price AS mall from ((view_prod_price_type i join view_prod_price_type t) join view_prod_price_type m) where ((i.id_product = t.id_product) and (t.id_product = m.id_product) and (ucase(i.name) = 'INTERNET') and (ucase(t.name) = 'TIENDAS') and (ucase(m.name) = 'MALL'))";

		return (parent::install() AND $this->registerHook('extraLeft')
				AND Db::getInstance()->Execute($comparadorprecios) 
				AND Db::getInstance()->Execute($comparadorprecioshist) 
				AND Db::getInstance()->Execute($viewProdPriceType) 
				AND Db::getInstance()->Execute($viewProdPrice) );
	}
	
	public function uninstall(){
		
		$comparadorprecios ="DROP TABLE IF EXISTS comparadorprecios";
		$comparadorprecioshist  = "DROP TABLE IF EXISTS comparadorprecioshist";
		
		return (parent::uninstall()
			AND Db::getInstance()->Execute($comparadorprecios)
			AND Db::getInstance()->Execute($comparadorprecioshist));
	}

	function hookExtraLeft($params)
	{
		global $smarty;
		$smarty->assign('this_path', $this->_path);
		return $this->display(__FILE__, 'product_page_comparador.tpl');
	}
	
	public function displayPageForm()
	{
		if (!$this->active)
			Tools::display404Error();

		include(dirname(__FILE__).'/../../header.php');
		echo $this->displayFrontForm();
		include(dirname(__FILE__).'/../../footer.php');
	}

	public function displayFrontForm()
	{
		global $smarty;
		$error = false;
		$confirm = false;

		if (isset($_POST['submitSendURL']))
		{
			global $cookie, $link;
			/* Product informations */
			$product = new Product((int)Tools::getValue('id_product'), false, (int)$cookie->id_lang);
			$productLink = $link->getProductLink($product);

			/* Fields verifications */
			if (empty($_POST['dacoURL']) OR empty($_POST['dacoURL']))
				$error = $this->l('Debes completar todos los campos.');
			elseif (empty($_POST['dacoEmail']) OR !Validate::isEmail($_POST['dacoEmail']))
				$error = $this->l('El email ingresado es inv�lido.');
			elseif (!isset($_POST['dacoUsuario']) OR !isset($_POST['dacoBip']) OR !is_numeric($_POST['dacoBip']))
				$error = $this->l('Ha ocurrido un error durante el proceso.');
			else{
				if (! Db::getInstance()->AutoExecute("comparadorprecios", array('dacoBip' =>  $_POST['dacoBip'], 'dacoEmail' =>  $_POST['dacoEmail'], 'dacoUsuario' =>  $_POST['dacoUsuario'],'dacoURL' =>  $_POST['dacoURL']), 'INSERT')){
					$error = $this->l('Ha ocurrido un error al guardar los datos.');
				}else{
					Tools::redirect(_MODULE_DIR_.'/'.$this->name.'/comparadordeprecios-form.php?id_product='.(int)$product->id.'&submited');
				}
			}
		}
		else
		{
			global $cookie, $link;
			/* Product informations */
			$product = new Product((int)Tools::getValue('id_product'), false, (int)$cookie->id_lang);
			$productLink = $link->getProductLink($product);
		}

		/* Image */
		$images = $product->getImages((int)$cookie->id_lang);
		foreach ($images AS $k => $image)
			if ($image['cover'])
			{
				$cover['id_image'] = (int)$product->id.'-'.(int)$image['id_image'];
				$cover['legend'] = $image['legend'];
			}

		if (!isset($cover)){
			$cover = array('id_image' => Language::getIsoById((int)$cookie->id_lang).'-default', 'legend' => 'No picture');
		}
			
			$profileCookie = $cookie->profile;
			if($cookie->logged){
				if(true){
					$tipoUsuario="Cliente";
				}else{
					$tipoUsuario="Vendedor";
				}
				$correo = $cookie->email;
			}else{
				$tipoUsuario = 'Publico';
				$correo = '';
			}
		
		
		$smarty->assign(array(
			'cover' => $cover,
			'errors' => $error,
			'profileCookie' => $profileCookie,
			'confirm' => $confirm,
			'product' => $product,
			'tipoUsuario' => $tipoUsuario,
			'email' => $correo,
			'productLink' => $productLink
		));

		return $this->display(__FILE__, 'comparadordeprecios.tpl');
	}
	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '<table><tr><td><iframe src="../modules/comparadordeprecios/comparacionPreciosIndex.php" name="ZONE1" width="920"  marginwidth="0" height="620" marginheight="0" scrolling="auto" frameborder="0" id="ZONE1" border="0"></iframe></td></tr></table>';
	}

	
}