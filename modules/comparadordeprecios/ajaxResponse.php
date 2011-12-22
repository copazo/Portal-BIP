<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
$idConsulta = (isset($_GET["idConsulta"])) ? $_GET["idConsulta"] : exit();

if($idConsulta == 1){
	Db::getInstance()->AutoExecute("comparadorprecios", array('dacoComparacionActiva' => (int)$_GET["newStatus"],'dacoRelacion' => $_GET["dacoRelacion"]), 'UPDATE','`dacoId` = '.(int)($_GET["dacoId"]));
}

if($idConsulta == 2){
	$query ="SELECT cp.*, pl.name name, vpp.internet  
			FROM comparadorprecios cp, "._DB_PREFIX_."product_lang pl, view_prod_price vpp
			WHERE pl.id_product = dacoBip
			AND id_lang =3
			AND pl.id_product = vpp.id_product
			AND cp.dacoId =".$_GET["dacoId"];
		$resultLineas = Db::getInstance()->ExecuteS($query);
		
		foreach($resultLineas as $linea){
			$url = $linea["dacoURL"];
			if (!(strpos($url, 'www.paris.cl') === false)){
				$pos = strpos($url, 'www');		
				$url = substr($url, $pos);
				$pos = strpos($url, '/');
				$dominio = substr($url, 0, $pos);
				$restoUrl = substr($url, $pos);
				$arregloValores = http_request('GET', $dominio,80,$restoUrl); 
			 }else{
				$arregloValores = readURL($url);
			 }
			 $priceAndTienda = readWhat($url,$arregloValores);
			 
			 $price = str_replace(" ","",str_replace(",","",str_replace(".","",$priceAndTienda[0])));
			 if(strlen($price)>0 && strlen($price)<9){
				Db::getInstance()->AutoExecute("comparadorprecios", array('dacoPrecioComparacion' => (int)$price,'dacoFuncionando' => (int)"1", "dacoTienda"=>$priceAndTienda[1]), 'UPDATE','`dacoId` = '.(int)($linea["dacoId"]));
				Db::getInstance()->AutoExecute("comparadorprecioshist", array('dacoId' => $linea["dacoId"], 'cophBIP' =>  $linea["dacoBip"], 'cophNombre' =>  $linea["name"], 'cophPrecioBip' => (int) $linea["internet"], 'cophPrecioComparacion' =>  (int)$price), 'INSERT');
			 }else{
				Db::getInstance()->AutoExecute("comparadorprecios", array('dacoFuncionando' => (int)"0"), 'UPDATE','`dacoId` = '.(int)($linea["dacoId"]));
			 }
		}
		Header("Location: adminComparador.php");
}

function readWhat($url, $arrayValores){
	if (!(strpos($url, 'www.pcfactory.cl') === false)) {
		return array(0 =>readPCFactory($arrayValores), 1 => "PC Factory");
	}else if (!(strpos($url, 'www.paris.cl') === false)) {
		return array(0 =>readParis($arrayValores), 1 => "Paris");
	}else if (!(strpos($url, 'www.ripley.cl') === false)) {
		return array(0 =>readRipley($arrayValores), 1 => "Ripley");
	}else if (!(strpos($url, 'www.falabella.com') === false)) {
		return array(0 =>readFalabella($arrayValores), 1 => "Falabella");
	}else if (!(strpos($url, 'www.corona.cl') === false)) {
		return array(0 =>readCorona($arrayValores), 1 => "Corona");
	}
	else{
		return "Esta página no es soportada por el sistema";
	}
}
	
function readParis($arrayValores){
	$retorno = "";
	for($i=0;$i<sizeof($arrayValores);$i++){
		$pos = strpos($arrayValores[$i], 'ficha-producto-precio');
		if (!($pos === false)) {
			$indexPeso = (strpos($arrayValores[$i+1],'$')+1);
			$retorno= substr($arrayValores[$i+1],$indexPeso);
			break;
		}
	}
	return $retorno==""?"Hubo un problema al obtener el precio":$retorno;
}
	
function readCorona($arrayValores){
	$retorno = "";
	for($i=0;$i<sizeof($arrayValores);$i++){
		$pos = strpos($arrayValores[$i], 'class="precio_internet">');
		if (!($pos === false)) {
			$indexPeso = (strpos($arrayValores[$i+1],'$')+1);
			$retorno= substr($arrayValores[$i+1],$indexPeso);
			break;
		}
	}
	return $retorno==""?"Hubo un problema al obtener el precio":$retorno;
}

function readFalabella($arrayValores){
	$retorno = "";
	for($i=0;$i<sizeof($arrayValores);$i++){
		$pos = strpos($arrayValores[$i], '$</span>');
		if (!($pos === false)) {
			$indexPeso = (strpos($arrayValores[$i],'$</span>')+8);
			$indexCierreDiv = strpos($arrayValores[$i],'</div>');
			$retorno= substr($arrayValores[$i],$indexPeso,$indexCierreDiv-$indexPeso);
			break;
		}
	}
	return $retorno==""?"Hubo un problema al obtener el precio":$retorno;
}

