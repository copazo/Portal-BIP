<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$tipoSeleccionado = (isset($_POST["tipo"])?$_POST["tipo"]:1);

$query = "SELECT l.nombreLinea FROM (SELECT distinct(fvl.value) nombreLinea from "._DB_PREFIX_."product p, "._DB_PREFIX_."product_lang pl, "._DB_PREFIX_."feature_product 
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
and f.id_feature = 21) l, configurador_lineas cl
WHERE l.nombreLinea=cl.coliLinea
AND cl.coliTipo = ".$tipoSeleccionado."
ORDER BY l.nombreLinea;";
$resultLineas = Db::getInstance()->ExecuteS($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Configurador de PC - BIP COMPUTERS</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
var lineaArray = new Array();
var lineaPlaca = new Array();
var placaArray = new Array();
var memoriaArray = new Array();
var discoArray = new Array();
var gabineteArray = new Array();
var fuenteArray = new Array();
var sonidoArray = new Array();
var videoArray = new Array();
var uoArray = new Array();
var diskArray = new Array();
var procesadorArray= new Array();

function enviarTodoACarro(){
	//Principales
	var procesador = getValueFromCombo(document.getElementById("selectProcesador"));
	var tm = getValueFromCombo(document.getElementById("selectTM"));
	var gabinete = getValueFromCombo(document.getElementById("selectGabinete"));
	var fuente = getValueFromCombo(document.getElementById("selectFuente"));
	var tv = getValueFromCombo(document.getElementById("selectTV"));
	var ts = getValueFromCombo(document.getElementById("selectTS"));
	var disk = getValueFromCombo(document.getElementById("selectDisk"));
	
	enviaCarro(procesador,20);
	enviaCarro(tm,21);
	enviaCarro(gabinete,28);
	enviaCarro(fuente,29);
	enviaCarro(tv,30);
	enviaCarro(ts,31);
	enviaCarro(disk,32);

	enviaCarro(document.getElementById("inputMouseCode").value,36);
	enviaCarro(document.getElementById("inputTecladoCode").value,37);
	enviaCarro(document.getElementById("inputMonitorCode").value,38);
	enviaCarro(document.getElementById("inputWebcamCode").value,39);
	enviaCarro(document.getElementById("inputParlantesCode").value,40);
	
	var ajaxObjectNumber = 100;
	for(var m = 0; m<=memoriaNumeros; m++){
		if(document.getElementById("tablaMemorias"+m+"CodBip")!=null){
			enviaCarro(document.getElementById("tablaMemorias"+m+"CodBip").value, ajaxObjectNumber);
			ajaxObjectNumber++;
		}
	}
	
	for(var m = 0; m<=ddNumeros; m++){
		if(document.getElementById("tablaDD"+m+"CodBip")!=null){
			enviaCarro(document.getElementById("tablaDD"+m+"CodBip").value, ajaxObjectNumber);
			ajaxObjectNumber++;
		}
	}
	
	for(var m = 0; m<=uoNumeros; m++){
		if(document.getElementById("tablaUO"+m+"CodBip")!=null){
			enviaCarro(document.getElementById("tablaUO"+m+"CodBip").value, ajaxObjectNumber);
			ajaxObjectNumber++;
		}
	}
	parent.document.location.href="<?php echo __PS_BASE_URI__; ?>carrito";
}

function enviaCarro(idProduct,conexion){

	var ajaxObject = seConnect(conexion);
	var url="<?php echo __PS_BASE_URI__; ?>carro-de-la-compra";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?token=<?php echo Tools::getToken(false); ?>";
		   params+="&id_product="+idProduct;
		   params+="&add=1";
		   params+="&id_product_attribute=";
		   params+="Submit=Añadir+al+carrito";
		   
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaEnviaCarro(conexion);
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema enviando al carro");
		}
	}
}

function respuestaEnviaCarro(conexion){
	var ajaxObject = seConnect(conexion);
	try{
		if (ajaxObject.readyState==4){
			if (ajaxObject.status == 200){
				
			}
		}
	}catch(err){        
			alert("Problema enviando los productos al carro");
		}
}

function limpiar(componente){
	document.getElementById("input"+componente).value="";
	document.getElementById("input"+componente+"Code").value="";
	document.getElementById("input"+componente+"Precio").value=0;
	document.getElementById("input"+componente+"PrecioTienda").value=0;
	calcularTotal();
}

function eliminarFila(idFila){
	var element = document.getElementById(idFila);
  	element.parentNode.removeChild(element);
	calcularTotal();
}

function agregarElementoSeleccionadoResumen(id, nombre){
	var newRow = document.createElement("tr");
	var newCell1 = document.createElement("td");
	var tableBody = document.getElementById(id);
	
	newCell1.innerHTML=nombre;
	newRow.appendChild(newCell1);	
	tableBody.appendChild(newRow);
}

function agregarElementoSeleccionado(id, numero, nombre, valorTienda, valorInternet, codigoBip){
	var newRow = document.createElement("tr");
	newRow.setAttribute("id",id+numero)
	var newCell1 = document.createElement("td");
	var newCell2 = document.createElement("td");
	var newCell3 = document.createElement("td");
	var newCell4 = document.createElement("td");
	
	var tableBody = document.getElementById(id);
	
	newCell1.innerHTML='<input type="text" id="'+id+numero+'Nombre" value="'+nombre+'" disabled="disabled"  size="80"/>';
	newCell2.innerHTML='<input type="text" id="'+id+numero+'Tienda" value="'+valorTienda+'" disabled="disabled" style="display:none" />';
	newCell3.innerHTML='<input type="text" id="'+id+numero+'Internet" value="'+valorInternet+'" disabled="disabled" style="display:none"/><input type="text" id="'+id+numero+'CodBip" value="'+codigoBip+'" disabled="disabled" style="display:none"/>';
	newCell4.innerHTML='<a href="#" onclick="eliminarFila(\''+id+numero+'\');"> Eliminar </a>';
	
	newRow.appendChild(newCell1);
	newRow.appendChild(newCell2);
	newRow.appendChild(newCell3);
	newRow.appendChild(newCell4);
	
	tableBody.appendChild(newRow);
	
	calcularTotal();
}

