<?php
//include('SimpleImage.php');
/*  $Id: carga_atributos.php 209 2011-07-20 05:38:14Z darayaz $ */
error_reporting(E_ALL ^ E_NOTICE);
 ini_set('display_errors','On'); 
include_once "db/db.php";
$id_productos = "SELECT distinct ps_product_lang.id_product,ps_product_lang.name,ps_product.id_category_default FROM ps_product_lang inner join ps_product on ps_product_lang.id_product = ps_product.id_product";
$res_productos = mysql_query($id_productos,$conn_pshoptest);
$category = '';
$arracat = array();
while($row=mysql_fetch_array($res_productos))
{
    
        $category = $row['id_category_default'];
        $arracat[]=$row['id_category_default'];
        
	$nueva_imagen = "insert into ps_image values(0," . $row["id_product"] . ",1,1)";
	mysql_query($nueva_imagen,$conn_pshoptest);	
	$insert_id_value=mysql_insert_id();
	$img_desc = "insert into ps_image_lang values(" . $insert_id_value . ",3,'" . addslashes($row["name"]) . "')";
	mysql_query($img_desc,$conn_pshoptest);	
	$dimensiones_query="select * from ps_image_type where products=1";
	$res_tipos=mysql_query($dimensiones_query,$conn_pshoptest);
/*	while($tipo=mysql_fetch_array($res_tipos))
	{
	$image = new SimpleImage();
	$image->load("/home/exeweb/photos/".$row["id_product"].".jpg");
		$image->resize($tipo["width"],$tipo["height"]);	
		$image->save("/home/exeweb/test.exe.cl/tiendaBIPdev/img/p/".$row["id_product"]."-".$insert_id_value."-".$tipo["name"].".jpg");	
		unset($image);
	}*/
        /*
        //carga img
	while($tipo=mysql_fetch_array($res_tipos))
	{
		copy("".$row["id_product"]."-".$tipo["name"].".jpg","".$row["id_product"]."-".$insert_id_value."-".$tipo["name"].".jpg");
	}
	copy("".$row["id_product"].".jpg","".$row["id_product"]."-".$insert_id_value.".jpg");
        
        */
        
        if(!in_array($row['id_category_default'], $arracat)){
            copy("".$row["id_product"].".jpg","../c/".$row["id_category_default"]."-category.jpg");
            copy("".$row["id_product"].".jpg","../c/".$row["id_category_default"].".jpg");
        }
}
?>
