<?php
/*  $Id: carga_precios.php 526 2011-10-13 02:15:29Z darayaz $ */
include_once "db/db.php";


$prefijo = "ps_";


$delete_value_lang = "truncate table ${prefijo}product_attribute";
$delete_feature_product = "truncate table ${prefijo}product_attribute_combination";
$delete_value_layer = "truncate table ${prefijo}layered_price_index";
mysql_query($delete_value_lang,$conn_pshoptest);
mysql_query($delete_feature_product,$conn_pshoptest);
mysql_query($delete_value_layer,$conn_pshoptest);




$query_productos="select id_product from ps_product";
$res_productos=mysql_query($query_productos,$conn_pshoptest);

while($row=mysql_fetch_array($res_productos,$conn_pshoptest))
{

$query_productos2="select id_producto as id_product,precio_normal as price from bip_sphinx.producto_precio where id_lista=2 and id_producto=".$row['id_product']."";
$res_productos2=mysql_query($query_productos2,$conn_bippg);
$row2=mysql_fetch_array($res_productos2,$conn_bippg); 

if(!$row2["price"])
    $row2["price"]=0;


	$insert_prod_att ="insert into ${prefijo}layered_price_index (id_product,id_currency,price_min,price_max) values (".$row["id_product"].",4,".round($row2["price"]*0.9).",".($row2["price"]).")";
	mysql_query($insert_prod_att,$conn_pshoptest);

	$insert_prod_att ="insert into ${prefijo}product_attribute (id_product,price,default_on) values (".$row["id_product"].",".($row2["price"]*0.9).",1)";
	mysql_query($insert_prod_att,$conn_pshoptest);
	$insert_id_value=mysql_insert_id();
	$insert_prod_att_comb = "insert into ${prefijo}product_attribute_combination (id_product_attribute,id_attribute) values(".$insert_id_value.",21)";
	mysql_query($insert_prod_att_comb,$conn_pshoptest);
	
	$insert_prod_att ="insert into ${prefijo}product_attribute (id_product,price,default_on) values (".$row["id_product"].",".($row2["price"]).",0)";
	mysql_query($insert_prod_att,$conn_pshoptest);
	$insert_id_value=mysql_insert_id();
	$insert_prod_att_comb = "insert into ${prefijo}product_attribute_combination (id_product_attribute,id_attribute) values(".$insert_id_value.",22)";
	mysql_query($insert_prod_att_comb,$conn_pshoptest);
	
	$insert_prod_att ="insert into ${prefijo}product_attribute (id_product,price,default_on) values (".$row["id_product"].",".($row2["price"]).",0)";
	mysql_query($insert_prod_att,$conn_pshoptest);
	$insert_id_value=mysql_insert_id();
	$insert_prod_att_comb = "insert into ${prefijo}product_attribute_combination (id_product_attribute,id_attribute) values(".$insert_id_value.",23)";
	mysql_query($insert_prod_att_comb,$conn_pshoptest);
        
        //distribuidor grande
	$insert_prod_att ="insert into ${prefijo}product_attribute (id_product,price,default_on) values (".$row["id_product"].",".($row2["price"]).",0)";
	mysql_query($insert_prod_att,$conn_pshoptest);
	$insert_id_value=mysql_insert_id();
	$insert_prod_att_comb = "insert into ${prefijo}product_attribute_combination (id_product_attribute,id_attribute) values(".$insert_id_value.",24)";
	mysql_query($insert_prod_att_comb,$conn_pshoptest);
        //distribuidor chico
	$insert_prod_att ="insert into ${prefijo}product_attribute (id_product,price,default_on) values (".$row["id_product"].",".($row2["price"]).",0)";
	mysql_query($insert_prod_att,$conn_pshoptest);
	$insert_id_value=mysql_insert_id();
	$insert_prod_att_comb = "insert into ${prefijo}product_attribute_combination (id_product_attribute,id_attribute) values(".$insert_id_value.",25)";
	mysql_query($insert_prod_att_comb,$conn_pshoptest);
}

?>
