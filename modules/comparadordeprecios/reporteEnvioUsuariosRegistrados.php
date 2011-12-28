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

</head>

<body>
	<input type="button" value="Volver" onclick="location.href = 'comparacionPreciosIndex.php';">

    <table width="647">
        <tr>
			<td width="213">Se han encontrado <?php echo sizeof($resultLineas); ?> registros.</td>
        </tr>
    </table>
    </form>
  <table border="1">
    <tr>
      <td>Cliente</td>
      <td>Cantidad de registros</td>
    </tr>
    <?php foreach($resultLineas as $linea){?>
    
    <tr>
      <td ><?php echo $linea['dacoEmail']; ?></td>
      <td ><?php echo $linea['cantidad']; ?></td>
    </tr>
    <?php  } ?>
  </table>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</body>
</html>