var memoriaNumeros = 0;
function agregarMemoria(){
	var memoriaSeleccionada = getValueFromCombo(document.getElementById("selectMemoria"));
	if(memoriaSeleccionada !=-1){
		memoriaNumeros++;
		for(var i=0; i<memoriaArray.length; i++) {
			if(memoriaArray[i][0]==memoriaSeleccionada){
				var nombre =memoriaArray[i][1];
				var tienda =(parseInt(memoriaArray[i][4]));
				var internet =(parseInt(memoriaArray[i][3]));
				var codBip = memoriaSeleccionada;
				agregarElementoSeleccionado('tablaMemorias', memoriaNumeros, nombre, tienda , internet, codBip);
				
				
				break;
			}
		}
	}else{
		alert('Debe seleccionar una memoria');
	}
}

var ddNumeros = 0;
function agregarDD(){
	var ddSeleccionada = getValueFromCombo(document.getElementById("selectHD"));
	if(ddSeleccionada  !=-1){
		ddNumeros++;
		for(var i=0; i<discoArray.length; i++) {
			if(discoArray[i][0]==ddSeleccionada ){
				var nombre =discoArray[i][1];
				var tienda =(parseInt(discoArray[i][4]));
				var internet =(parseInt(discoArray[i][3]));
				var codBip = ddSeleccionada;
				agregarElementoSeleccionado('tablaDD', ddNumeros, nombre, tienda , internet, codBip);
				
				break;
			}
		}
	}else{
		alert('Debe seleccionar un Disco Duro');
	}
}

var uoNumeros = 0;
function agregarUO(){
	var uoSeleccionada = getValueFromCombo(document.getElementById("selectUO"));
	if(uoSeleccionada !=-1){
		uoNumeros++;
		for(var i=0; i<uoArray.length; i++) {
			if(uoArray[i][0]==uoSeleccionada){
				var nombre =uoArray[i][1];
				var tienda =(parseInt(uoArray[i][3]));
				var internet =(parseInt(uoArray[i][2]));
				var codBip = uoSeleccionada;
				agregarElementoSeleccionado('tablaUO', uoNumeros, nombre, tienda , internet, codBip);
				
				break;
			}
		}
	}else{
		alert('Debe seleccionar una unidad optica');
	}
}


function setValueForCombo(combo, value){
    for (var i=0; i<combo.options.length; i++){
        if(combo.options[i].value == value){
            combo.options[i].selected = true;
        }else{
            combo.options[i].selected = false;
        }
    }
}

function getValueFromCombo(combo){
	var returnValue=-1;
	if(combo.options.length>0){
		returnValue = combo.options[combo.selectedIndex].value;
	}
    return returnValue;
}


function seleccionaTipoPC(radio){
	document.getElementById('tipoPcSeleccionado').innerHTML = radio.value;
}

var idInputNombre;
var idInputPrecio;
var idInputPrecioTienda;
var idInputCodigoBip;

function setIds(nombreId){
	idInputNombre=nombreId;
	idInputPrecio=nombreId+'Precio';
	idInputPrecioTienda=nombreId+'PrecioTienda';
	idInputCodigoBip=nombreId+'Code';
}

function seteandoValores(nombreIframe, codigoBipIframe, precioIframe, precioIframeTienda){
	document.getElementById(idInputNombre).value = nombreIframe;
	document.getElementById(idInputCodigoBip).value = codigoBipIframe;
	document.getElementById(idInputPrecio).value = Math.round(precioIframe);
	document.getElementById(idInputPrecioTienda).value = precioIframeTienda;
	window.parent.jQuery.fancybox.close();
	calcularTotal();
}
function changeCheckboxVideo(){
	removeOptions(document.getElementById('selectTV'));
	var id_product = document.getElementById('selectTM').value;
	document.getElementById("divTVSiNo").innerHTML=(document.getElementById("checkVideo").checked?"Si":"No");
	
	if(id_product != -1 && id_product != ""){
		var idPlacaSeleccionada=0;
		var placaObj=null;
		for(var i=0; i<placaArray.length; i++) {
			if(placaArray[i][0]==id_product){
				placaObj=placaArray[i];
			}
		}
		
		if(document.getElementById("checkVideo").checked){
			document.getElementById("selectTV").disabled=false;
			populateVideo(placaObj[9]);
		}else{
			document.getElementById("selectTV").options[0] = new Option("Seleccionar","-1");
			document.getElementById("selectTV").disabled=true;
		}
		
	}
	calcularTotal();
}


function changeCheckboxGabinete(){
	var id_product = document.getElementById('selectTM').value;
	removeOptions(document.getElementById('selectGabinete'));
	removeOptions(document.getElementById('selectFuente'));
	
	if(id_product != -1){
		var idPlacaSeleccionada=0;
		var placaObj=null;
		for(var i=0; i<placaArray.length; i++) {
			if(placaArray[i][0]==id_product){
				placaObj=placaArray[i];
			}
		}
	
		populateGabinete(placaObj[6]);
		if(document.getElementById("checkGabinete").checked){
			document.getElementById("selectFuente").options[0] = new Option("Seleccionar","-1");
			document.getElementById("selectFuente").disabled=true;
		}else{
			document.getElementById("selectFuente").disabled=false;
			populateFuente(placaObj[6]);
		}
		
	}
	calcularTotal();
}

function formateoMiles(input){
	var num = (input+"").replace(/\./g,'');
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
	num = num.split('').reverse().join('').replace(/^[\.]/,'');
	return num;
}

