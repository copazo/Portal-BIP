<?php 
include("conexion.php");
$trs_transaccion = $_POST['TBK_TIPO_TRANSACCION'];
$trs_respuesta = $_POST['TBK_RESPUESTA'];
$trs_orden_compra = $_POST['TBK_ORDEN_COMPRA'];
$trs_id_session = $_POST['TBK_ID_SESION'];
$trs_cod_autorizacion = $_POST['TBK_CODIGO_AUTORIZACION'];
$trs_monto = substr($_POST['TBK_MONTO'],0,-2).".00";
$trs_nro_final_tarjeta = $_POST['TBK_FINAL_NUMERO_TARJETA'];
$trs_fecha_expiracion = $_POST['TBK_FECHA_EXPIRACION'];
$trs_fecha_contable = $_POST['TBK_FECHA_CONTABLE'];
$trs_fecha_transaccion = $_POST['TBK_FECHA_TRANSACCION'];
$trs_hora_transaccion = $_POST['TBK_HORA_TRANSACCION'];
$trs_id_transaccion = $_POST['TBK_ID_TRANSACCION'];
$trs_tipo_pago = $_POST['TBK_TIPO_PAGO'];
$trs_nro_cuotas = $_POST['TBK_NUMERO_CUOTAS'];
$trs_mac = $_POST['TBK_MAC'];
$trs_tasa_interes_max = $_POST['TBK_TASA_INTERES_MAX'];


/* Graba en base de datos */
  Db::getInstance()->AutoExecute('webpay', array('Tbk_tipo_transaccion' =>$trs_transaccion,'Tbk_respuesta' =>$trs_respuesta,'Tbk_orden_compra' =>$trs_orden_compra,'Tbk_id_sesion' =>$trs_id_session,'Tbk_codigo_autorizacion' =>$trs_cod_autorizacion,'Tbk_monto' =>$trs_monto,'Tbk_Final_numero_Tarjeta' =>$trs_nro_final_tarjeta,'Tbk_fecha_expiracion' =>$trs_fecha_expiracion,'Tbk_fecha_contable' =>$trs_fecha_contable,'Tbk_fecha_transaccion' =>$trs_fecha_transaccion,'Tbk_hora_transaccion' =>$trs_hora_transaccion,'Tbk_id_transaccion' =>$trs_id_transaccion,'Tbk_tipo_pago' =>$trs_tipo_pago,'Tbk_numero_cuotas' =>$trs_nro_cuotas,'Tbk_mac' =>$trs_mac,'Tbk_tasa_interes_max' =>$trs_tasa_interes_max), 'INSERT');  

/* finde grabar en base */


/**** inicio de pagina de cierre xt_compra.php***/ 

 if($trs_respuesta==0)
{ 
//**** validacion de mac ****/***cambiar aquí por su dirección en el servidor
  
    $temporal = "temporal.txt";
    if($fp = fopen($temporal, "w"))
     {
      fwrite($fp, $trs_cod_autorizacion);
      fclose($fp);
      } 
    /*1.- Abrir archivo y guardar variables POST recibidas */ 
     
    $filename = "log".$trs_id_transaccion.".txt";
    $fp=fopen($filename,"w");
    reset($_POST);
    while (list($key,$val) = each($_POST))
      {
       fwrite($fp,"$key=$val&");
      }
	 fclose($fp); 
     /* 2.- Invocar a tbk_check_mac (Que en realidad no es una cgi) usando como parámetro el archivo generado */
    $cmdline = "/cgi-bin/tbk_check_mac.cgi $filename";
    exec($cmdline,$result,$retint); 
    /*Si $result[0]="CORRECTO" , entonces mac válido*/
    if($result[0]="CORRECTO")
     { 
	  echo "ACEPTADO";
      /**** Comprobacion de Orden de Compra ****/
      $query_RS_Busca = "select * from pagos where TBK_ORDEN_COMPRA ='".$trs_orden_compra."' order by TBK_ORDEN_COMPRA DESC Limit 1";
      $RS_Busca = mysql_query($query_RS_Busca, $conexion) or die(mysql_error());
      $row_RS_Busca = mysql_fetch_assoc($RS_Busca);
      $totalRows_RS_Busca = mysql_num_rows($RS_Busca);
      $theValue = ($totalRows_RS_Busca>1) ? "RECHAZADO" : "ACEPTADO";
       if ($theValue=="ACEPTADO")
       {  
         /**** Comprobacion de Monto ****/
		  $query_RS_Montos = "select * from pagos where TBK_ORDEN_COMPRA ='".$trs_orden_compra."' Order by TBK_ORDEN_COMPRA DESC Limit 1" ;
         $RS_Montos = mysql_query($query_RS_Montos, $conexion) or die(mysql_error());
         $row_RS_Montos = mysql_fetch_assoc($RS_Montos);
         $totalRows_RS_Montos = mysql_num_rows($RS_Montos);
         $theValue = ($trs_monto!=$row_RS_Montos['TBK_MONTO']) ? "RECHAZADO" : "ACEPTADO"; 
         if ($theValue=="ACEPTADO")
          {   
            	echo "ACEPTADO";
		  }
           else
          {
          echo "RECHAZADO";
          }
          
		 /**** fin Comprobacion de Montos ****/ 
		} 
        else
        {
         echo "RECHAZADO";
        }   
	  /*** fin Comprobacion de Orden de Compra ****/
       } 
     else
     { 
      echo "RECHAZADO";
     } 
 /****fin Validacion MAC ****/
 }
else
{ 
  echo "ACEPTADO";
 }
?>