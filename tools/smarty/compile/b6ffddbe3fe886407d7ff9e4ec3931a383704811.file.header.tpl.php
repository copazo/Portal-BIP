<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 08:50:26
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10713053544ef076827e8ab0-67334052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6ffddbe3fe886407d7ff9e4ec3931a383704811' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/header.tpl',
      1 => 1324348341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10713053544ef076827e8ab0-67334052',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getVariable('lang_iso')->value;?>
">
	<head>
		<title><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'htmlall','UTF-8');?>
</title>
<?php if (isset($_smarty_tpl->getVariable('meta_description',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_description')->value){?>
		<meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_description')->value,'html','UTF-8');?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('meta_keywords',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_keywords')->value){?>
		<meta name="keywords" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_keywords')->value,'html','UTF-8');?>
" />
<?php }?>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->getVariable('nobots',null,true,false)->value)){?>no<?php }?>index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" />
		<script type="text/javascript">
			var baseDir = '<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
';
			var static_token = '<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
';
			var token = '<?php echo $_smarty_tpl->getVariable('token')->value;?>
';
			var priceDisplayPrecision = <?php echo $_smarty_tpl->getVariable('priceDisplayPrecision')->value*$_smarty_tpl->getVariable('currency')->value->decimals;?>
;
			var priceDisplayMethod = <?php echo $_smarty_tpl->getVariable('priceDisplay')->value;?>
;
			var roundMode = <?php echo $_smarty_tpl->getVariable('roundMode')->value;?>
;
		</script>
<?php if (isset($_smarty_tpl->getVariable('css_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('css_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
	<?php }} ?>
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('js_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value){
?>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
"></script>
	<?php }} ?>
<?php }?>
		<?php echo $_smarty_tpl->getVariable('HOOK_HEADER')->value;?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