function calcularTotal(){
	var totalTienda=0;
	var totalInternet=0
	
	var idProcesadorSeleccionado=document.getElementById('selectProcesador').value;
	for(var i=0; i<lineaArray.length; i++) {
		if(lineaArray[i][1]==idProcesadorSeleccionado){
			totalInternet+=(parseInt(lineaArray[i][5]));
			totalTienda+=(parseInt(lineaArray[i][6]));
		}
	}
	
	
	var idPlacaSeleccionada=document.getElementById('selectTM').value;
	for(var i=0; i<placaArray.length; i++) {
		if(placaArray[i][0]==idPlacaSeleccionada){
			totalInternet+=(parseInt(placaArray[i][7]));
			totalTienda+=(parseInt(placaArray[i][8]));
		}
	}
	
	document.getElementById("tablaMemoriasResumen").innerHTML="";
	for(var m = 0; m<=memoriaNumeros; m++){
		if(document.getElementById("tablaMemorias"+m+"Internet")!=null){
			totalInternet+=(parseInt(document.getElementById("tablaMemorias"+m+"Internet").value));
			totalTienda+=(parseInt(document.getElementById("tablaMemorias"+m+"Tienda").value));
			agregarElementoSeleccionadoResumen('tablaMemoriasResumen', document.getElementById("tablaMemorias"+m+"Nombre").value);
		}
	}
	
		
	var tsSeleccionada = document.getElementById("selectTS").value;
	document.getElementById('divTS').innerHTML="";
	for(var i=0; i<sonidoArray.length; i++) {
		if(sonidoArray[i][0]==tsSeleccionada){
			totalInternet+=(parseInt(sonidoArray[i][2]));
			totalTienda+=(parseInt(sonidoArray[i][3]));
			document.getElementById('divTS').innerHTML=sonidoArray[i][1];
		}
	}

	document.getElementById("tablaResumenDD2").innerHTML="";
	for(var m = 0; m<=ddNumeros ; m++){
		if(document.getElementById("tablaDD"+m+"Internet")!=null){
			totalInternet+=(parseInt(document.getElementById("tablaDD"+m+"Internet").value));
			totalTienda+=(parseInt(document.getElementById("tablaDD"+m+"Tienda").value));
			agregarElementoSeleccionadoResumen('tablaResumenDD2', document.getElementById("tablaDD"+m+"Nombre").value);
		}
	}
		
	
	var gabineteSeleccionada =document.getElementById('selectGabinete').value;
	document.getElementById('divGabinete').innerHTML="";
	for(var i=0; i<gabineteArray.length; i++) {
		if(gabineteArray[i][0]==gabineteSeleccionada ){
			totalInternet+=(parseInt(gabineteArray[i][3]));
			totalTienda+=(parseInt(gabineteArray[i][4]));
			document.getElementById('divGabinete').innerHTML=gabineteArray[i][1];
		}
	}
	
	var fuenteSeleccionada = document.getElementById('selectFuente').value;
	document.getElementById('divFP').innerHTML="";
	for(var i=0; i<fuenteArray.length; i++) {
		if(fuenteArray[i][0]==fuenteSeleccionada){
			totalInternet+=(parseInt(fuenteArray[i][2]));
			totalTienda+=(parseInt(fuenteArray[i][3]));
			document.getElementById('divFP').innerHTML=fuenteArray[i][1];
		}
	}
	
	var tvSeleccionada = document.getElementById("selectTV").value;
	document.getElementById('divTV').innerHTML="";
	for(var i=0; i<videoArray.length; i++) {
		if(videoArray[i][0]==tvSeleccionada){
			totalInternet+=(parseInt(videoArray[i][2]));
			totalTienda+=(parseInt(videoArray[i][3]));
			document.getElementById('divTV').innerHTML=videoArray[i][1];
		}
	}

	document.getElementById("tablaUOResumen").innerHTML="";
	for(var m = 0; m<=uoNumeros ; m++){
		if(document.getElementById("tablaUO"+m+"Internet")!=null){
			totalInternet+=(parseInt(document.getElementById("tablaUO"+m+"Internet").value));
			totalTienda+=(parseInt(document.getElementById("tablaUO"+m+"Tienda").value));
			agregarElementoSeleccionadoResumen('tablaUOResumen', document.getElementById("tablaUO"+m+"Nombre").value);
		}
	}
	
	var diskSeleccionado = document.getElementById("selectDisk").value;
	for(var i=0; i<diskArray.length; i++) {
		if(diskArray[i][0]==diskSeleccionado){
			totalInternet+=(parseInt(diskArray[i][2]));
			totalTienda+=(parseInt(diskArray[i][3]));
		}
	}
	
	totalInternet+=parseInt(document.getElementById("inputParlantesPrecio").value);
	totalInternet+=parseInt(document.getElementById("inputWebcamPrecio").value);
	totalInternet+=parseInt(document.getElementById("inputMonitorPrecio").value);
	totalInternet+=parseInt(document.getElementById("inputTecladoPrecio").value);
	totalInternet+=parseInt(document.getElementById("inputMousePrecio").value);

	totalTienda+=parseInt(document.getElementById("inputParlantesPrecioTienda").value);
	totalTienda+=parseInt(document.getElementById("inputWebcamPrecioTienda").value);
	totalTienda+=parseInt(document.getElementById("inputMonitorPrecioTienda").value);
	totalTienda+=parseInt(document.getElementById("inputTecladoPrecioTienda").value);
	totalTienda+=parseInt(document.getElementById("inputMousePrecioTienda").value);
	
	document.getElementById("divParlantes").innerHTML = document.getElementById("inputParlantes").value;
	document.getElementById("divWebcam").innerHTML = document.getElementById("inputWebcam").value;
	document.getElementById("divMonitor").innerHTML = document.getElementById("inputMonitor").value;
	document.getElementById("divTeclado").innerHTML = document.getElementById("inputTeclado").value;
	document.getElementById("divMouse").innerHTML = document.getElementById("inputMouse").value;
	
	document.getElementById("divTotalInternet").innerHTML = formateoMiles(totalInternet);
	document.getElementById("divTotalTienda").innerHTML = formateoMiles(totalTienda);
	document.getElementById("divTVSiNo").innerHTML = (document.getElementById("checkVideo").checked?'Si':'No');
	document.getElementById("divGabineteSiNo").innerHTML = (document.getElementById("checkGabinete").checked?'Si':'No');

}


