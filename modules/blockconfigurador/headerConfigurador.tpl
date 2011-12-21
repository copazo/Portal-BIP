<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">
<head>
<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
{if isset($meta_description) AND $meta_description}
<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
{/if}
{if isset($meta_keywords) AND $meta_keywords}
<meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
{/if}
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta name="generator" content="PrestaShop" />
<meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />
<link rel="icon" type="image/vnd.microsoft.icon" href="{$img_ps_dir}favicon.ico?{$img_update_time}" />
<link rel="shortcut icon" type="image/x-icon" href="{$img_ps_dir}favicon.ico?{$img_update_time}" />
<script type="text/javascript">
			var baseDir = '{$content_dir}';
			var static_token = '{$static_token}';
			var token = '{$token}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
			var priceDisplayMethod = {$priceDisplay};
			var roundMode = {$roundMode};
</script>
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />
{/foreach}
{/if}
{if isset($js_files)}
	{foreach from=$js_files item=js_uri}
<script type="text/javascript" src="{$js_uri}"></script>
{/foreach}
{/if}
		{$HOOK_HEADER}
<script type="text/javascript" src="{$base_dir}js/jquery/jquery.cookie.js"></script>
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
<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} style="width:750px; background:none" align="left">
{if !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
{/if}
<div id="pageConf" style="width:750px" align="left">
<!-- Header -->

<!--END mainCategoryLinks -->
<div id="columns" style="width:750px" align="left" >
<!--START HOMEPAGE -->
<!--END HOMEPAGE -->
<!-- Left -->

<!-- Center -->
<div id="center_column" style="width:750px" align="left">
{/if} 
