{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 9140 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
pro:{$cookie->profile}<br>
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
            $('#cl_internet').show();
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
<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if}>
{if !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
<div id="restricted-country">
  <p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country}</span></p>
</div>
{/if}
<div id="page">
<!-- Header -->
<div id="header"> <a id="header_logo" href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}"> <img class="logo" src="{$img_ps_dir}logo.jpg?{$img_update_time}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" {if $logo_image_width}width="{$logo_image_width}"{/if} {if $logo_image_height}height="{$logo_image_height}" {/if} /> </a>
  <div id="slogan_store"> <a href="#" id="Banner"> <img src="{$base_dir}themes/ps_bip/img/img_slogan_header_bip_01.jpg" height="22" width="254" /></a> </div>
  <div id="link_marcas"> <a href="{$base_dir}manufacturer.php" id="todasmarcas">todas las marcas</a> | <a href="#" id="giftcard">giftcard</a> </div>
  <div id="header_right"> {$HOOK_TOP} </div>
  <div id="menu_tiendas">
    <ul class="tienda">
      <li id="t_internet" class="tienda_current"><a href="javascript:changeTab('t_internet');">Internet</a></li>
      <li id="t_tiendas" class="tienda"><a href="javascript:changeTab('t_tiendas');">Tiendas</a></li>
      <li id="t_usados" class="tienda"><a href="{$link->getURLSiteBase()}4017-usados/">Usados</a></li>
      <li id="t_mall" class="tienda"><a href="javascript:changeTab('t_mall');">Mall</a></li>

    {if $cookie->id_default_group == 2}
        <li id="t_mall" class="tienda"><a href="javascript:changeTab('t_distribuidor');">Distribuidor</a></li>
    {/if}

    </ul>
  </div>
	<script>changeTab($.cookie('bip_tab'));</script>
  <div id="topBanner"> <a href="#" id="Banner"> <img src="{$base_dir}themes/ps_bip/img/img_menu_tiendas.jpg" width="340" height="40"/>
  </a> </div>
</div>
<div class="mainCategoryLinks">
  <ul class="inlineMenu">
    <li class="n1"><a href="{$base_dir}364-computadores" name="Computadores" target="_self" id="Computadores"><span>Computadores</span></a></li>
    <li class="n2"><a href="{$base_dir}365-desktop" name="Desktop" target="_self" id="Desktop"><span>Desktop</span></a></li>
    <li class="n3"><a href="{$base_dir}366-fotografia-camaras" name="Fotografia / Camaras" target="_self" id="Fotografia / Camaras"><span>Fotograf&iacute;a / C&aacute;maras</span></a></li>
    <li class="n4"><a href="{$base_dir}367-conectividad" name="Conectividad" target="_self" id="Conectividad"><span>Conectividad</span></a></li>
    <li class="n5"><a href="{$base_dir}368-productividad-empresas" name="Productividad y Empresas" target="_self" id="Productividad y Empresas"><span>Productividad &amp; Empresas</span></a></li>
    <li class="n6"><a href="{$base_dir}369-video-display" name="Video / Display" target="_self" id="Video / Display"><span>Video / Display</span></a></li>
    <li class="n7"><a href="{$base_dir}370-seguridad" name="Seguridad" target="_self" id="Seguridad"><span>Seguridad</span></a></li>
    <li class="n8"><a href="{$base_dir}371-otros" name="Otros" target="_self" id="Otros"><span>Otros</span></a></li>
  </ul>
</div>
<!--END mainCategoryLinks -->
<div id="columns">

<!-- Left -->
<div id="left_column" class="column"> {$HOOK_LEFT_COLUMN} </div>
<!-- Center -->
<div id="center_column">
{/if} 