var pkgAjaxObject=new Array();
function seConnect(objIndex){
    if(pkgAjaxObject[objIndex] == undefined){  
		if (window.XMLHttpRequest){
			pkgAjaxObject[objIndex] = new XMLHttpRequest();	
		}else{     
		  if (window.ActiveXObject){         
			try{
				pkgAjaxObject[objIndex] = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				pkgAjaxObject[objIndex]=null;
				alert("Could not create wa.XMLHTTP Object");
			}
		  }
		}
    }   
    return pkgAjaxObject[objIndex];    
}

function removeOptions(combo){
  for (var i = combo.length - 1; i>=0; i--) {
      combo.remove(i);
    }
}

function changeLinea(radio){
	var linea = radio.value;
	document.getElementById('lineaPCSeleccionada').innerHTML=linea;
	removeOptions(document.getElementById('selectProcesador'));
	removeOptions(document.getElementById('selectTM'));
	removeOptions(document.getElementById('selectMemoria'));
	removeOptions(document.getElementById('selectHD'));
	removeOptions(document.getElementById('selectGabinete'));
	removeOptions(document.getElementById('selectFuente'));
	var ajaxObject = seConnect(0);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=1";
		   params+="&linea="+linea;
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaChangeLinea;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo los procesadores");
		}
	}
	calcularTotal();
}


function respuestaChangeLinea(){

	var ajaxObject = seConnect(0);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					
					
					lineaArray = new Array();
					var lineaObj = new Array(5);
					document.getElementById("selectProcesador").options[0] = new Option("Seleccionar","-1"); 
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var marca = producto.getElementsByTagName("marca")[0].firstChild.nodeValue;
						var socket = producto.getElementsByTagName("socket")[0].firstChild.nodeValue
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue
						document.getElementById("selectProcesador").options[i+1] = new Option(name,id_product); 
						
						lineaObj = new Array();
						lineaObj[0] = producto;
						lineaObj[1] = id_product;
						lineaObj[2] = name;
						lineaObj[3] = marca;
						lineaObj[4] = socket;
						lineaObj[5] = precio;
						lineaObj[6] = ptienda;
						lineaArray.push(lineaObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo el artículo");
	}
}


function changeProcesador(combo){
	var id_producto = combo.value;

	removeOptions(document.getElementById('selectTM'));	
	removeOptions(document.getElementById('selectMemoria'));
	removeOptions(document.getElementById('selectHD'));
	removeOptions(document.getElementById('selectGabinete'));
	removeOptions(document.getElementById('selectFuente'));
		
	if(id_producto != -1){
		var socket = "";
		for(var i=0; i<lineaArray.length; i++) {
			if(lineaArray[i][1]==id_producto){
				socket=(lineaArray[i][4]);
				document.getElementById('divProcesadorSeleccionado').innerHTML=(lineaArray[i][2]);
			}
		}
		var ajaxObject = seConnect(1);
		var url="ajaxResponse.php";
		var params = "";
		if (ajaxObject){	
			try{
			   params+="?idConsulta=2";
			   params+="&socket="+socket;
			   //params+="&videoint="+(document.getElementById("checkVideo").checked?'Si':'No');
			   ajaxObject.open("GET", url+params, true);
			   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			   ajaxObject.setRequestHeader("Content-length", params.length);
			   ajaxObject.setRequestHeader("Connection", "close");            
			   ajaxObject.onreadystatechange = respuestaChangeProcesador;
			   ajaxObject.send(null);                 
			}catch(err){        
				alert("Problema obteniendo los procesadores");
			}
		}
	}
	calcularTotal();
}


function respuestaChangeProcesador(){
	var ajaxObject = seConnect(1);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectTM").options[0] = new Option("Seleccionar","-1"); 
					placaArray = new Array();
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var socket = producto.getElementsByTagName("socket")[0].firstChild.nodeValue
						var connector = producto.getElementsByTagName("connector")[0].firstChild.nodeValue;
						var videoint = producto.getElementsByTagName("videoint")[0].firstChild.nodeValue;
						var tiporam = producto.getElementsByTagName("tiporam")[0].firstChild.nodeValue;
						var tamano = producto.getElementsByTagName("tamano")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						var puertovideo = producto.getElementsByTagName("puertovideo")[0].firstChild.nodeValue;
	
						var placaObj = new Array();
						placaObj[0]=id_product;
						placaObj[1]=name;
						placaObj[2]=socket;
						placaObj[3]=connector;
						placaObj[4]=videoint;
						placaObj[5]=tiporam;
						placaObj[6]=tamano;
						placaObj[7]=precio;
						placaObj[8]=ptienda;
						placaObj[9]=puertovideo;
						
						document.getElementById("selectTM").options[i+1] = new Option(name,id_product);

						placaArray.push(placaObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo el artículo");
	}
}



function changePM(combo){
	var id_product = combo.value;
	removeOptions(document.getElementById('selectMemoria'));
	removeOptions(document.getElementById('selectHD'));
	removeOptions(document.getElementById('selectGabinete'));
	removeOptions(document.getElementById('selectFuente'));
	removeOptions(document.getElementById('selectTV'));
	
	if(id_product != -1){
		var idPlacaSeleccionada=0;
		var placaObj=null;
		for(var i=0; i<placaArray.length; i++) {
			if(placaArray[i][0]==id_product){
				placaObj=placaArray[i];
			}
		}
	
		populateMemoria(placaObj[5]);
		populateHD(placaObj[3]);
		populateGabinete(placaObj[6]);
		populateFuente(placaObj[6]);
		populateVideo(placaObj[9]);
		changeCheckboxGabinete();
		document.getElementById('divTMSeleccionada').innerHTML = placaObj[1];
	}
	calcularTotal();
}

function populateMemoria(tipoRam){
	var ajaxObject = seConnect(4);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=4";
		   params+="&tipoRam="+tipoRam;
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateMemoria;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Memorias");
		}
	}
}


function respuestaPopulateMemoria(){
	var ajaxObject = seConnect(4);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectMemoria").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var tiporam = producto.getElementsByTagName("tiporam")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectMemoria").options[i+1] = new Option(name,id_product);
						
						var memoriaObj = new Array();
						memoriaObj[0]=id_product;
						memoriaObj[1]=name;
						memoriaObj[2]=tiporam;
						memoriaObj[3]=precio;
						memoriaObj[4]=ptienda;
						memoriaArray.push(memoriaObj);

					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo la Memoria");
	}
}


