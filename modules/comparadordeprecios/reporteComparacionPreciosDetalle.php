<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$query = "	SELECT *
			FROM comparadorprecioshist
			WHERE dacoId = ".$_GET["dacoId"]."
			ORDER BY cophId DESC";
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
-->
</style>
</head>

<body>
<input type="button" value="Volver" onclick="location.href = 'reporteComparacionPrecios.php';" style="background-color: #FFF6D3;
    border-color: #FFF6D3 #DFD5AF #DFD5AF #FFF6D3;
    border-right: 1px solid #DFD5AF;
    border-style: solid;
    border-width: 1px;
    color: #268CCD;
    padding: 3px;">
<div style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#060; background-color:#FFFFFF;">Detalle de art&iacute;culo de tienda <?php echo $_GET['nombreTienda']; ?></div>
  <table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; width:100%;">
    <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
      <td>C&oacute;digo</td>
      <td>Nombre</td>
      <td>Precio BIP</td>
      <td>Precio Comparaci&oacute;n</td>
      <td>Diferencia</td>
      <td>Fecha</td>
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
      <td><?php echo $linea['cophBIP']; ?></td>
      <td><?php echo $linea['cophNombre']; ?></td>
      <td><?php echo number_format($linea['cophPrecioBip'],0,',','.'); ?></td>
      <td><?php echo number_format($linea['cophPrecioComparacion'],0,',','.'); ?></td>
      <td ><?php echo number_format($diferencia,0,',','.'); ?></td>
      <td><?php echo $linea['cohpFecha']; ?></td>
    </tr>
    <?php  } ?>
  </table>
  <br />
  <table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000;">
  	<tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;"><td>Glosa</td></tr>
  	<tr class="precioBipMayor"><td>Precio Bip es Mayor</td></tr>
    <tr class="precioBipIgual"><td>Precio Bip es Idéntico</td></tr>
    <tr class="precioBipMenor"><td>Precio Bip es Menor</td></tr>
</table>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</body>
</html>