js/jquery/jquery.cookie.js"></script>
<script type="text/javascript">
function changeTab(tab)
{
	$('.forma_pago').hide();


	if(tab=='t_usados')
	{
                $('#our_price_display_internet').hide();
                $('#our_price_display_tienda').show();

		$('#cl_usados').show();
		$('.price').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').hide();
                $('.s_precio_internet').show();
		$('#cl_internet_mall').hide();
		$('#cl_tiendas_usados').show();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_usados').addClass('tienda_current');
		$('#group_5').val('25');
	}
	else if(tab=='t_internet')
	{

                $('#our_price_display_internet').show();
                $('#our_price_display_tienda').hide();
		$('#cl_internet').show();
		$('.price').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').hide();
                $('.s_precio_internet').show();
		$('#cl_internet_mall').show();
		$('#cl_tiendas_usados').hide();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_internet').addClass('tienda_current');
		$('#group_5').val('25');
	}else if(tab=='t_tiendas2')
	{
                cambiarCuotas();
                $('#our_price_display_internet').hide();
                $('#our_price_display_tienda').show();
		$('#cl_tienda').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').show();
                $('.s_precio_internet').hide();
		$('#cl_internet_mall').hide();
		$('#cl_tiendas_usados').show();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_tiendas').addClass('tienda_current');
		$('#group_5').val('22');

	}
	else if(tab=='t_tiendas')
	{

                $('#our_price_display_internet').hide();
                $('#our_price_display_tienda').show();
		$('#cl_tienda').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').show();
                $('.s_precio_internet').hide();
		$('#cl_internet_mall').hide();
		$('#cl_tiendas_usados').show();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_tiendas').addClass('tienda_current');
		$('#group_5').val('22');

	}
	else if(tab=='t_mall')
	{

                $('#our_price_display_internet').hide();
                $('#our_price_display_tienda').show();
		$('#cl_mall').show();
		$('.s_precio_mall').show();
		$('.s_precio_tiendas').hide();
                $('.s_precio_internet').hide();
		$('#cl_internet_mall').show();
		$('#cl_tiendas_usados').hide();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_mall').addClass('tienda_current');
		$('#group_5').val('24');

	}else{
            $('.s_precio_mall').hide();
            $('.s_precio_tiendas').hide();
            $('.s_precio_internet').show();
$('#our_price_display_internet').show();
$('#our_price_display_tienda').hide();
        }
	if(typeof findCombination == 'function') {
		findCombination();
	}
	$.cookie("bip_tab", tab);
}
</script>
</head>
<body <?php if ($_smarty_tpl->getVariable('page_name')->value){?>id="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page_name')->value,'htmlall','UTF-8');?>
"<?php }?>>
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
		<?php if (isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value){?>
<div id="restricted-country">
  <p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country.'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->getVariable('geolocation_country')->value;?>
</span></p>
</div>
<?php }?>
<div id="page">
<!-- Header -->
<div id="header"> <a id="header_logo" href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
"> <img class="logo" src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
logo.jpg?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('logo_image_width')->value){?>width="<?php echo $_smarty_tpl->getVariable('logo_image_width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('logo_image_height')->value){?>height="<?php echo $_smarty_tpl->getVariable('logo_image_height')->value;?>
" <?php }?> /> </a>
  <div id="slogan_store"> <a href="#" id="Banner"> <img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/img_slogan_header_bip_01.jpg" height="22" width="254" /></a> </div>
  <div id="link_marcas"> <a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
manufacturer.php" id="todasmarcas">todas las marcas</a> | <a href="#" id="giftcard">giftcard</a> </div>
  <div id="header_right"> <?php echo $_smarty_tpl->getVariable('HOOK_TOP')->value;?>
 </div>
  <div id="menu_tiendas">
    <ul class="tienda">
      <li id="t_internet" class="tienda_current"><a href="javascript:changeTab('t_internet');">Internet</a></li>
      <li id="t_tiendas" class="tienda"><a href="javascript:changeTab('t_tiendas');">Tiendas</a></li>
      <li id="t_usados" class="tienda"><a href="javascript:changeTab('t_usados');">Usados</a></li>
      <li id="t_mall" class="tienda"><a href="javascript:changeTab('t_mall');">Mall</a></li>
    </ul>
  </div>
	<script>changeTab($.cookie('bip_tab'));</script>
  <div id="topBanner"> <a href="#" id="Banner"> <img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/img_menu_tiendas.jpg" width="340" height="40"/>
  </a> </div>
</div>
<div class="mainCategoryLinks">
  <ul class="inlineMenu">
    <li class="n1"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
364-computadores" name="Computadores" target="_self" id="Computadores"><span>Computadores</span></a></li>
    <li class="n2"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
365-desktop" name="Desktop" target="_self" id="Desktop"><span>Desktop</span></a></li>
    <li class="n3"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
366-fotografia-camaras" name="Fotografia / Camaras" target="_self" id="Fotografia / Camaras"><span>Fotograf&iacute;a / C&aacute;maras</span></a></li>
    <li class="n4"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
367-conectividad" name="Conectividad" target="_self" id="Conectividad"><span>Conectividad</span></a></li>
    <li class="n5"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
368-productividad-empresas" name="Productividad y Empresas" target="_self" id="Productividad y Empresas"><span>Productividad &amp; Empresas</span></a></li>
    <li class="n6"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
369-video-display" name="Video / Display" target="_self" id="Video / Display"><span>Video / Display</span></a></li>
    <li class="n7"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
370-seguridad" name="Seguridad" target="_self" id="Seguridad"><span>Seguridad</span></a></li>
    <li class="n8"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
371-otros" name="Otros" target="_self" id="Otros"><span>Otros</span></a></li>
  </ul>
</div>
<!--END mainCategoryLinks -->
<div id="columns">

<!-- Left -->
<div id="left_column" class="column"> <?php echo $_smarty_tpl->getVariable('HOOK_LEFT_COLUMN')->value;?>
 </div>
<!-- Center -->
<div id="center_column">
<?php }?> 
