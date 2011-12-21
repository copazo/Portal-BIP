<?php
global $cookies;
global $smarty;
global $cart;

include('../../config/config.inc.php');
include(_PS_ROOT_DIR_.'/header.php');


echo "
<script type='text/javascript' src='".__PS_BASE_URI__."js/jquery/jquery.fancybox-1.3.4.js'></script>
<script type='text/javascript' src='".__PS_BASE_URI__."js/jquery/jquery.serialScroll-1.2.2-min.js'></script>
<script type='text/javascript' src='".__PS_BASE_URI__."themes/ps_bip/js/product.js'></script>
<link href='".__PS_BASE_URI__."css/jquery.fancybox-1.3.4.css' rel='stylesheet' type='text/css' media='screen' />

<a class='extLinkParlantes' href='".__PS_BASE_URI__."modules/blockconfigurador/categoryConfigurador.php?id_category=1352' id='linkExternoParlantes'></a>
<a class='extLinkWebcam' href='".__PS_BASE_URI__."modules/blockconfigurador/categoryConfigurador.php?id_category=1353' id='linkExternoWebcam'></a>
<a class='extLinkMonitor' href='".__PS_BASE_URI__."modules/blockconfigurador/categoryConfigurador.php?id_category=1329' id='linkExternoMonitor'></a>
<a class='extLinkTeclado' href='".__PS_BASE_URI__."modules/blockconfigurador/categoryConfigurador.php?id_category=1358' id='linkExternoTeclado'></a>
<a class='extLinkMouse' href='".__PS_BASE_URI__."modules/blockconfigurador/categoryConfigurador.php?id_category=1356' id='linkExternoMouse'></a>

<table><tr><td style='background-color:#FFFFFF;'><iframe id='iframeConfigurador' src='configurador_pc.php' name='ZONE1' width='700'  marginwidth='0' height='960' marginheight='0' scrolling='no' frameborder='0' id='ZONE1' border='0'></iframe></td></tr></table>

<script type='text/javascript'>
$(document).ready(function(){
    $(\".extLinkParlantes\").fancybox({
         'width' : 780,
         'height' : 350,
         'autoScale' : false,
         'transitionIn' : '600',
         'transitionOut' : '200',
         'type' : 'iframe',
		 'title' 		: 'Parlantes'
     });
});

$(document).ready(function(){
    $('.extLinkWebcam').fancybox({
         'width' : 780,
         'height' : 350,
         'autoScale' : false,
         'transitionIn' : '600',
         'transitionOut' : '200',
         'type' : 'iframe',
		 'title' 		: 'Webcam'
     });
});

$(document).ready(function(){
    $('.extLinkMonitor').fancybox({
         'width' : 780,
         'height' : 350,
         'autoScale' : false,
         'transitionIn' : '600',
         'transitionOut' : '200',
         'type' : 'iframe',
		 'title' 		: 'Monitor'
     });
});

$(document).ready(function(){
    $('.extLinkTeclado').fancybox({
         'width' : 780,
         'height' : 350,
         'autoScale' : false,
         'transitionIn' : '600',
         'transitionOut' : '200',
         'type' : 'iframe',
		 'title' 		: 'Teclado'
     });
});

$(document).ready(function(){
    $('.extLinkMouse').fancybox({
         'width' : 780,
         'height' : 350,
         'autoScale' : false,
         'transitionIn' : '600',
         'transitionOut' : '200',
         'type' : 'iframe',
		 'title' 		: 'Mouse'
     });
});

</script>
";	

	
include(_PS_ROOT_DIR_.'/footer.php');
?>