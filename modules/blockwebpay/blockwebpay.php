<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockWebpay extends PaymentModule
{
	public function __construct()
	{
		$this->name = 'blockwebpay';
		$this->tab = 'payments_gateways';
		$this->version = '1.0';
		$this->author = 'Exe Software';

		parent::__construct();

		$this->displayName = $this->l('Bloque de Integraci&oacute;n con Webpay');
		$this->description = $this->l('Agrega el m&oacute;dulo de integraci&oacute;n con Webpay.');
	}

	public function install(){
		if (!parent::install() OR
			!$this->registerHook('payment')
			){
			return false;
		}
		
		Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS webpay (
								  webpay_id int(10) NOT NULL AUTO_INCREMENT,
								  Tbk_Orden_Compra varchar(30) NOT NULL DEFAULT '',
								  Tbk_Codigo_Comercio varchar(12) DEFAULT NULL,
								  Tbk_Codigo_Comercio_Enc varchar(255) DEFAULT NULL,
								  Tbk_Tipo_Transaccion varchar(50) NOT NULL DEFAULT '',
								  Tbk_Respuesta int(2) NOT NULL DEFAULT '0',
								  Tbk_Monto int(10) NOT NULL DEFAULT '0',
								  Tbk_Codigo_Autorizacion varchar(6) NOT NULL DEFAULT '0',
								  Tbk_Numero_Tarjeta varchar(19) NOT NULL DEFAULT '0',
								  Tbk_Final_numero_Tarjeta varchar(4) NOT NULL DEFAULT '0',
								  Tbk_Fecha_Expiracion varchar(6) NOT NULL DEFAULT '',
								  Tbk_Fecha_Contable varchar(4) NOT NULL DEFAULT '',
								  Tbk_Fecha_Transaccion varchar(8) NOT NULL DEFAULT '',
								  Tbk_Hora_Transaccion varchar(6) NOT NULL DEFAULT '',
								  Tbk_Id_Sesion varchar(40) NOT NULL DEFAULT '',
								  Tbk_Id_Transaccion int(20) NOT NULL DEFAULT '0',
								  Tbk_Tipo_Pago char(2) NOT NULL DEFAULT '',
								  Tbk_Numero_Cuotas char(2) NOT NULL DEFAULT '0',
								  Tbk_Tasa_Interes_Max int(4) NOT NULL DEFAULT '0',
								  Tbk_Mac varchar(32) NOT NULL DEFAULT '',
								  TBK_VCI varchar(20) DEFAULT NULL,
								  FechaCompleta datetime DEFAULT NULL,
								  PRIMARY KEY (webpay_id),
								  KEY webpay_id (webpay_id),
								  KEY Tbk_Id_Sesion (Tbk_Id_Sesion),
								  KEY Tbk_Id_Transaccion (Tbk_Id_Transaccion),
								  KEY Tbk_Orden_Compra (Tbk_Orden_Compra)
								) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
		
		
		return true;
	}

	public function uninstall(){
		if (!parent::uninstall()){
			return false;
		}
		Db::getInstance()->Execute('DROP TABLE IF EXISTS webpay');
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '<table><tr><td></td></tr></table>';
	}


	public function hookPayment($params)
	{
		
		return '<p class="payment_module">
					<a title="Pago con Webpay" href="'.__PS_BASE_URI__.'modules/blockwebpay/validation.php" >
						<img width="86" height="49" alt="Pago con Webpay" src="'.__PS_BASE_URI__.'modules/blockwebpay/web-pay-adq.gif">
						Pago con Webpay
					</a>
				</p>';
	}

	private function _clearBlockconfiguradorCache()
	{
		$this->_clearCache('blockwebpay.tpl');
		Tools::restoreCacheSettings();
	}
	
}