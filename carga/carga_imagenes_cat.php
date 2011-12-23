<?php
//include('SimpleImage.php');
/*  $Id: carga_atributos.php 209 2011-07-20 05:38:14Z darayaz $ */
error_reporting(E_ALL ^ E_NOTICE);
 ini_set('display_errors','On'); 

 $conn_pshoptest=mysql_connect("localhost","root","gyarados");

mysql_select_db("ps_exe_bip_dev",$conn_pshoptest) or die("NOOK2");
 
$catgs = "SELECT ps_category.id_category,link_rewrite FROM ps_category inner join ps_category_lang on ps_category.id_category = ps_category_lang.id_category where id_parent<>1 order by ps_category_lang.id_category asc";
$res_catg = mysql_query($catgs);
while($row=mysql_fetch_array($res_catg))
{
echo '<br><br>'.'padre::--'.$row['id_category'];
       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
       FROM ps_product  
       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
       WHERE ps_product_attribute.price = 
       (
       SELECT MAX(  ps_product_attribute.price )  FROM  
       ps_product_attribute 
       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
       where 
       id_category_default = ".$row['id_category']."
       ) 
       and id_category_default = ".$row['id_category']."";

    $res_catg_max = mysql_query($catgs_max);

    if($row2=mysql_fetch_array($res_catg_max)){
                echo '1-----------------'.$row2['id_product']."<br>";
                copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");

                continue;
    }else{

                $catgs_likes = "SELECT ps_category.id_category,name FROM ps_category inner join ps_category_lang on ps_category.id_category = ps_category_lang.id_category 
                    where id_parent<>1 and link_rewrite='".$row['link_rewrite']."' and  ps_category.id_category<>".$row['id_category']." order by id_parent desc";

                $res_catg_likes = mysql_query($catgs_likes);
                    echo mysql_error();
                while($row_like=mysql_fetch_array($res_catg_likes)){
                    
                    
                    
                echo 'catt--'.$row['id_category'].'------------'.$row_like['id_category']."<br>";
                       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
                       FROM ps_product  
                       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
                       WHERE ps_product_attribute.price = 
                       (
                       SELECT MAX(  ps_product_attribute.price )  FROM  
                       ps_product_attribute 
                       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
                       where 
                       id_category_default = ".$row_like['id_category']."
                       ) 
                       and id_category_default = ".$row_like['id_category']."";

                    $res_catg_max = mysql_query($catgs_max);

                    if($row2=mysql_fetch_array($res_catg_max)){  
                        echo 'like-----------------'.$row2['id_product']."<br>";
                        copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                        copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");
                    }else{
                    
                    

        $catgs_parent = "SELECT id_category FROM ps_category where id_parent = ".$row_like['id_category']." and id_parent<>1";
        
        $res_catg_parent = mysql_query($catgs_parent);
        $price = 0;
        while($row_par=mysql_fetch_array($res_catg_parent)){
                        //echo '---'.$row_par['id_category'].'<br>';
                        
                       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
                       FROM ps_product  
                       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
                       WHERE ps_product_attribute.price = 
                       (
                       SELECT MAX(  ps_product_attribute.price )  FROM  
                       ps_product_attribute 
                       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
                       where 
                       id_category_default = ".$row_par['id_category']."
                       ) 
                       and id_category_default = ".$row_par['id_category']."";
                
                        $res_catg_max = mysql_query($catgs_max);
                        if($row2=mysql_fetch_array($res_catg_max)){
                            if($row2["price"]>$price){
                                    echo '2-----------------'.$row2['id_product']."<br>";
                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");
                                    $price = $row2["price"];
                            }
                                    
                        }else{
                                $catgs_parent2 = "SELECT id_category FROM ps_category where id_parent = ".$row_par['id_category']." and id_parent<>1";

                                
                                $res_catg_parent2 = mysql_query($catgs_parent2);
                                $price=0;
                                while($row_par2=mysql_fetch_array($res_catg_parent2)){ 

                                       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
                                       FROM ps_product  
                                       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
                                       WHERE ps_product_attribute.price = 
                                       (
                                       SELECT MAX(  ps_product_attribute.price )  FROM  
                                       ps_product_attribute 
                                       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
                                       where 
                                       id_category_default = ".$row_par2['id_category']."
                                       ) 
                                       and id_category_default = ".$row_par2['id_category']."";

                                        $res_catg_max = mysql_query($catgs_max);
                                        if($row2=mysql_fetch_array($res_catg_max)){
                                            if($row2["price"]>$price){
                                                    echo '3-----------------'.$row2['id_product']."<br>";
                                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");
                                                    $price = $row2["price"];
                                            }

                                    } 
                                    
                                }
                            
                        }
                        
                        
                        
            
                }
                    
                    
                    
                    
                    
                    
                }}
                
        
        
        
        
        
        
        $ultrow = '';


        $catgs_parent = "SELECT id_category FROM ps_category where id_parent = ".$row['id_category']." and id_parent<>1";
        
        $res_catg_parent = mysql_query($catgs_parent);
        $price = 0;
        while($row_par=mysql_fetch_array($res_catg_parent)){
                        //echo '---'.$row_par['id_category'].'<br>';
                        
                       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
                       FROM ps_product  
                       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
                       WHERE ps_product_attribute.price = 
                       (
                       SELECT MAX(  ps_product_attribute.price )  FROM  
                       ps_product_attribute 
                       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
                       where 
                       id_category_default = ".$row_par['id_category']."
                       ) 
                       and id_category_default = ".$row_par['id_category']."";
                
                        $res_catg_max = mysql_query($catgs_max);
                        if($row2=mysql_fetch_array($res_catg_max)){
                            if($row2["price"]>$price){
                                    echo '2-----------------'.$row2['id_product']."<br>";
                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");
                                    $price = $row2["price"];
                            }
                                    
                        }else{
                                $catgs_parent2 = "SELECT id_category FROM ps_category where id_parent = ".$row_par['id_category']." and id_parent<>1";

                                
                                $res_catg_parent2 = mysql_query($catgs_parent2);
                                $price=0;
                                while($row_par2=mysql_fetch_array($res_catg_parent2)){ 

                                       $catgs_max = "SELECT distinct ps_product.id_product,ps_product_attribute.price,ps_product.id_category_default 
                                       FROM ps_product  
                                       INNER JOIN  ps_product_attribute ON ps_product.id_product = ps_product_attribute.id_product
                                       WHERE ps_product_attribute.price = 
                                       (
                                       SELECT MAX(  ps_product_attribute.price )  FROM  
                                       ps_product_attribute 
                                       INNER JOIN  ps_product ON ps_product.id_product = ps_product_attribute.id_product
                                       where 
                                       id_category_default = ".$row_par2['id_category']."
                                       ) 
                                       and id_category_default = ".$row_par2['id_category']."";

                                        $res_catg_max = mysql_query($catgs_max);
                                        if($row2=mysql_fetch_array($res_catg_max)){
                                            if($row2["price"]>$price){
                                                    echo '3-----------------'.$row2['id_product']."<br>";
                                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"]."-category.jpg");
                                                    copy("p/".$row2["id_product"]."-large.jpg","c/".$row["id_category"].".jpg");
                                                    $price = $row2["price"];
                                            }

                                    } 
                                    
                                }
                            
                        }
                        
                        
                        
            
                }
               
           
        $ultrow='';
    }
        
        
}
?>
