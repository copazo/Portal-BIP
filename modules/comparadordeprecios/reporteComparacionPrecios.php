<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$query = "	SELECT cph.*, dacoTienda
			FROM comparadorprecioshist cph, (SELECT max(cophId) cophId, dacoId FROM comparadorprecioshist group by dacoId) vcph,
				comparadorprecios cp
			WHERE vcph.cophId = cph.cophId
			AND vcph.dacoId = cph.dacoId
			AND cp.dacoId = cph.dacoId";
			if($_POST["tienda"]){
				$query.=" AND dacoURL like '%".$_POST["tienda"]."%'";	
			}
			if($_POST["relacion"]){
				$query.=" AND dacoRelacion like '%".$_POST["relacion"]."%'";	
			}
			if(isset($_POST["precio"]) && $_POST["precio"]!=""){
				if($_POST["precio"]=="Menor"){
					$query.=" AND cophPrecioBip < cophPrecioComparacion ";
				}else if($_POST["precio"]=="Igual"){
					$query.=" AND cophPrecioBip = cophPrecioComparacion ";
				}else if($_POST["precio"]=="Mayor"){
					$query.=" AND cophPrecioBip > cophPrecioComparacion ";
				}
			}
			
			
			$query.=" ORDER BY cophId DESC";
$resultLineas = Db::getInstance()->ExecuteS($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comparador</title>
<script language="javascript" type="text/javascript">
function calculaLargo() { 
	var elLargo=document.body.scrollHeight;
	window.parent.document.getElementById('ZONE1').height=elLargo+50; 
}
</script>
<style type="text/css">
<!--
.precioBipIgual {
	background-color: #FFC;
}
.precioBipMayor {
	background-color: #FCC;
}
.precioBipMenor {
	background-color: #9FC;
}
.btnVolver {
	background-color: #FFF6D3;
	border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
	border-right: 1px solid #DFD5AF;
	border-style: solid;
	border-width: 1px;
	color: #268CCD;
	padding: 3px;
}
a.lknombreColumna {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	color:green;
	background-color:#F4E6C9;
	text-decoration:none;
}
select.filtros {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#000;
	background-color:#FFFFFF;
	text-decoration:none;
	width:100px;
}
-->
</style>
</head>

<body>
<input type="button" value="Volver" onclick="location.href = 'comparacionPreciosIndex.php';" class="btnVolver"/>
<form action="reporteComparacionPrecios.php" enctype="multipart/form-data" autocomplete="off" id="buscarForm" name="buscarForm" method="post">
  <table cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#060; background-color:#FFFFFF; width:100%; height:35px;">
    <tr>
      <td width="200">Se han encontrado <?php echo sizeof($resultLineas); ?> registros.</td>
      <td ></td>
      <td width="30">Tienda: </td>
      <td width="100"><select name="tienda" id="tienda" class="filtros">
          <option value="" <?php echo (!isset($_POST["tienda"]))?'selected':''; ?>> Todas </option>
          <option value=".corona" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.corona')?'selected':''; ?>> Corona </option>
          <option value=".falabella" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.falabella')?'selected':''; ?>> Falabella </option>
          <option value=".paris" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.paris')?'selected':''; ?>> Paris </option>
          <option value=".pcfactory" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.pcfactory')?'selected':''; ?>> PC Factory </option>
          <option value=".ripley" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.ripley')?'selected':''; ?>> Ripley </option>
          <option value=".wei" <?php echo (isset($_POST["tienda"]) && $_POST["tienda"]=='.wei')?'selected':''; ?>> WEI</option>
        </select></td>
      <td width="10"></td>
      <td width="35">Relaci&oacute;n: </td>
      <td width="100"><select name="relacion" id="relacion" class="filtros">
          <option value="" <?php echo (!isset($_POST["relacion"]))?'selected':''; ?>> Todos </option>
          <option value="Idéntico" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Idéntico')?'selected':''; ?>> Similar </option>
          <option value="Similar" <?php echo (isset($_POST["relacion"]) && $_POST["relacion"]=='Similar')?'selected':''; ?>> Id&eacute;ntico </option>
        </select></td>
      <td width="10"></td>
      <td width="35">Precio: </td>
      <td width="100"><select name="precio" id="precio" class="filtros">
          <option value="" <?php echo (!isset($_POST["precio"]))?'selected':''; ?>> Todos </option>
          <option value="Menor" <?php echo (isset($_POST["precio"]) && $_POST["precio"]=='Menor')?'selected':''; ?>> Menor </option>
          <option value="Igual" <?php echo (isset($_POST["precio"]) && $_POST["precio"]=='Igual')?'selected':''; ?>> Igual </option>
          <option value="Mayor" <?php echo (isset($_POST["precio"]) && $_POST["precio"]=='Mayor')?'selected':''; ?>> Mayor </option>
        </select></td>
      <td width="63" align="right"><input type="submit" value="Buscar" name="Buscar" id="Buscar" class="btnVolver"/></td>
    </tr>
  </table>
</form>
<table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; width:100%;">
  <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
    <td>C&oacute;digo</td>
    <td>Tienda</td>
    <td>Nombre</td>
    <td>Precio BIP</td>
    <td>Precio Comparaci&oacute;n</td>
    <td>Diferencia</td>
    <td>Fecha</td>
    <td>Evoluci&oacute;n de precio</td>
  </tr>
  <?php foreach($resultLineas as $linea){
	$diferencia = $linea['cophPrecioBip'] - $linea['cophPrecioComparacion'];
	if($diferencia>0){
		$claseAUtilizar = "precioBipMayor";
	}else if($diferencia<0){
		$claseAUtilizar = "precioBipMenor";
	}else{
		$claseAUtilizar = "precioBipIgual";
	}
	?>
  <tr class="<?php echo $claseAUtilizar; ?>" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000;">
    <td ><?php echo $linea['cophBIP']; ?></td>
    <td ><?php echo $linea['dacoTienda']; ?></td>
    <td ><?php echo $linea['cophNombre']; ?></td>
    <td ><?php echo number_format($linea['cophPrecioBip'],0,',','.'); ?></td>
    <td ><?php echo number_format($linea['cophPrecioComparacion'],0,',','.'); ?></td>
    <td ><?php echo number_format($diferencia,0,',','.'); ?></td>
    <td ><?php echo $linea['cohpFecha']; ?></td>
    <td ><input type="button" value="Mostrar" onclick="location.href = 'reporteComparacionPreciosDetalle.php?dacoId=<?php echo $linea['dacoId']; ?>&nombreTienda=<?php echo $linea['dacoTienda']; ?>'" class="btnVolver" /></td>
  </tr>
  <?php  } ?>
</table>
<br />
<table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000;">
  <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
    <td>Glosa</td>
  </tr>
  <tr class="precioBipMayor">
    <td>Precio Bip es Mayor</td>
  </tr>
  <tr class="precioBipIgual">
    <td>Precio Bip es Idéntico</td>
  </tr>
  <tr class="precioBipMenor">
    <td>Precio Bip es Menor</td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</body>
</html>