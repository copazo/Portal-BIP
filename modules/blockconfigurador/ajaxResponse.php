<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
$idConsulta = (isset($_GET["idConsulta"])) ? $_GET["idConsulta"] : exit();

if($idConsulta == 1){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["linea"])>0){
		$query = "	SELECT p.id_product id_product, pl.name name, vfpv21.value linea, vfpv22.value marca, vfpv23.value socket, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl, 
					view_feat_prod_value vfpv21, view_feat_prod_value vfpv22, 
					view_feat_prod_value vfpv23, view_prod_price vpp
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category = 2125 
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND p.id_product = vfpv21.id_product
					AND vfpv21.id_feature = 21
					AND p.id_product = vfpv22.id_product
					AND vfpv22.id_feature = 22
					AND p.id_product = vfpv23.id_product
					AND vfpv23.id_feature = 23
					AND vfpv21.value = '".mysql_real_escape_string($_REQUEST["linea"])."' 
					AND vpp.id_product = p.id_product  ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<marca><![CDATA[".$fila["marca"]."]]></marca>\n";
				$xml.="<socket><![CDATA[".$fila["socket"]."]]></socket>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran Procesadores de esta familia]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó línea]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 2){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["socket"])>0 /* && strlen($_REQUEST["videoint"])>0 */){
		$query = "	SELECT p.id_product id_product, pl.name name, vfpv23.value SOCKET, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp,  
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl,
					view_feat_prod_value vfpv23, view_prod_price vpp
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1272
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND pl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND l.id_lang =3
					AND vfpv23.id_product = p.id_product
					AND vfpv23.id_feature = 23
					AND vfpv23.value = '".mysql_real_escape_string($_REQUEST["socket"])."'
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		
		
		if(count($result)>0){
			
			foreach($result as $fila){
				$queryFeatures = "	SELECT value, id_feature
							FROM view_feat_prod_value vfpv
							WHERE vfpv.id_product = ".$fila["id_product"]."
							AND (vfpv.id_feature = 7
							OR vfpv.id_feature = 16
							OR vfpv.id_feature = 26
							OR vfpv.id_feature = 27
							OR vfpv.id_feature = 31) order by id_feature ";
				$resulFeatures = Db::getInstance()->ExecuteS($queryFeatures); 
				if(count($resulFeatures)==5){
					$xml.="<producto>";
					$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
					$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
					$xml.="<socket><![CDATA[".$fila["SOCKET"]."]]></socket>\n";
					
					$xml.="<tiporam><![CDATA[".$resulFeatures[0]["value"]."]]></tiporam>\n";
					$xml.="<puertovideo><![CDATA[".$resulFeatures[1]["value"]."]]></puertovideo>\n";
					$xml.="<videoint><![CDATA[".$resulFeatures[2]["value"]."]]></videoint>\n";
					$xml.="<connector><![CDATA[".$resulFeatures[3]["value"]."]]></connector>\n";
					$xml.="<tamano><![CDATA[".$resulFeatures[4]["value"]."]]></tamano>\n";
					
					$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
					$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
					
					$xml.="</producto>";	

				}
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encontraron placas madres con éstas características]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó el socket]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 3){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["conector"])>0){
		$query = "	SELECT p.id_product id_product, pl.name name, vfpv24.value connector, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl,
					view_feat_prod_value vfpv24, view_prod_price vpp
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1257
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vfpv24.id_product = p.id_product
					AND vfpv24.id_feature = 24
					AND vfpv24.value = '".mysql_real_escape_string($_REQUEST["conector"])."'
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<connector><![CDATA[".$fila["connector"]."]]></connector>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran discos duros compatibles]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó el conector]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 4){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["tipoRam"])>0){
		$query = "	SELECT p.id_product id_product, pl.name name, vfpv7.value tipoRam, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl,
					view_feat_prod_value vfpv7, view_prod_price vpp
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1264
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vfpv7.id_product = p.id_product
					AND vfpv7.id_feature = 7
					AND vfpv7.value = '".mysql_real_escape_string($_REQUEST["tipoRam"])."'
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<tiporam><![CDATA[".$fila["tipoRam"]."]]></tiporam>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran memorias compatibles]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó el tipo de memoria]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}