function populateHD(connector){
	var ajaxObject = seConnect(5);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=3";
		   params+="&conector="+connector;
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateHD;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo los Discos Duros");
		}
	}
}


function respuestaPopulateHD(){
	var ajaxObject = seConnect(5);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectHD").options[0] = new Option("Seleccionar","-1");
										
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var connector = producto.getElementsByTagName("connector")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectHD").options[i+1] = new Option(name,id_product);
							
						var discoObj = new Array();
						discoObj[0]=id_product;
						discoObj[1]=name;
						discoObj[2]=connector;
						discoObj[3]=precio;
						discoObj[4]=ptienda;
						discoArray.push(discoObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo los Discos Duros");
	}
}




function populateGabinete(tamano){
	var ajaxObject = seConnect(6);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=5";
		   params+="&tamano="+tamano;
		   params+="&incluyeFP="+(document.getElementById("checkGabinete").checked?'Si':'No');
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateGabinete;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo los Gabinetes");
		}
	}
}


function respuestaPopulateGabinete(){
	var ajaxObject = seConnect(6);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectGabinete").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var tamano = producto.getElementsByTagName("tamano")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectGabinete").options[i+1] = new Option(name,id_product);
						
						var gabineteObj = new Array();
						gabineteObj[0]=id_product;
						gabineteObj[1]=name;
						gabineteObj[2]=tamano;
						gabineteObj[3]=precio;
						gabineteObj[4]=ptienda;
						gabineteArray.push(gabineteObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo los Gabinetes");
	}
}




function populateFuente(tamano){
	var ajaxObject = seConnect(3);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=6";
		   params+="&tamano="+tamano;
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateFuente;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Fuentes de poder");
		}
	}
}


function respuestaPopulateFuente(){
	var ajaxObject = seConnect(3);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectFuente").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectFuente").options[i+1] = new Option(name,id_product);
						
						var fuenteObj = new Array();
						fuenteObj[0]=id_product;
						fuenteObj[1]=name;
						fuenteObj[2]=precio;
						fuenteObj[3]=ptienda;
						fuenteArray.push(fuenteObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo las Fuentes");
	}
}




function populateSonido(){
	var ajaxObject = seConnect(7);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=7";
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateSonido;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Tarjetas de Sonido");
		}
	}
}


function respuestaPopulateSonido(){
	var ajaxObject = seConnect(7);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectTS").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectTS").options[i+1] = new Option(name,id_product);
						
						var sonidoObj = new Array();
						sonidoObj[0]=id_product;
						sonidoObj[1]=name;
						sonidoObj[2]=precio;
						sonidoObj[3]=ptienda;
						sonidoArray.push(sonidoObj);
					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo las Tarjetas de Sonido");
	}
}



function populateVideo(puertovideo){
	var ajaxObject = seConnect(8);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=8";
		   params+="&puertovideo="+puertovideo;
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");
		   ajaxObject.onreadystatechange = respuestaPopulateVideo;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Tarjetas de Sonido");
		}
	}
}


function respuestaPopulateVideo(){
	var ajaxObject = seConnect(8);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectTV").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectTV").options[i+1] = new Option(name,id_product);
						
						var videoObj = new Array();
						videoObj[0]=id_product;
						videoObj[1]=name;
						videoObj[2]=precio;
						videoObj[3]=ptienda;
						videoArray.push(videoObj);

					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo las Tarjetas de Sonido");
	}
}


function populateUO(){ 
	var ajaxObject = seConnect(9);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=9";
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateUO;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Unidades Opticas");
		}
	}
}


function respuestaPopulateUO(){
	var ajaxObject = seConnect(9);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectUO").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectUO").options[i+1] = new Option(name,id_product);
						
						var uoObj = new Array();
						uoObj[0]=id_product;
						uoObj[1]=name;
						uoObj[2]=precio;
						uoObj[3]=ptienda;
						uoArray.push(uoObj);

					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo las Unidades Opticas");
	}
}


function populateDisk(){ 
	var ajaxObject = seConnect(10);
	var url="ajaxResponse.php";
	var params = "";
	if (ajaxObject){	
		try{
		   params+="?idConsulta=10";
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.onreadystatechange = respuestaPopulateDisk;
		   ajaxObject.send(null);                 
		}catch(err){        
			alert("Problema obteniendo las Unidades Opticas");
		}
	}
}


