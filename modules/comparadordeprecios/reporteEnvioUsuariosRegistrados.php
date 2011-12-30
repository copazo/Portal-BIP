<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$query = "	SELECT dacoEmail, count(dacoId) cantidad
			FROM comparadorprecios
			WHERE dacoUsuario = 'Cliente'
			GROUP BY dacoEmail
			ORDER BY cantidad DESC";
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
-->
</style>
</head>

<body>
	<input type="button" value="Volver" onclick="location.href = 'comparacionPreciosIndex.php';" class="btnVolver"/>

    <table style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#060; background-color:#FFFFFF;">
  	<tr>
        <td width="200">Se han encontrado <?php echo sizeof($resultLineas); ?> registros.</td>
	</tr>
	</table>
  
	<table border="0" cellpadding="2" cellspacing="1" style="border:1px solid #DFD5C3; width:100%;">
    <tr style="font-family: Arial, Helvetica, sans-serif; font-size:10px; color:green; background-color:#F4E6C9;">
      <td>Cliente</td>
      <td>Cantidad de Registros</td>
    </tr>
    <?php foreach($resultLineas as $linea){?>
    <tr style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000000;">
      <td><?php echo $linea['dacoEmail']; ?></td>
      <td><?php echo $linea['cantidad']; ?></td>
    </tr>
    <?php  } ?>
  </table>
  
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</body>
</html>