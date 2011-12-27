<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockConfigurador extends Module
{
	public function __construct()
	{
		
		$this->name = 'blockconfigurador';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Exe Software';

		parent::__construct();

		$this->displayName = $this->l('Bloque de Configurador de PC');
		$this->description = $this->l('Agrega el Configurador de PC.');
		
		
	}

	public function install(){
	
		$tableConfiguradorLineas = "CREATE TABLE IF NOT EXISTS configurador_lineas (
								  coliLinea varchar(100) NOT NULL,
								  coliTipo int(11) NOT NULL COMMENT '1 Basico, 2 Medio, 3 Avanzado',
								  PRIMARY KEY (coliLinea))";
	
		$viewProdPriceType = "CREATE OR REPLACE VIEW view_prod_price_type AS select pa.id_product AS id_product,al.name AS name,pa.price AS price from (((((ps_product_attribute pa join ps_product_attribute_combination pac) join ps_attribute a) join ps_attribute_lang al) join ps_attribute_group ag) join ps_attribute_group_lang agl) where ((pac.id_product_attribute = pa.id_product_attribute) and (a.id_attribute = pac.id_attribute) and (a.id_attribute = al.id_attribute) and (a.id_attribute_group = ag.id_attribute_group) and (ag.id_attribute_group = agl.id_attribute_group) and (al.id_lang = 3) and (agl.id_lang = al.id_lang) and (agl.name = 'PRECIO'))";
		$viewFeatProdValue = "CREATE OR REPLACE VIEW view_feat_prod_value AS select fvl.value AS value,fp.id_product AS id_product,fp.id_feature AS id_feature from ((ps_feature_product fp join ps_feature_value fv) join ps_feature_value_lang fvl) where ((fp.id_feature_value = fv.id_feature_value) and (fv.id_feature_value = fvl.id_feature_value) and (fvl.id_lang = 3))";
		$viewProdPrice = "CREATE OR REPLACE VIEW view_prod_price AS select t.id_product AS id_product,i.price AS internet,t.price AS tienda,m.price AS mall from ((view_prod_price_type i join view_prod_price_type t) join view_prod_price_type m) where ((i.id_product = t.id_product) and (t.id_product = m.id_product) and (ucase(i.name) = 'INTERNET') and (ucase(t.name) = 'TIENDAS') and (ucase(m.name) = 'MALL'))";
		
		return (parent::install() 
				AND $this->registerHook('leftColumn') 
				AND Db::getInstance()->Execute($tableConfiguradorLineas)
				AND Db::getInstance()->Execute($viewProdPriceType)
				AND Db::getInstance()->Execute($viewFeatProdValue)
				AND Db::getInstance()->Execute($viewProdPrice));
	}

	public function uninstall(){
		$tableConfiguradorLineas ="DROP TABLE IF EXISTS view_prod_price_type";
		$viewProdPriceType ="DROP VIEW IF EXISTS view_prod_price_type";
		$viewFeatProdValue ="DROP VIEW IF EXISTS view_feat_prod_value";
		$viewProdPrice ="DROP VIEW IF EXISTS view_prod_price";
		
		return (parent::uninstall()
				AND Db::getInstance()->Execute($viewProdPriceType)
				AND Db::getInstance()->Execute($viewFeatProdValue)
				AND Db::getInstance()->Execute($viewProdPrice));
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '<table><tr><td><iframe src="../modules/blockconfigurador/adminConfigurador_pc.php" name="ZONE1" width="700"  marginwidth="0" height="600" marginheight="0" scrolling="no" frameborder="0" id="ZONE1" border="0"></iframe></td></tr></table>';
	}


	public function hookLeftColumn($params)
	{
		return '<table width="191px"><tr><td align="center"><a href="modules/blockconfigurador/configuradorMain.php"><img height="163" width="155" title="Banner Configurador PC" alt="Banner Configurador PC" src="./modules/blockconfigurador/SpryAssets/banner_configPc_bip_01.jpg" align="top"></a></td></tr></table>';
	}

	private function _clearBlockconfiguradorCache()
	{
		$this->_clearCache('blockconfigurador.tpl');
		Tools::restoreCacheSettings();
	}
	
	function myautoload($className)
	{
		$className = str_replace(chr(0), '', $className);
		$moduleDir = dirname(__FILE__).'/';
		$file_in_module = file_exists($moduleDir.$className.'.php');
	 
		if ($file_in_module)
			require_once($moduleDir.$className.'.php');
	}
}