if($idConsulta == 5){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["tamano"])>0 && strlen($_REQUEST["incluyeFP"])>0){
		$query = "	SELECT p.id_product id_product, pl.name name, vfpv31.value tamano, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_feat_prod_value vfpv91,
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl,
					view_feat_prod_value vfpv31, view_prod_price vpp
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1260
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vfpv31.id_product = p.id_product
					AND vfpv31.id_feature = 31
					AND vfpv31.value = '".mysql_real_escape_string($_REQUEST["tamano"])."'
					AND vfpv91.id_product = p.id_product
					AND vfpv91.id_feature = 91
					AND vfpv91.value = '".mysql_real_escape_string($_REQUEST["incluyeFP"])."'
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<tamano><![CDATA[".$fila["tamano"]."]]></tamano>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran gabinetes compatibles]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó el tipo de placa]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 6){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	
	if(strlen($_REQUEST["tamano"])>0){
		$query = "	SELECT p.id_product id_product, pl.name name, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_prod_price vpp, view_feat_prod_value vfpv31,  
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1259
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND vfpv31.id_product = p.id_product
					AND vfpv31.id_feature = 31
					AND vfpv31.value = '".mysql_real_escape_string($_REQUEST["tamano"])."'
					AND l.id_lang =3
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran Fuentes compatibles]]></mensaje>\n";
		}
	}else{
		$xml.="<mensaje><![CDATA[No se seleccionó el tipo de placa]]></mensaje>\n";
	}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 7){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	

		$query = "	SELECT p.id_product id_product, pl.name name, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_prod_price vpp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1269
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran tarjetas de sonido]]></mensaje>\n";
		}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 8){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	

		$query = "	SELECT p.id_product id_product, pl.name name, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_prod_price vpp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1268
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran tarjetas de video]]></mensaje>\n";
		}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 9){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	

		$query = "	SELECT p.id_product id_product, pl.name name, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_prod_price vpp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1262
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3 AND vpp.id_product = p.id_product  ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran unidades opticas]]></mensaje>\n";
		}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 10){
	$xml="<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xml.="<respuesta>\n";
	

		$query = "	SELECT p.id_product id_product, pl.name name, vpp.internet precio, vpp.tienda tienda
					FROM "._DB_PREFIX_."product p, "._DB_PREFIX_."category_product cp, view_prod_price vpp, 
					"._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl, "._DB_PREFIX_."lang l, "._DB_PREFIX_."product_lang pl
					WHERE p.id_product = cp.id_product
					AND c.id_category = cp.id_category
					AND c.id_category =1261
					AND c.id_category = cl.id_category
					AND cl.id_lang = l.id_lang
					AND p.id_product = pl.id_product
					AND pl.id_lang = l.id_lang
					AND l.id_lang =3
					AND vpp.id_product = p.id_product ";
		$result = Db::getInstance()->ExecuteS($query); 
		if(count($result)>0){
			foreach($result as $fila){
				$xml.="<producto>";
				$xml.="<id_product><![CDATA[".$fila["id_product"]."]]></id_product>\n";
				$xml.="<name><![CDATA[".$fila["name"]."]]></name>\n";
				$xml.="<precio><![CDATA[".$fila["precio"]."]]></precio>\n";
				$xml.="<ptienda><![CDATA[".$fila["tienda"]."]]></ptienda>\n";
				$xml.="</producto>";
			}
		}else{
			$xml.="<mensaje><![CDATA[No se encuentran disketereas compatibles]]></mensaje>\n";
		}
	$xml.="</respuesta>\n";
	header('Content-Type: text/xml');
	echo $xml;
}

if($idConsulta == 11){
		Db::getInstance()->delete("configurador_lineas", true);
		$query = "	select distinct(fvl.value) nombreLinea from "._DB_PREFIX_."product p, "._DB_PREFIX_."product_lang pl, "._DB_PREFIX_."feature_product 
		fp, "._DB_PREFIX_."feature f, "._DB_PREFIX_."feature_lang fl, "._DB_PREFIX_."lang l,  "._DB_PREFIX_."feature_value fv, 
		"._DB_PREFIX_."feature_value_lang fvl, "._DB_PREFIX_."category_product cp, "._DB_PREFIX_."category c, "._DB_PREFIX_."category_lang cl
		where fp.id_product = p.id_product 
		and pl.id_product = p.id_product
		and pl.id_lang = l.id_lang
		and l.id_lang = 3
		and f.id_feature = fp.id_feature
		and f.id_feature = fl.id_feature
		and l.id_lang = fl.id_lang
		and f.id_feature = fv.id_feature
		and fvl.id_feature_value = fv.id_feature_value
		and fvl.id_lang = l.id_lang
		and fp.id_feature_value = fv.id_feature_value
		and cp.id_product = p.id_product
		and cp.id_category = c.id_category
		and cl.id_category = c.id_category
		and cl.id_lang = l.id_lang
		and c.id_category = 2125 
		and f.id_feature = 21
		ORDER BY nombreLinea;";
		$resultLineas = Db::getInstance()->ExecuteS($query);

		foreach($resultLineas as $linea){
			if(isset($_POST[urlencode($linea['nombreLinea'])])){
				Db::getInstance()->AutoExecute("configurador_lineas", array('coliLinea' => $linea['nombreLinea'], 'coliTipo' => (int)($_POST[urlencode($linea['nombreLinea'])])), 'INSERT');
			}
		}
	Header("Location: adminConfigurador_pc.php");
}
?>