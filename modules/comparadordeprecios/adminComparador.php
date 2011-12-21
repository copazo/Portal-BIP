<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$query = "	SELECT cp.*, pl.name name, vpp.internet  
			FROM comparadorprecios cp, ps_product_lang pl, view_prod_price vpp
			WHERE pl.id_product = dacoBip
			AND id_lang =3
			AND pl.id_product = vpp.id_product ";
			if($_POST["tienda"]){
				$query.=" AND dacoURL like '%".$_POST["tienda"]."%'";	
			}
			if($_POST["relacion"]){
				$query.=" AND dacoRelacion like '%".$_POST["relacion"]."%'";	
			}
$resultLineas = Db::getInstance()->ExecuteS($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Configurador de PC - BIP COMPUTERS</title>
<script language="javascript" type="text/javascript">
function calculaLargo() { 
	var elLargo=document.body.scrollHeight;
	window.parent.document.getElementById('ZONE1').height=elLargo+50; 
} 

function seguroEliminar(producto, dacoId) { 
	if(confirm('¿Seguro desea eliminar la comparación del artículo '+producto+' ?')){
		location.href = 'ajaxResponse.php?idConsulta=3&dacoId='+dacoId;
	}
} 

function botonOk(dacoId){
	location.href = "ajaxResponse.php?idConsulta=2&dacoId="+dacoId;
}


function actionCheck(dacoId){
	var ajaxObject = seConnect(dacoId);
	var url="<?php echo __PS_BASE_URI__; ?>modules/comparadordeprecios/ajaxResponse.php";
	var params = "?idConsulta=1";
	if (ajaxObject){	
		try{
		   var status = (document.getElementById("checkValido"+dacoId).checked?"1":"0");
		   
		   var selectRelacion = document.getElementById("relacion"+dacoId);
			var selectedIndex = selectRelacion.selectedIndex;
			var valorRelacion = selectRelacion.options[selectedIndex].value;
			
		   params+="&dacoId="+dacoId;
		   params+="&newStatus="+status;
		   params+="&dacoRelacion="+valorRelacion;
		   	
		   
		   ajaxObject.open("GET", url+params, true);
		   ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   ajaxObject.setRequestHeader("Content-length", params.length);
		   ajaxObject.setRequestHeader("Connection", "close");            
		   ajaxObject.send(null);
		   if(status==1){
		   		document.getElementById("boton"+dacoId).disabled=false;
				
		   }else{
		   		document.getElementById("boton"+dacoId).disabled=true;
		   }
		   
		   selectRelacion.style.display='none';
		   document.getElementById("relacionTexto"+dacoId).style.display='block';
		   document.getElementById("relacionTexto"+dacoId).innerHTML= valorRelacion;
		   
		}catch(err){        
			alert("Problema al cambiar el estado");
		}
	}
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

function cambioRelacion(numeroId){
	var selectRelacion = document.getElementById("relacion"+numeroId);
	var selectedIndex = selectRelacion.selectedIndex;
	var valorRelacion = selectRelacion.options[selectedIndex].value;
	
	if(valorRelacion==''){
		document.getElementById("checkValido"+numeroId).disabled = true;
		document.getElementById("checkValido"+numeroId).checked = false;
		document.getElementById("boton"+numeroId).disabled = true;
	}else{
		document.getElementById("checkValido"+numeroId).disabled = false;
	}
}
</script>
</head>

<body>
	<input type="button" value="Volver" onclick="location.href = 'comparacionPreciosIndex.php';" 
    style="background-color: #FFF6D3;
    border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
    border-right: 1px solid #DFD5AF;
    border-style: solid;
    border-width: 1px;
    color: #268CCD;
    padding: 3px;">
    <form action="adminComparador.php" enctype="multipart/form-data" autocomplete="off" id="buscarForm" name="buscarForm" method="post">
    <table style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#060; background-color:#FFFFFF;">
<tr>
        	<td width="200">Se han encontrado <?php echo sizeof($resultLineas); ?> registros.</td>
      <td width="10"></td>
      <td width="30">Tienda</td>
<td width="100"> <select name="tienda" id="tienda">
            	<option value="" <?php echo (!isset($_POST["tienda"]))?'selected':''; ?>> Todas </option>
                <option value=".corona" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.corona')?'selected':''; ?>> Corona </option>
                <option value=".falabella" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.falabella')?'selected':''; ?>> Falabella </option>
            	<option value=".paris" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.paris')?'selected':''; ?>> Paris </option>
                <option value=".pcfactory" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.pcfactory')?'selected':''; ?>> PC Factory </option>
                <option value=".ripley" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.ripley')?'selected':''; ?>> Ripley </option>
            </select>
			</td>
      <td width="10"></td>
      <td width="35">Relaci&oacute;n</td>
<td width="100"><select name="relacion" id="relacion">
            	<option value="" <?php echo (!isset($_POST["relacion"]))?'selected':''; ?>> Todos </option>
                <option value="Idéntico" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Idéntico')?'selected':''; ?>> Similar </option>
                <option value="Similar" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Similar')?'selected':''; ?>> Id&eacute;ntico </option>
            </select></td>
      <td width="63"><input type="submit" value="Buscar" name="Buscar" id="Buscar"    style="background-color: #FFF6D3;
    border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
    border-right: 1px solid #DFD5AF;
    border-style: solid;
    border-width: 1px;
    color: #268CCD;
    padding: 3px;"></td>
      </tr>
    </table>
    </form>
  <table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; width:100%;">
    <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
      <td>C&oacute;digo</td>
      <td>Tienda</td>
      <td>Nombre</td>
      <td>Precio BIP</td>
      <td>E mail</td>
      <td>Usuario</td>
      <td>Fecha</td>
      <td>URL</td>
      <td>¿V&aacute;lida?</td>
      <td>Relaci&oacute;n</td>
      <td>Precio Comparaci&oacute;n</td>
      <td>Comparar</td>
      <td>Situacion Busqueda</td>
    </tr>
    <?php foreach($resultLineas as $linea){ ?>
    <tr style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000; background-color:#FFFFFF;">
      <td class="txtcampos"><?php echo $linea['dacoBip']; ?></td>
      <td ><?php echo (($linea['dacoTienda']==null || $linea['dacoTienda']=="")?'No Comprobado':$linea['dacoTienda']); ?></td>
      <td class="txtcampos"><?php echo $linea['name']; ?></td>
      <td class="txtcampos"><?php echo number_format($linea['internet'],0,',','.'); ?></td>
      <td class="txtcampos"><?php echo $linea['dacoEmail']; ?></td>
      <td class="txtcampos"><?php echo $linea['dacoUsuario']; ?></td>
      <td class="txtcampos"><?php echo $linea['dacoFecha']; ?></td>
      <td class="txtcampos"><a href="<?php echo $linea['dacoURL']; ?>" target="_blank"><?php echo $linea['dacoURL']; ?></a></td>
      <td class="txtcampos">
      	<input type="checkbox" onclick="actionCheck('<?php echo $linea['dacoId']; ?>')" name="checkValido<?php echo $linea['dacoId']; ?>" id="checkValido<?php echo $linea['dacoId']; ?>" <?php echo ($linea['dacoComparacionActiva']==0?'':'checked="checked"'); ?> <?php echo $linea['dacoRelacion']==''?'disabled="disabled"':''; ?>/> 
      	<br>
		<a href="#" onclick="seguroEliminar('<?php echo $linea['name']; ?>',<?php echo $linea['dacoId']; ?>)" > Eliminar </a>
      </td>
      <td class="txtcampos">
      		<select style="display:<?php echo $linea['dacoRelacion']==''?'inline':'none'; ?>" name="relacion<?php echo $linea['dacoId']; ?>" id="relacion<?php echo $linea['dacoId']; ?>" onchange="cambioRelacion(<?php echo $linea['dacoId']; ?>);">
            	<option value="" <?php echo $linea['dacoRelacion']==''?'selected':''; ?>> No seleccionado </option>
                <option value="Idéntico" <?php echo $linea['dacoRelacion']=='Idéntico'?'selected':''; ?>> Id&eacute;ntico </option>
                <option value="Similar" <?php  echo $linea['dacoRelacion']=='Similar'?'selected':''; ?>> Similar </option>
            </select>
            <div id="relacionTexto<?php echo $linea['dacoId']; ?>"><?php echo $linea['dacoRelacion'];?></div>
			</td>
      <td class="txtcampos"><?php echo number_format($linea['dacoPrecioComparacion'],0,',','.'); ?></td>
      <td class="txtcampos"><input id="boton<?php echo $linea['dacoId']; ?>" type="button" value="OK" onclick="botonOk('<?php echo $linea['dacoId']; ?>');" <?php echo ($linea['dacoComparacionActiva']!=0?'':'disabled="disabled"'); ?>      style="background-color: #FFF6D3;
    border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
    border-right: 1px solid #DFD5AF;
    border-style: solid;
    border-width: 1px;
    color: #268CCD;
    padding: 3px;"></td>
      <td class="txtcampos"><img src="<?php echo "".($linea['dacoFuncionando']==0?"alerta.png":"semaforo_verde.gif"); ?>"></td>
    </tr>
    <?php  } ?>
  </table>
</body>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</html>
