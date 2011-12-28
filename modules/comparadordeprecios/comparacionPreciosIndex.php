<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');


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
  <table width="600" border="0" align="center">
    <tr>
      <td width="300" align="center"><a href="adminComparador.php"><img src="http://www.test.exe.cl/exeBIPdev/wmin/themes/oldschool/coins.png" alt="Comparador de Precios" width="125" height="125" border="0" /></a></td>
      <td width="300" align="center"><a href="reporteComparacionPrecios.php"><img src="http://www.test.exe.cl/exeBIPdev/wmin/themes/oldschool/bar_graph.png" alt="Reportes Comparador de Precios" width="125" height="125" border="0" /></a></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="300" align="center"><a href="adminComparador.php" style="font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#060; background-color:#FFFFFF;">Comparacion de Precios</a></td>
      <td width="300" align="center"><a href="reporteComparacionPrecios.php" style="font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#060; background-color:#FFFFFF;">Reporte de Comparaciones</a></td>
      <td width="300" align="center"><a href="reporteEnvioUsuariosRegistrados.php">Ranking de registros por usuario</a></td>
    </tr>
  </table>
<script language="javascript" type="text/javascript">
calculaLargo();
</script>
</body>
</html>
