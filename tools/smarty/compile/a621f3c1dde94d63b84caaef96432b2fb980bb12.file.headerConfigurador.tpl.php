<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 02:15:22
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/../../modules/blockconfigurador/headerConfigurador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18763929094ef019ea397562-79538241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a621f3c1dde94d63b84caaef96432b2fb980bb12' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/../../modules/blockconfigurador/headerConfigurador.tpl',
      1 => 1324350080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18763929094ef019ea397562-79538241',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
	$('.s_precio_mall').hide();
	$('.s_precio_tiendas').hide();
	if(tab=='t_usados')
	{
		$('#cl_usados').show();
		$('.price').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').hide();
		$('#cl_internet_mall').hide();
		$('#cl_tiendas_usados').show();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_usados').addClass('tienda_current');
		$('#group_5').val('25');
	}
	if(tab=='t_internet')
	{
		$('#cl_internet').show();
		$('.price').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').hide();
		$('#cl_internet_mall').show();
		$('#cl_tiendas_usados').hide();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_internet').addClass('tienda_current');
		$('#group_5').val('25');
	}
	if(tab=='t_tiendas')
	{
		$('#cl_tienda').show();
		$('.s_precio_mall').hide();
		$('.s_precio_tiendas').show();
		$('#cl_internet_mall').hide();
		$('#cl_tiendas_usados').show();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_tiendas').addClass('tienda_current');
		$('#group_5').val('22');
		if(document.body.id=='category'||document.body.id=='search')
		$('.price').hide();
	}
	if(tab=='t_mall')
	{
		$('#cl_mall').show();
		$('.s_precio_mall').show();
		$('.s_precio_tiendas').hide();
		$('#cl_internet_mall').show();
		$('#cl_tiendas_usados').hide();
		$('.tienda_current').removeClass('tienda_current');
		$('#t_mall').addClass('tienda_current');
		$('#group_5').val('24');
		if(document.body.id=='category'||document.body.id=='search')
		$('.price').hide();
	}
	if(typeof findCombination == 'function') {
		findCombination();
	}
	$.cookie("bip_tab", tab);
}
</script>
</head>
<body <?php if ($_smarty_tpl->getVariable('page_name')->value){?>id="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page_name')->value,'htmlall','UTF-8');?>
"<?php }?> style="width:750px; background:none" align="left">
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
		<?php if (isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value){?>
<?php }?>
<div id="pageConf" style="width:750px" align="left">
<!-- Header -->

<!--END mainCategoryLinks -->
<div id="columns" style="width:750px" align="left" >
<!--START HOMEPAGE -->
<!--END HOMEPAGE -->
<!-- Left -->

<!-- Center -->
<div id="center_column" style="width:750px" align="left">
<?php }?> 
