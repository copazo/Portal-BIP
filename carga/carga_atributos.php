<?php
/*  $Id: carga_atributos.php 524 2011-10-13 01:55:06Z darayaz $ */
error_reporting(true);
ini_set("error_reporting",true);
ini_set("display_error",true);
ini_set("max_execution_time",0);
include_once "db/db.php";

$prefijo = "ps_";

$delete_lang = "truncate table ${prefijo}feature_lang";
$delete_feature = "truncate table ${prefijo}feature";
$delete_feature_value = "truncate table ${prefijo}feature_value";
$delete_value_lang = "truncate table ${prefijo}feature_value_lang";
$delete_feature_product = "truncate table ${prefijo}feature_product";

mysql_query($delete_lang,$conn_pshoptest);
mysql_query($delete_feature,$conn_pshoptest);
mysql_query($delete_feature_value,$conn_pshoptest);
mysql_query($delete_value_lang,$conn_pshoptest);
mysql_query($delete_feature_product,$conn_pshoptest);

$query_caracteristicas="select * from nombre_caracteristica";
$res_caracteristicas=mysql_query($query_caracteristicas,$conn_pshoptest);

while($row=mysql_fetch_array($res_caracteristicas))
{
	$tabla_valor[$row["columna"]]=$row["nombre"];
	$insert_car="insert into ${prefijo}feature value(" . $row["id"] . ")";
	mysql_query($insert_car,$conn_pshoptest);
	$insert_car_nombre = "insert into ${prefijo}feature_lang (id_feature,id_lang,name) values (" . $row["id"] . ",3,'" . addslashes($row["nombre"]) . "')";
	mysql_query($insert_car_nombre,$conn_pshoptest);
}

$query_productos="select * from atributos";
$res_productos=mysql_query($query_productos,$conn_pshoptest);

while($row=mysql_fetch_array($res_productos))
{
	foreach ($tabla_valor AS $tabla => $valor)
	{
		if(trim($row[$tabla])!='')
		{
			$check_color="select id_feature from ${prefijo}feature_lang where name='".addslashes($valor)."'";
			$res_color=mysql_query($check_color,$conn_pshoptest);
			$row2=mysql_fetch_array($res_color);
			$insert_id=$row2["id_feature"];
			$check_value="select fvl.id_feature_value from ${prefijo}feature_value fv left join ${prefijo}feature_value_lang fvl on fv.id_feature_value=fvl.id_feature_value where value='".addslashes($row[$tabla])."' and fv.id_feature=" . $insert_id;
			$res_value=mysql_query($check_value,$conn_pshoptest);
			if($row3=mysql_fetch_array($res_value))
			{
				$insert_id_value=$row3["id_feature_value"];
			}else
			{
				$insert_value="insert into ${prefijo}feature_value (id_feature,custom) values(".$insert_id.",0)";
				mysql_query($insert_value,$conn_pshoptest);
				$insert_id_value=mysql_insert_id($conn_pshoptest);
				$insert_value_lang="insert into ${prefijo}feature_value_lang values(" .$insert_id_value.",3,'" .addslashes($row[$tabla])."')";
				mysql_query($insert_value_lang,$conn_pshoptest);
			}
			$check_feature_product = "select * from ${prefijo}feature_product where id_feature=".$insert_id. " and id_product=". $row["B"]. " and id_feature_value=.$insert_id_value";
			$res_feature_product=mysql_query($check_feature_product,$conn_pshoptest);
			if($row4=mysql_fetch_array($res_feature_product))
			{}else 
			{
				$insert_feature_product="insert into ${prefijo}feature_product values(" .$insert_id.",". $row["B"].",".$insert_id_value.")";
				mysql_query($insert_feature_product,$conn_pshoptest);
			}
		}
	}
}
?>