function readRipley($arrayValores){
	$retorno = "";
	for($i=0;$i<sizeof($arrayValores);$i++){
		$pos = strpos($arrayValores[$i], 'Precio Internet: $');
		if (!($pos === false)) {
			$indexPeso = (strpos($arrayValores[$i],'$')+1);
			$indexCierreDiv = strpos($arrayValores[$i],'</div>');
			$retorno= substr($arrayValores[$i],$indexPeso,$indexCierreDiv-$indexPeso);
			break;
		}
	}
	return $retorno==""?"Hubo un problema al obtener el precio":$retorno;
}

function readPCFactory($arrayValores){
	$retorno = "";
	for($i=0;$i<sizeof($arrayValores);$i++){
		$pos = strpos($arrayValores[$i], 'texto_Precio_Oferta_Internet_BIG');
		if (!($pos === false)) {
			
			if(sizeof($arrayValores)>=$i+1){
				$indexEspacio = strpos($arrayValores[$i+1],'&nbsp;');
				$retorno= substr($arrayValores[$i+1],0,$indexEspacio);
				break;
			}
		}
	}
	return $retorno==""?"Hubo un problema al obtener el precio":$retorno;
}

function readURL($url){
	$arrayValores="";
	$contador=0;
	$file_handle = fopen($url, "r");
	if ( $file_handle ) {
		while (!feof($file_handle)) {
			$fila = trim(fgets($file_handle));
			if($fila!=""){
				$arrayValores[$contador++]=$fila;
			}
		}
	}
	return $arrayValores;
}

function http_request( 
    $verb = 'GET',             /* HTTP Request Method (GET and POST supported) */ 
    $ip,                       /* Target IP/Hostname */ 
    $port = 80,                /* Target TCP port */ 
    $uri = '/',                /* Target URI */ 
    $getdata = array(),        /* HTTP GET Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $postdata = array(),       /* HTTP POST Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $cookie = array(),         /* HTTP Cookie Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $custom_headers = array(), /* Custom HTTP headers ie. array('Referer: http://localhost/ */ 
    $timeout = 1000,           /* Socket timeout in milliseconds */ 
    $req_hdr = false,          /* Include HTTP request headers */ 
    $res_hdr = false           /* Include HTTP response headers */ 
    ) 
{ 
    $ret = ''; 
    $verb = strtoupper($verb); 
    $cookie_str = ''; 
    $getdata_str = count($getdata) ? '?' : ''; 
    $postdata_str = ''; 

    foreach ($getdata as $k => $v) 
                $getdata_str .= urlencode($k) .'='. urlencode($v) . '&'; 

    foreach ($postdata as $k => $v) 
        $postdata_str .= urlencode($k) .'='. urlencode($v) .'&'; 

    foreach ($cookie as $k => $v) 
        $cookie_str .= urlencode($k) .'='. urlencode($v) .'; '; 

    $crlf = "\r\n"; 
    $req = $verb .' '. $uri . $getdata_str .' HTTP/1.1' . $crlf; 
    $req .= 'Host: '. $ip . $crlf; 
    $req .= 'User-Agent: Mozilla/5.0 Firefox/3.6.12' . $crlf; 
    $req .= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' . $crlf; 
    $req .= 'Accept-Language: en-us,en;q=0.5' . $crlf; 
    $req .= 'Accept-Encoding: deflate' . $crlf; 
    $req .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' . $crlf; 
    
    foreach ($custom_headers as $k => $v) 
        $req .= $k .': '. $v . $crlf; 
        
    if (!empty($cookie_str)) 
        $req .= 'Cookie: '. substr($cookie_str, 0, -2) . $crlf; 
        
    if ($verb == 'POST' && !empty($postdata_str)) 
    { 
        $postdata_str = substr($postdata_str, 0, -1); 
        $req .= 'Content-Type: application/x-www-form-urlencoded' . $crlf; 
        $req .= 'Content-Length: '. strlen($postdata_str) . $crlf . $crlf; 
        $req .= $postdata_str; 
    } 
    else $req .= $crlf; 
    
    if ($req_hdr) 
        $ret .= $req; 
    
    if (($fp = @fsockopen($ip, $port, $errno, $errstr)) == false) 
        return "Error $errno: $errstr\n"; 
    
    stream_set_timeout($fp, 0, $timeout * 1000); 
    
    fputs($fp, $req); 
	$arreglo = Array();
    while ($line = fgets($fp)){
		$ret .= $line;
		array_push($arreglo,$line);
	}	
    fclose($fp); 
    
    if (!$res_hdr) 
        $ret = substr($ret, strpos($ret, "\r\n\r\n") + 4); 
		array_push($arreglo,$ret);
    
    return $arreglo; 

}

if($idConsulta == 3){
	Db::getInstance()->Execute('DELETE FROM comparadorprecioshist WHERE dacoId = '.(int)($_GET["dacoId"]));
	Db::getInstance()->Execute('DELETE FROM comparadorprecios WHERE dacoId = '.(int)($_GET["dacoId"]));
	Header("Location: adminComparador.php");
}
?>