function respuestaPopulateDisk(){
	var ajaxObject = seConnect(10);
	try{
		if (ajaxObject.readyState==4){
		    if (ajaxObject.status == 200){
			  if (ajaxObject.responseText){
				var resXml = ajaxObject.responseXML.documentElement;
				if(resXml.getElementsByTagName("mensaje").length == 0){
					document.getElementById("selectDisk").options[0] = new Option("Seleccionar","-1"); 
					
					for(var i = 0; i< resXml.getElementsByTagName("producto").length; i++){
						var producto = resXml.getElementsByTagName("producto")[i];
						var id_product =producto.getElementsByTagName("id_product")[0].firstChild.nodeValue;
						var name = producto.getElementsByTagName("name")[0].firstChild.nodeValue;
						var precio = producto.getElementsByTagName("precio")[0].firstChild.nodeValue;
						var ptienda = producto.getElementsByTagName("ptienda")[0].firstChild.nodeValue;
						document.getElementById("selectDisk").options[i+1] = new Option(name,id_product);
						
						var diskObj = new Array();
						diskObj[0]=id_product;
						diskObj[1]=name;
						diskObj[2]=precio;
						diskObj[3]=ptienda;
						diskArray.push(diskObj);

					}
				}else{
					alert(resXml.getElementsByTagName("mensaje")[0].firstChild.nodeValue);
				}
			  }
			}
		 }
	}catch(err){
		alert("Problema leyendo las Unidades Opticas");
	}
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function validarPaso(numeroPaso){
	
	retorno = true;
	if(numeroPaso==1){
		TabbedPanels1.showPanel(0);
		if(getCheckedValue(document.getElementsByName('tipo'))==""){
			alert('Debe seleccionar el tipo de PC');
		}else if(getCheckedValue(document.getElementsByName('radio1'))==""){
			alert('Debe seleccionar la linea del PC');
		}else{
			TabbedPanels1.showPanel(1);
			retorno = false;
		}
		
	}else if (numeroPaso==2){
		if(document.getElementById('selectProcesador').value == -1){
			alert('Debe seleccionar el procesador');
		}else if(document.getElementById('selectTM').value == -1){
			alert('Debe seleccionar la tarjeta madre');
		}else if(document.getElementById('selectMemoria').value == -1){
			alert('Debe seleccionar la memoria');
		}else if(document.getElementById('selectHD').value == -1){
			alert('Debe seleccionar el disco duro');
		}else if(document.getElementById('selectGabinete').value == -1){
			alert('Debe seleccionar el gabinete');
		}else if(!document.getElementById('checkGabinete').checked && document.getElementById('selectFuente').value==-1){
			alert('Debe seleccionar la fuente de poder');
		}else{
			TabbedPanels1.showPanel(2);
			retorno = false;
		}
	}else if (numeroPaso==3){
			TabbedPanels1.showPanel(3);
			retorno = false;
	}else if (numeroPaso==4){
			TabbedPanels1.showPanel(4);
			retorno = false;
	}else if (numeroPaso==5){
			TabbedPanels1.showPanel(5);
			retorno = false;
	}

	return retorno;
}
</script>
<link href="<?php echo __PS_BASE_URI__; ?>themes/ps_bip/css/global.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo __PS_BASE_URI__; ?>css/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo __PS_BASE_URI__; ?>js/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__; ?>js/jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__; ?>js/jquery/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__; ?>js/jquery/jquery.serialScroll-1.2.2-min.js"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__; ?>themes/ps_bip/js/product.js"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body id="bodyConfigPc">
<div id="contentConfPc">
  <h2 align="left">Configurador de PC</h2>
  <p align="left" style="padding-left:10px;">Aquí puede armar su computador, con los costos asociados y comprar inmediatamante.</p>
  <br />
  <br />
  <form id="form1" name="form1" method="post" action="configurador_pc.php">
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0" id="tab1">Tipo de Computador</li>
        <li class="TabbedPanelsTab" tabindex="0" id="tab2">Componentes Primarios</li>
        <li class="TabbedPanelsTab" tabindex="0" id="tab3">Componentes Secundarios</li>
        <li class="TabbedPanelsTab" tabindex="0" id="tab4">Componentes Perifericos</li>
        <li class="TabbedPanelsTab" tabindex="0" id="tab5">Resumen de Componentes</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Seleccione el tipo de Computador</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="33%"><input type="radio" name="tipo" id="radio" value="1" onclick="document.form1.submit();" <?php echo ($tipoSeleccionado==1)?'checked="checked"':''; ?> />
                  <br />
                  Computador Básico </td>
                <td width="34%"><input type="radio" name="tipo" id="radio" value="2" onclick="document.form1.submit();" <?php echo ($tipoSeleccionado==2)?'checked="checked"':''; ?>/>
                  <br />
                  Computador Medio</td>
                <td width="33%"><input type="radio" name="tipo" id="radio" value="3" onclick="document.form1.submit();" <?php echo ($tipoSeleccionado==3)?'checked="checked"':''; ?>/>
                  <br />
                  Computador Avanzado</td>
              </tr>
            </table>
          </fieldset>
          <br />
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Seleccione la línea de Computador</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <?php
				$contador = 1;
				foreach($resultLineas as $linea){
					echo '<td width="33%" height="45px"><input type="radio" name="radio1" id="radio1" value="'.$linea['nombreLinea'].'" onChange="changeLinea(this);"/>'.'<br />'.$linea["nombreLinea"].'</td>';
					if($contador!=0 && $contador%3==0){
						echo "</tr><tr>";
						$contador = 0;
					}
					$contador++;
				}
				for($x = $contador; $x<=3;$x++){
					echo "<td></td>";
				}
			?>
              </tr>
            </table>
          </fieldset>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" align="left"><input type="reset" name="button" id="button" value="Anterior" class="button" style="margin-left:0;" /></td>
              <td width="50%" align="right"><input type="button" name="button" id="button" value="Siguiente" onclick=" return validarPaso(1);" class="exclusive"/></td>
            </tr>
          </table>
        </div>
        <div class="TabbedPanelsContent">
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Seleccione las características principales</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Procesador</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectProcesador" id="selectProcesador" onchange="changeProcesador(this);">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Tarjeta Madre</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectTM" id="selectTM" onchange="changePM(this);">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td align="left" height="15px"><input type="checkbox" name="checkVideo" id="checkVideo" onclick="changeCheckboxVideo();"/>
                  Desea VGA separada</td>
              </tr>
              <tr>
                <td width="150" align="left" valign="middle" style="font-weight:bold;">Memoria</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectMemoria" id="selectMemoria" >
                    <option value="-1">Seleccionar</option>
                  </select>
                  <a href="#" onclick="agregarMemoria();"> <img height="16" width="16" title="Agregar Memoria" alt="Agregar Memoria" src="SpryAssets/add.gif" align="top"></a>
                  <table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaMemorias">
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td width="150" align="left" valign="middle" style="font-weight:bold;">Disco Duro</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectHD" id="selectHD">
                    <option value="-1">Seleccionar</option>
                  </select>
                  <a href="#" onclick="agregarDD();"> <img height="16" width="16" title="Agregar Disco Duro" alt="Agregar Disco Duro" src="SpryAssets/add.gif" align="top"></a>
                  <table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaDD">
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Gabinete</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectGabinete" id="selectGabinete" onchange="calcularTotal();">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td align="left" height="15px"><input type="checkbox" name="checkGabinete" id="checkGabinete" onchange="changeCheckboxGabinete();"/>
                  Gabinete con fuente de poder</td>
              </tr>
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Fuente de Poder</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectFuente" id="selectFuente" onchange="calcularTotal();">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
            </table>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="left"><input type="reset" name="button" id="button" value="Anterior" onclick="TabbedPanels1.showPanel(0); return false;" class="button" style="margin-left:0;"  /></td>
                <td width="50%" align="right"><input type="submit" name="button" id="button" value="Siguiente" onclick="return validarPaso(2)" class="exclusive"/></td>
              </tr>
            </table>
          </fieldset>
        </div>
        <div class="TabbedPanelsContent">
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Seleccione las características secundarias</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Tarjeta de Video</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectTV" id="selectTV" onchange="calcularTotal();">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Tarjeta de Sonido</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectTS" id="selectTS" onchange="calcularTotal();">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Disketera</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><select name="selectDisk" id="selectDisk" onchange="calcularTotal();">
                    <option value="-1">Seleccionar</option>
                  </select></td>
              </tr>
              <tr>
                <td width="150" align="left" valign="middle" style="font-weight:bold;">Unidad Óptica</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px">
                  <select name="selectUO" id="selectUO">
                    <option value="-1">Seleccionar</option>
                  </select>
                  <a href="#" onclick="agregarUO();"> <img height="16" width="16" title="Agregar una Unidad Optica" alt="Agregar una Unidad Optica" src="SpryAssets/add.gif" align="top"></a><table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaUO">
                    </tbody>
                  </table></td>
              </tr>
            </table>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="left"><input type="reset" name="button" id="button" value="Anterior" onclick="TabbedPanels1.showPanel(1); return false;" class="button" style="margin-left:0;" /></td>
                <td width="50%" align="right"><input type="submit" name="button" id="button" value="Siguiente" onclick="return validarPaso(3);" class="exclusive"/></td>
              </tr>
            </table>
          </fieldset>
        </div>
        <div class="TabbedPanelsContent">
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Seleccione los componentes perifericos</legend>
            <table border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Parlantes</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><input type="text" id="inputParlantes" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:350px;" /></td>
                <td></td>
                <td align="left" height="35px"><input type="text" id="inputParlantesCode" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:80px;" />
                  <!--<input type="button" value="Limpiar" onclick="limpiar('Parlantes')"/>-->
                  <input type="hidden" id="inputParlantesPrecio" value="0"/>
                  <input type="hidden" id="inputParlantesPrecioTienda" value="0"/>
                  <a id="linkParlanteExterno" href="#" onclick="setIds('inputParlantes');"> <img height="15" width="17" title="Buscar productos" alt="Buscar productos" src="SpryAssets/magnify.gif" align="top"></a> 
                  <a id="Limpiar1" href="#" onclick="limpiar('Parlantes')" title="Limpiar"> <img height="13" width="11" title="Limpiar" alt="Limpiar" src="SpryAssets/delete.gif" align="top"></a>
                  </td>
              </tr>
<!--              <tr>
                <td width="150" align="left"></td>
                <td></td>
                <td width="10"></td>
                <td></td>
                <td>C&oacute;digo Producto</td>
              </tr>-->
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Webcam</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><input type="text" id="inputWebcam" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:350px;" /></td>
                <td></td>
                <td align="left" height="35px"><input type="text" id="inputWebcamCode" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:80px;" />
<!--                  <input type="button" value="Limpiar" onclick="limpiar('Webcam')"/>-->
                  <input type="hidden" id="inputWebcamPrecio"  value="0"/>
                  <input type="hidden" id="inputWebcamPrecioTienda"  value="0"/>
                  <a id="linkWebcamExterno" href="#" onclick="setIds('inputWebcam');"> <img height="15" width="17" title="Buscar productos" alt="Buscar productos" src="SpryAssets/magnify.gif" align="top"></a> 
                  <a id="Limpiar1" href="#" onclick="limpiar('Webcam')" title="Limpiar"> <img height="13" width="11" title="Limpiar" alt="Limpiar" src="SpryAssets/delete.gif" align="top"></a>
                  </td>
              </tr>
<!--              <tr>
                <td width="150" align="left"></td>
                <td></td>
                <td width="10"><a id="linkWebcamExterno" href="#"  onclick="setIds('inputWebcam');"> Buscar productos </a></td>
                <td></td>
                <td>C&oacute;digo Producto</td>
              </tr>-->
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Monitor</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><input type="text" id="inputMonitor" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:350px;" /></td>
                <td></td>
                <td align="left" height="35px"><input type="text" id="inputMonitorCode" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:80px;" />
<!--                  <input type="button" value="Limpiar" onclick="limpiar('Monitor')"/>-->
                  <input type="hidden" id="inputMonitorPrecio" value="0" />
                  <input type="hidden" id="inputMonitorPrecioTienda" value="0" />
                  <a id="linkMonitorExterno" href="#" onclick="setIds('inputMonitor');"> <img height="15" width="17" title="Buscar productos" alt="Buscar productos" src="SpryAssets/magnify.gif" align="top"></a> 
                  <a id="Limpiar1" href="#" onclick="limpiar('Monitor')" title="Limpiar"> <img height="13" width="11" title="Limpiar" alt="Limpiar" src="SpryAssets/delete.gif" align="top"></a>
                  </td>
              </tr>
<!--              <tr>
                <td width="150" align="left"></td>
                <td></td>
                <td width="10"><a id="linkMonitorExterno" href="#" onclick="setIds('inputMonitor');"> Buscar productos </a></td>
                <td></td>
                <td>C&oacute;digo Producto</td>
              </tr>-->
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Teclado</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><input type="text" id="inputTeclado" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:350px;" /></td>
                <td></td>
                <td align="left" height="35px"><input type="text" id="inputTecladoCode" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:80px;" />
                  <!--<input type="button" value="Limpiar" onclick="limpiar('Teclado')"/>-->
                  <input type="hidden" id="inputTecladoPrecio"  value="0"/>
                  <input type="hidden" id="inputTecladoPrecioTienda"  value="0"/>
                  <a id="linkTecladoExterno" href="#" onclick="setIds('inputTeclado');"> <img height="15" width="17" title="Buscar productos" alt="Buscar productos" src="SpryAssets/magnify.gif" align="top"></a> 
                  <a id="Limpiar1" href="#" onclick="limpiar('Teclado')" title="Limpiar"> <img height="13" width="11" title="Limpiar" alt="Limpiar" src="SpryAssets/delete.gif" align="top"></a>
                  </td>
              </tr>
<!--              <tr>
                <td width="150" align="left"></td>
                <td></td>
                <td width="10"><a id="linkTecladoExterno" href="#" onclick="setIds('inputTeclado');"> Buscar productos </a></td>
                <td></td>
                <td>C&oacute;digo Producto</td>
              </tr>-->
              <tr>
                <td width="150" align="left" style="font-weight:bold;">Mouse</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left" height="35px"><input  type="text" id="inputMouse" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:350px;" /></td>
                <td></td>
                <td align="left"><input type="text" id="inputMouseCode" value="" disabled="disabled" style="background-color:#EEEEEE; border:1px solid #999999; width:80px;" />
                  <!--<input type="button" value="Limpiar" onclick="limpiar('Mouse')"/>-->
                  <input type="hidden" id="inputMousePrecio" value="0"/>
                  <input type="hidden" id="inputMousePrecioTienda" value="0"/>
                  <a id="linkMouseExterno" href="#" onclick="setIds('inputMouse');"> <img height="15" width="17" title="Buscar productos" alt="Buscar productos" src="SpryAssets/magnify.gif" align="top"></a> 
                  <a id="Limpiar1" href="#" onclick="limpiar('Mouse')" title="Limpiar"> <img height="13" width="11" title="Limpiar" alt="Limpiar" src="SpryAssets/delete.gif" align="top"></a>
                  </td>
              </tr>
<!--              <tr>
                <td width="150" align="left"></td>
                <td></td>
                <td width="10"><a id="linkMouseExterno" href="#" onclick="setIds('inputMouse');"> Buscar productos </a></td>
                <td></td>
                <td>C&oacute;digo Producto</td>
              </tr>-->
            </table>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="left"><input type="reset" name="button" id="button" value="Anterior" onclick="TabbedPanels1.showPanel(2); return false;" class="button" style="margin-left:0;" /></td>
                <td width="50%" align="right"><input type="submit" name="button" id="button" value="Siguiente" onclick="return validarPaso(4);" class="exclusive"/></td>
              </tr>
            </table>
          </fieldset>
        </div>
        <div class="TabbedPanelsContent">
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Tipo de Computador</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><div id="tipoPcSeleccionado"></div></td>
              </tr>
            </table>
          </fieldset>
          <br />
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Línea de Computador</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><div id="lineaPCSeleccionada"></div></td>
              </tr>
            </table>
          </fieldset>
          <br />
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Características Principales</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Procesador</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divProcesadorSeleccionado"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Tarjeta Madre</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divTMSeleccionada"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Desea VGA separada</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divTVSiNo"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Memoria</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaMemoriasResumen">
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Disco Duro</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaResumenDD2">
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Gabinete</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divGabinete"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Gabinete con fuente de poder</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divGabineteSiNo"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Fuente de Poder</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divFP"></div></td>
              </tr>
            </table>
          </fieldset>
          <br />
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Características Secundarias</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Tarjeta de Video</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divTV"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Tarjeta de Sonido</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divTS"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Disketera</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divDisk"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Unidad Óptica</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><table>
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablaUOResumen">
                    </tbody>
                  </table></td>
              </tr>
            </table>
          </fieldset>
          <br />
          <fieldset style="border:1px solid #FCC; padding:10px;">
            <legend style="font-weight:bold; padding:5px; color:#EF4F57;">Componentes Periféricos</legend>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Parlantes</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divParlantes"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Webcam</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divWebcam"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Monitor</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divMonitor"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Teclado</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divTeclado"></div></td>
              </tr>
              <tr>
                <td width="200" align="left" style="font-weight:bold;">Mouse</td>
                <td width="10" style="font-weight:bold;">:</td>
                <td align="left"><div id="divMouse"></div></td>
              </tr>
            </table>
          </fieldset>
          <br/>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" align="left"><input type="reset" name="button" id="button" value="Cancelar" onclick="TabbedPanels1.showPanel(3); return false;" class="button" style="margin-left:0;" /></td>
              <td width="50%" align="right"><input type="button" name="button" id="button" value="Comprar" onclick="enviarTodoACarro()" class="exclusive"/></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <br />
    <table width="350" border="0" align="right" cellpadding="0" cellspacing="0" style="border:1px solid #999; margin:10px; margin-right:0px; padding:1px;">
      <tr>
        <td width="230" bgcolor="#EFEFEF" height="35px" style="padding-left:10px; color:#333;">TOTAL PRECIO LISTA</td>
        <td width="120" align="right" bgcolor="#EFEFEF" style="padding-right:10px; color:#333;"><div id="divTotalTienda">0 $</div></td>
      </tr>
      <tr>
        <td width="230" bgcolor="#CCFFCC" height="35px" style="padding-left:10px; color:#333; border-top:1px solid #FFF;">TOTAL PRECIO MÍNIMO INTERNET</td>
        <td width="120" align="right" bgcolor="#CCFFCC" style="padding-right:10px; color:#333; border-top:1px solid #FFF;"><div id="divTotalInternet">0 $</div></td>
      </tr>
    </table>
  </form>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

$('#linkParlanteExterno').click(function() {
parent.$('#linkExternoParlantes').trigger('click');
});

$('#linkWebcamExterno').click(function() {
parent.$('#linkExternoWebcam').trigger('click');
});

$('#linkMonitorExterno').click(function() {
parent.$('#linkExternoMonitor').trigger('click');
});

$('#linkTecladoExterno').click(function() {
parent.$('#linkExternoTeclado').trigger('click');
});

$('#linkMouseExterno').click(function() {
parent.$('#linkExternoMouse').trigger('click');
});

populateSonido();
populateUO();
//populateDisk();
</script>
</body>
</html>
