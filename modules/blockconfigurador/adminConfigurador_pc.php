<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$query = "Select l.nombreLinea nombreLinea, if(cl.coliTipo is null,1,cl.coliTipo) coliTipo from (select distinct(fvl.value) nombreLinea from "._DB_PREFIX_."product p, "._DB_PREFIX_."product_lang pl, "._DB_PREFIX_."feature_product 
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
ORDER BY nombreLinea) l left join configurador_lineas cl on l.nombreLinea = cl.coliLinea ;";
$resultLineas = Db::getInstance()->ExecuteS($query);
//and c.id_category = 1248
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Configurador de PC - BIP COMPUTERS</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
</script>
</head>

<body>
<style>
table tr td {
    border-bottom: 1px solid #DEDEDE;
    color: #996633;
    font-size: 0.9em;
    height: 23px;
    padding: 0 4px 0 6px;
}
/*.txtcampos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}*/
input.button {
    background-image: url("<?php echo dirname(__FILE__) ?>../../themes/ps_bip/img/button-medium.png");
    width: 120px;
	border: none;
    background-position: left top;
    background-repeat: no-repeat;
    border: medium none;
    color: black !important;
    cursor: pointer;
    display: block;
    font-size: 10px !important;
    font-weight: bold;
    height: 18px;
    line-height: 18px;
    text-align: center;
    text-decoration: none !important;
	padding-bottom: 4px;
}
</style>

<form id="form1" name="form1" method="post" action="ajaxResponse.php?idConsulta=11">
  <table>
    <tr>
      <td></td>
      <td> B&aacute;sico </td>
      <td> Medio </td>
      <td> Avanzado </td>
    </tr>
    <?php foreach($resultLineas as $linea){ ?>
    <tr>
      <td class="txtcampos"><?php echo $linea['nombreLinea']; ?></td>
      <td><input type="radio" name="<?php echo urlencode($linea['nombreLinea']); ?>" value="1"  <?php echo ($linea['coliTipo']==1)?'checked="checked"':''; ?> /></td>
      <td><input type="radio" name="<?php echo urlencode($linea['nombreLinea']); ?>" value="2"  <?php echo ($linea['coliTipo']==2)?'checked="checked"':''; ?> /></td>
      <td><input type="radio" name="<?php echo urlencode($linea['nombreLinea']); ?>" value="3"  <?php echo ($linea['coliTipo']==3)?'checked="checked"':''; ?> /></td>
    </tr>
    <?php  } ?>
    <tr>
      <td colspan="2" align="center" style="border:none;"><input type="submit" value="Guardar" class="button" /></td>
    </tr>
  </table>
</form>
</body>
</html>
