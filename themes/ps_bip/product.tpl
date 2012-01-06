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
*  @version  Release: $Revision: 8910 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{include file="$tpl_dir./errors.tpl"}
{if $errors|@count == 0}
<script type="text/javascript">
// <![CDATA[

// PrestaShop internal settings
var currencySign = '{$currencySign|html_entity_decode:2:"UTF-8"}';
var currencyRate = '{$currencyRate|floatval}';
var currencyFormat = '{$currencyFormat|intval}';
var currencyBlank = '{$currencyBlank|intval}';
var taxRate = {$tax_rate|floatval};
var jqZoomEnabled = {if $jqZoomEnabled}true{else}false{/if};

//JS Hook
var oosHookJsCodeFunctions = new Array();

// Parameters
var id_product = '{$product->id|intval}';
var productHasAttributes = {if isset($groups)}true{else}false{/if};
var quantitiesDisplayAllowed = {if $display_qties == 1}true{else}false{/if};
var quantityAvailable = {if $display_qties == 1 && $product->quantity}{$product->quantity}{else}0{/if};
var allowBuyWhenOutOfStock = {if $allow_oosp == 1}true{else}false{/if};
var availableNowValue = '{$product->available_now|escape:'quotes':'UTF-8'}';
var availableLaterValue = '{$product->available_later|escape:'quotes':'UTF-8'}';
var productPriceTaxExcluded = {$product->getPriceWithoutReduct(true)|default:'null'} - {$product->ecotax};
var reduction_percent = {if $product->specificPrice AND $product->specificPrice.reduction AND $product->specificPrice.reduction_type == 'percentage'}{$product->specificPrice.reduction*100}{else}0{/if};
var reduction_price = {if $product->specificPrice AND $product->specificPrice.reduction AND $product->specificPrice.reduction_type == 'amount'}{$product->specificPrice.reduction}{else}0{/if};
var specific_price = {if $product->specificPrice AND $product->specificPrice.price}{$product->specificPrice.price}{else}0{/if};
var specific_currency = {if $product->specificPrice AND $product->specificPrice.id_currency}true{else}false{/if};
var group_reduction = '{$group_reduction}';
var default_eco_tax = {$product->ecotax};
var ecotaxTax_rate = {$ecotaxTax_rate};
var currentDate = '{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}';
var maxQuantityToAllowDisplayOfLastQuantityMessage = {$last_qties};
var noTaxForThisProduct = {if $no_tax == 1}true{else}false{/if};
var displayPrice = {$priceDisplay};
var productReference = '{$product->reference|escape:'htmlall':'UTF-8'}';
var productAvailableForOrder = {if (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE}'0'{else}'{$product->available_for_order}'{/if};
var productShowPrice = '{if !$PS_CATALOG_MODE}{$product->show_price}{else}0{/if}';
var productUnitPriceRatio = '{$product->unit_price_ratio}';
var idDefaultImage = {if isset($cover.id_image_only)}{$cover.id_image_only}{else}0{/if};

// Customizable field
var img_ps_dir = '{$img_ps_dir}';
var customizationFields = new Array();
{assign var='imgIndex' value=0}
{assign var='textFieldIndex' value=0}
{foreach from=$customizationFields item='field' name='customizationFields'}
	{assign var="key" value="pictures_`$product->id`_`$field.id_customization_field`"}
	customizationFields[{$smarty.foreach.customizationFields.index|intval}] = new Array();
	customizationFields[{$smarty.foreach.customizationFields.index|intval}][0] = '{if $field.type|intval == 0}img{$imgIndex++}{else}textField{$textFieldIndex++}{/if}';
	customizationFields[{$smarty.foreach.customizationFields.index|intval}][1] = {if $field.type|intval == 0 && isset($pictures.$key) && $pictures.$key}2{else}{$field.required|intval}{/if};
{/foreach}

// Images
var img_prod_dir = '{$img_prod_dir}';
var combinationImages = new Array();

{if isset($combinationImages)}
	{foreach from=$combinationImages item='combination' key='combinationId' name='f_combinationImages'}
		combinationImages[{$combinationId}] = new Array();
		{foreach from=$combination item='image' name='f_combinationImage'}
			combinationImages[{$combinationId}][{$smarty.foreach.f_combinationImage.index}] = {$image.id_image|intval};
		{/foreach}
	{/foreach}
{/if}

combinationImages[0] = new Array();
{if isset($images)}
	{foreach from=$images item='image' name='f_defaultImages'}
		combinationImages[0][{$smarty.foreach.f_defaultImages.index}] = {$image.id_image};
	{/foreach}
{/if}

// Translations
var doesntExist = '{l s='The product does not exist in this model. Please choose another.' js=1}';
var doesntExistNoMore = '{l s='This product is no longer in stock' js=1}';
var doesntExistNoMoreBut = '{l s='with those attributes but is available with others' js=1}';
var uploading_in_progress = '{l s='Uploading in progress, please wait...' js=1}';
var fieldRequired = '{l s='Please fill in all required fields, then save the customization.' js=1}';

{if isset($groups)}
	// Combinations
	{foreach from=$combinations key=idCombination item=combination}
	

	if({$combination.list}==22)
	{assign var='precio_tienda' value=$combination.price}
	
	
		addCombination({$idCombination|intval}, new Array({$combination.list}), {$combination.quantity}, {$combination.price}, {$combination.ecotax}, {$combination.id_image}, '{$combination.reference|addslashes}', {$combination.unit_impact}, {$combination.minimal_quantity});
	{/foreach}
	// Colors
	{if $colors|@count > 0}
		{if $product->id_color_default}var id_color_default = {$product->id_color_default|intval};{/if}
	{/if}
{/if}
//]]>
</script>
{literal}
<script type="text/javascript">
// <![CDATA[
	var cuotas_abierto=false;
	function cambiarCuotas()
	{
		changeTab('t_tiendas');
		if(cuotas_abierto)
		{
			$('#cuotas').fadeOut();
			cuotas_abierto=false;
			changeTab('t_tiendas');
		}else
		{
                        
			$('#cuotas').fadeIn();
			cuotas_abierto=true;    
                            
		}
	}
	var precioProducto;
	function calculaCuotas(nCuotas)
	{
                if(nCuotas.value==0)
                    $('#valcuotas').text(formatCurrency);
                if(nCuotas.value==1)
                    $('#valcuotas').text(formatCurrency(Math.round((parseInt('{/literal}{$precio_tienda}{literal}')-(parseInt('{/literal}{$precio_tienda}{literal}'))*0.1)/nCuotas.value), currencyFormat, currencySign, currencyBlank));
                if(nCuotas.value==2)
                    $('#valcuotas').text(formatCurrency(Math.round((parseInt('{/literal}{$precio_tienda}{literal}')-(parseInt('{/literal}{$precio_tienda}{literal}'))*0.08)/nCuotas.value), currencyFormat, currencySign, currencyBlank));
                if(nCuotas.value==3)
                    $('#valcuotas').text(formatCurrency(Math.round((parseInt('{/literal}{$precio_tienda}{literal}')-(parseInt('{/literal}{$precio_tienda}{literal}'))*0.06)/nCuotas.value), currencyFormat, currencySign, currencyBlank));
                if(nCuotas.value==4)
                    $('#valcuotas').text(formatCurrency(Math.round((parseInt('{/literal}{$precio_tienda}{literal}')-(parseInt('{/literal}{$precio_tienda}{literal}'))*0.04)/nCuotas.value), currencyFormat, currencySign, currencyBlank));
                if(nCuotas.value==5)
                    $('#valcuotas').text(formatCurrency(Math.round((parseInt('{/literal}{$precio_tienda}{literal}')-(parseInt('{/literal}{$precio_tienda}{literal}'))*0.02)/nCuotas.value), currencyFormat, currencySign, currencyBlank));
                if(nCuotas.value==6)
                    $('#valcuotas').text(formatCurrency(('{/literal}{$precio_tienda}{literal}'/nCuotas.value), currencyFormat, currencySign, currencyBlank));    
        }
	//]]>
</script>
{/literal}
{include file="$tpl_dir./breadcrumb.tpl"}
<div id="global_block" class="clearfix">
<div id="primary_block" class="clearfix">

	{if isset($adminActionDisplay) && $adminActionDisplay}
	<div id="admin-action">
		<p>{l s='This product is not visible to your customers.'}
		<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
		<input type="submit" value="{l s='Publish'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad}', 0)"/>
		<input type="submit" value="{l s='Back'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad}', 1)"/>
		</p>
		<div class="clear" ></div>
		<p id="admin-action-result"></p>
		</p>
	</div>
	{/if}

	{if isset($confirmation) && $confirmation}
	<p class="confirmation">
		{$confirmation}
	</p>
	{/if}

	<!-- right infos-->
	<div id="pb-right-column">
		<!-- product img-->
		<div id="image-block">
		{if $have_image}
			<img src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large')}"
				{if $jqZoomEnabled}class="jqzoom" alt="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox')}"{else} title="{$product->name|escape:'htmlall':'UTF-8'}" alt="{$product->name|escape:'htmlall':'UTF-8'}" {/if} id="bigpic" width="{$largeSize.width}" height="{$largeSize.height}" />
		{else}
			<img src="{$img_prod_dir}{$lang_iso}-default-large.jpg" id="bigpic" alt="" title="{$cover.legend|escape:'htmlall':'UTF-8'}" width="{$largeSize.width}" height="{$largeSize.height}" />
		{/if}
		</div>

		{if isset($images) && count($images) > 0}
		<!-- thumbnails -->
		<div id="views_block" {if isset($images) && count($images) < 2}class="hidden"{/if}>
		{if isset($images) && count($images) > 3}<span class="view_scroll_spacer"><a id="view_scroll_left" class="hidden" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">{l s='Previous'}</a></span>{/if}
		<div id="thumbs_list">
			<ul id="thumbs_list_frame">
				{if isset($images)}
					{foreach from=$images item=image name=thumbnails}
					{assign var=imageIds value="`$product->id`-`$image.id_image`"}
					<li id="thumbnail_{$image.id_image}">
						<a href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox')}" rel="other-views" class="thickbox {if $smarty.foreach.thumbnails.first}shown{/if}" title="{$image.legend|htmlspecialchars}">
							<img id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'medium')}" alt="{$image.legend|htmlspecialchars}" height="{$mediumSize.height}" width="{$mediumSize.width}" />
						</a>
					</li>
					{/foreach}
				{/if}
			</ul>
		</div>
		{if isset($images) && count($images) > 3}<a id="view_scroll_right" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">{l s='Next'}</a>{/if}
		</div>
		{/if}
		{if isset($images) && count($images) > 1}<p class="align_center clear"><span id="wrapResetImages" style="display: none;"><img src="{$img_dir}icon/cancel_16x18.gif" alt="{l s='Cancel'}" width="16" height="18"/> <a id="resetImages" href="{$link->getProductLink($product)}" onclick="$('span#wrapResetImages').hide('slow');return (false);">{l s='Display all pictures'}</a></span></p>{/if}
		<!-- usefull links-->
		<ul id="usefull_link_block">
			{if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
			<li><a href="javascript:print();">{l s='Print'}</a><br class="clear" /></li>
			{if $have_image && !$jqZoomEnabled}
			<li><span id="view_full_size" class="span_link">{l s='View full size'}</span></li>
			{/if}
		</ul>
	</div>

	<!-- left infos-->
	<div id="pb-left-column">


		{if isset($colors) && $colors}
		<!-- colors -->
		<div id="color_picker">
			<p>{l s='Pick a color:' js=1}</p>
			<div class="clear"></div>
			<ul id="color_to_pick_list">
			{foreach from=$colors key='id_attribute' item='color'}
				<li><a id="color_{$id_attribute|intval}" class="color_pick" style="background: {$color.value};" onclick="updateColorSelect({$id_attribute|intval});$('#wrapResetImages').show('slow');" title="{$color.name}">{if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}<img src="{$img_col_dir}{$id_attribute}.jpg" alt="{$color.name}" width="20" height="20" />{/if}</a></li>
			{/foreach}
			</ul>
			<div class="clear"></div>
		</div>
		{/if}

		{if ($product->show_price AND !isset($restricted_country_mode)) OR isset($groups) OR $product->reference OR (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
		<!-- add to cart form-->
		<form id="buy_block" {if $PS_CATALOG_MODE AND !isset($groups) AND $product->quantity > 0}class="hidden"{/if} action="{$link->getPageLink('cart.php')}" method="post">

			<!-- hidden datas -->
			<p class="hidden">
				<input type="hidden" name="token" value="{$static_token}" />
				<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
			</p>
			<h1>{$product->name|escape:'htmlall':'UTF-8'} (C&oacute;d. {$product->id|intval})</h1>
            <div id="contenedor1PP">
            <p class="atributos1">Código BIP: {$product->id|intval}</p>
            <!--<p style="float:left;" id="product_reference" class="atributos2" {if isset($groups) OR !$product->reference}style="display: none;"{/if}><label for="product_reference">{l s='Reference :'} </label>&nbsp;<span class="atributos2">{$product->reference|escape:'htmlall':'UTF-8'}</span></p>-->
            <p class="atributos2">PartNumber:{$product->reference}</p>
            </div>
			
                        {if $product->description_short}
                            <div id="short_description_content" class="rte align_justify">{$product->description_short}</div>
                        
                        {else}
                            {if $features}
                                    <!-- product's features -->
                                    <ul id="short_description_content" class="rte align_justify">
                                    {assign var='iter_f' value=0}
                                    {foreach from=$features item=feature name=i}
                                            {if  $iter_f++ < 20}
                                            {if  $feature.name!='Garantia'}
                                            <li>{$feature.value|escape:'htmlall':'UTF-8'}</li>
                                            {else}
                                                    {assign var='iter_f' value=$iter_f-1}
                                            {/if}
                                            {/if}
                                    {/foreach}
                                    {foreach from=$features item=feature name=i}
                                            {if  $feature.name=='Garantia'}
                                            <li><span>{$feature.name|escape:'htmlall':'UTF-8'}:</span> {$feature.value|escape:'htmlall':'UTF-8'}</li>
                                            {/if}
                                    {/foreach}
                                    </ul>
                            {/if}
                        {/if}    

			<!-- prices -->
            
			<!-- Aqui iba el div (con el if) de precio - copazo 1 -->
            
		</form>
{if $product->condition eq 'new'}

{if $product->show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
				<p class="price">
					{if !$priceDisplay || $priceDisplay == 2}
						{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, 2)}
						{assign var='productPriceWithoutRedution' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
					{elseif $priceDisplay == 1}
						{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, 2)}
						{assign var='productPriceWithoutRedution' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
					{/if}
					{if $product->specificPrice AND $product->specificPrice.reduction}
						<p id="old_price"><span class="bold">
						{if $priceDisplay >= 0 && $priceDisplay <= 2}
							{if $productPriceWithoutRedution > $productPrice}
								<span id="old_price_display">Precio Lista: {convertPrice price=$productPriceWithoutRedution}</span>
									{if $tax_enabled && $display_tax_label == 1}
										{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
									{/if}
							{/if}
						{/if}
						</span>
						</p>
	
					{/if}
					{if $product->on_sale}
						<img src="{$img_dir}onsale_{$lang_iso}.gif" alt="{l s='On sale'}" class="on_sale_img"/>
						<span class="on_sale">{l s='On sale!'}</span>
					{elseif $product->specificPrice AND $product->specificPrice.reduction AND $productPriceWithoutRedution > $productPrice}
						<span class="discount">{l s='Reduced price!'}</span>
					{/if}
<!--					<br />-->
					<!--
					<span class="precio_de_lista">
						<span id="precio_de_lista"></span>
							{if $tax_enabled  && ((isset($display_tax_label) && $display_tax_label == 1) OR !isset($display_tax_label))}
								{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
							{/if}
					</span>-->
					<span class="our_price_display">
					{if $priceDisplay >= 0 && $priceDisplay <= 2}
						<span id="our_price_display_internet" class="label_precio_pdirecta">Precio Transferencia Directa</br><span class="precio_pdirecta">{convertPrice price=$productPrice}</span></br>
                        <span id="our_price_display_credito" class="label_precio_pelectronico">Precio Pago Electrónico</br><span class="precio_pelectronico">{convertPrice price=($precio_tienda-round($precio_tienda*0.07))}</span></span></br>
                        <span id="precio-lista" style="display: inline;" class="label_precio_pnormal">Precio Normal</br><span class="precio_pnormal">{convertPrice price=$precio_tienda}</span></span></br>
						</span>
					<span id="our_price_display_tienda">
                    	<span id="our_price_display_contado" class="label_precio_pdirecta">Precio Contado</br><span class="precio_pdirecta">{convertPrice price=round($precio_tienda-($precio_tienda)/10)}</span></span></br>
                        <span id="our_price_display_credito" class="label_precio_pelectronico">Precio Pago Electrónico</br><span class="precio_pelectronico">{convertPrice price=($precio_tienda-round($precio_tienda*0.07))}</span></span></br>
					</span>
						
<!--							{if $tax_enabled  && ((isset($display_tax_label) && $display_tax_label == 1) OR !isset($display_tax_label))}
								{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
							{/if}-->
					{/if}
					</span>
					{if $priceDisplay == 2}
						<br />
						<span id="pretaxe_price"><span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL, 2)}</span>&nbsp;{l s='tax excl.'}</span>
					{/if}
					<br />
				</p>
				{if $product->specificPrice AND $product->specificPrice.reduction}
					<p id="old_price"><span class="bold">
					{if $priceDisplay >= 0 && $priceDisplay <= 2}
						{if $productPriceWithoutRedution > $productPrice}
							<span id="old_price_display">{convertPrice price=$productPriceWithoutRedution}</span>
								{if $tax_enabled && $display_tax_label == 1}
									{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
								{/if}
						{/if}
					{/if}
					</span>
					</p>

				{/if}
				{if $product->specificPrice AND $product->specificPrice.reduction_type == 'percentage'}
					<p id="reduction_percent">{l s='(price reduced by'} <span id="reduction_percent_display">{$product->specificPrice.reduction*100}</span> %{l s=')'}</p>
				{/if}
				{if $packItems|@count}
					<p class="pack_price">{l s='instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
					<br class="clear" />
				{/if}
				{if $product->ecotax != 0}
					<p class="price-ecotax">{l s='include'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for green tax'}
						{if $product->specificPrice AND $product->specificPrice.reduction}
						<br />{l s='(not impacted by the discount)'}
						{/if}
					</p>
				{/if}
				{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
				    {math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
					<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'htmlall':'UTF-8'}</p>
				{/if}
				{*close if for show price*}
			{/if}
			{if isset($groups)}
			<!-- attributes -->
			<!--<div id="attributes">
			
			{foreach from=$groups key=id_attribute_group item=group}
			{if $group.attributes|@count}
			<p>
				<label for="group_{$id_attribute_group|intval}">{$group.name|escape:'htmlall':'UTF-8'} :</label>
				{assign var="groupName" value="group_$id_attribute_group"}
				<select name="{$groupName}" id="group_{$id_attribute_group|intval}" onchange="javascript:findCombination();{if $colors|@count > 0}$('#wrapResetImages').show('slow');{/if};">
					{foreach from=$group.attributes key=id_attribute item=group_attribute}
						<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'htmlall':'UTF-8'}">{$group_attribute|escape:'htmlall':'UTF-8'}</option>
					{/foreach}
				</select>
			</p>
			{/if}
			{/foreach}
			
			</div>-->
			{/if}

			<!--	inicio - forma de pago - cheques	-->
			
			
			<div id="cuadroCuotas"><a style="cursor: pointer; cursor: hand; text-decoration:none;" onclick="changeTab('t_tiendas2');">Calcula tu cuota<img src="{$img_dir}calculator_edit.png" border="0" align="absmiddle" style="margin-left:7px;"></a>
			  <div id="cl_internet" class="forma_pago"></div>
				<div id="cl_tienda" class="forma_pago">
                    <div id="cuotas" style="display:none;" align="left">
                        <form name="frmCuotas">
                                <table width="140px" cellspacing="0" cellpadding="2" border="0">
                                    <tr>
                                        <td width="60px" class="labelCuotas">Cantidad</td>
                                        <td class="labelCuotas">Valor ($)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <select onchange="calculaCuotas(this)" id="cuota">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                         </select>
                                        </td>
                                        <td><div id="valcuotas">$ 0</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><img border="0" src="{$img_dir}tarjetas_cuotas_01.png" style="margin-top:7px;"></td>
                                    </tr>
                                </table>
                        </form>
                    </div>
				</div>
				<div id="cl_usados" class="forma_pago">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
								<tr height="22">
										<td width="*" align="left">&nbsp;&nbsp;&middot; Efectivo</td>
										<td width="140" align="left">&nbsp;</td>
								</tr>
								<tr height="22">
										<td width="*" align="left">&nbsp;&nbsp;&middot; Tarjetas de Cr&eacute;dito</td>
										<td width="140" align="left"><img border="0" src="{$img_dir}icono_tarjetas.gif"></td>
								</tr>
						</tbody>
				</table>
				</div>
				<div id="cl_mall" class="forma_pago">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
								<tr height="22">
										<td width="*" align="left">&nbsp;&nbsp;&middot; Efectivo</td>
										<td width="140" align="left">&nbsp;</td>
								</tr>
								<tr height="22">
										<td width="*" align="left">&nbsp;&nbsp;&middot; Tarjetas de Cr&eacute;dito</td>
										<td width="140" align="left"><img border="0" src="{$img_dir}icono_tarjetas.gif"></td>
								</tr>
						</tbody>
				</table>
				</div>
			 </div>



{/if}

{if $product->condition eq 'used'}


	<span class="our_price_display">

			<span id="our_price_display_internet" class="label_precio_pdirecta">Precio Cheque 30 Días</br><span class="precio_pdirecta">{convertPrice price=$productPrice}</span></br>
			</span>


{/if}


			{literal}
				<script>
				changeTab($.cookie('bip_tab'));
				$('#valcuotas').text(formatCurrency(('{/literal}{$precio_tienda}{literal}'), currencyFormat, currencySign, currencyBlank));
				$('#cuota').val(1);
				</script>
			{/literal}
			
			<!--	fin - forma de pago - cheques	-->
			
			<!-- quantity wanted -->
			
            <p id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) OR $virtual OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
				<label>{l s='Cantidad :'}</label>
				<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" size="2" maxlength="3" {if $product->minimal_quantity > 1}onkeyup="checkMinimalQuantity({$product->minimal_quantity});"{/if} />
			</p>

			<!-- minimal quantity wanted -->
			
            <p id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>{l s='You must add '} <b id="minimal_quantity_label">{$product->minimal_quantity}</b> {l s=' as a minimum quantity to buy this product.'}</p>
			{if $product->minimal_quantity > 1}
			<script type="text/javascript">
				checkMinimalQuantity();
			</script>
			{/if}


			<!-- number of item in stock -->
			
            {if ($display_qties == 1 && !$PS_CATALOG_MODE && $product->available_for_order)}
			<p id="pQuantityAvailable"{if $product->quantity <= 0} style="display: none;"{/if}>
				<span id="quantityAvailable">{$product->quantity|intval}</span>
				<span {if $product->quantity > 1} style="display: none;"{/if} id="quantityAvailableTxt">{l s='item in stock'}</span>
				<span {if $product->quantity == 1} style="display: none;"{/if} id="quantityAvailableTxtMultiple">{l s='items in stock'}</span>
			</p>
			{/if}

            <!-- Out of stock hook -->
			
            {if !$allow_oosp}
			<p id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
				{$HOOK_PRODUCT_OOS}
			</p>
			{/if}

			<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties OR $product->quantity <= 0) OR $allow_oosp OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if} >{l s='Warning: Last items in stock!'}</p>

			{if $product->online_only}
				<p>{l s='Online only'}</p>
			{/if}
			<p{if $product->available_for_order==0} style="display: none;"{/if} id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="{l s='Add to cart'}" class="exclusive" /></p>
			{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
			<div class="clear"></div>
			<!--<p class="encontraste"><a class="encontraste_link" href="#">Encontraste este producto m&aacute;s barato, &iquest;D&oacute;nde?</a></p>-->
		{/if}
		{if $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}

{if $product->supplier_reference != ''}
<p class="compare">
<a href="{$link_used|escape:'htmlall':'UTF-8'}"  target="_blank"><img src="../img/alert.png" width="32px" height="32px" ALIGN=MIDDLE />Homologo Usado </a>
</p>
{/if}
	</div>
</div>


{if $quantity_discounts}
<!-- quantity discount -->
<ul class="idTabs">
	<li><a style="cursor: pointer" class="selected">{l s='Quantity discount'}</a></li>
</ul>
<div id="quantityDiscount">
	<table class="std">
		<tr>
			{foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
				<th>{$quantity_discount.quantity|intval}
				{if $quantity_discount.quantity|intval > 1}
					{l s='quantities'}
				{else}
					{l s='quantity'}
				{/if}
				</th>
			{/foreach}
		</tr>
		<tr>
			{foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
				<td>
				{if $quantity_discount.price != 0 OR $quantity_discount.reduction_type == 'amount'}
					-{convertPrice price=$quantity_discount.real_value|floatval}
				{else}
					-{$quantity_discount.real_value|floatval}%
				{/if}
				</td>
			{/foreach}
		</tr>
	</table>
</div>
{/if}

{$HOOK_PRODUCT_FOOTER}

<!-- description and features -->
{if $product->description || $features || $accessories || $HOOK_PRODUCT_TAB || $attachments}
<div id="more_info_block" class="clear">
	<ul id="more_info_tabs" class="idTabs idTabsShort">
		{if $product->description}<li><a id="more_info_tab_more_info" href="#idTab1">{l s='More info'}</a></li>{/if}
		{if $features}<li><a id="more_info_tab_data_sheet" href="#idTab2">{l s='Data sheet'}</a></li>{/if}
		{if $attachments}<li><a id="more_info_tab_attachments" href="#idTab9">{l s='Download'}</a></li>{/if}
		{if isset($accessories) AND $accessories}<li><a href="#idTab4">{l s='Accessories'}</a></li>{/if}
		{$HOOK_PRODUCT_TAB}
	</ul>
	<div id="more_info_sheets" class="sheets align_justify">
	{if $product->description}
		<!-- full description -->
		<div id="idTab1" class="rte">{$product->description}</div>
	{/if}
	{if $features}
		<!-- product's features -->
		<ul id="idTab2" class="bullet">
		{foreach from=$features item=feature}
			<li><span>{$feature.name|escape:'htmlall':'UTF-8'}:</span> {$feature.value|escape:'htmlall':'UTF-8'}</li>
		{/foreach}
		</ul>
	{/if}
	{if $attachments}
		<ul id="idTab9" class="bullet">
		{foreach from=$attachments item=attachment}
			<li><a href="{$link->getPageLink('attachment.php', true)}?id_attachment={$attachment.id_attachment}">{$attachment.name|escape:'htmlall':'UTF-8'}</a><br />{$attachment.description|escape:'htmlall':'UTF-8'}</li>
		{/foreach}
		</ul>
	{/if}
	{if isset($accessories) AND $accessories}
		<!-- accessories -->
		<ul id="idTab4" class="bullet">
			<div class="block products_block accessories_block clearfix">
				<div class="block_content">
					<ul>
					{foreach from=$accessories item=accessory name=accessories_list}
						{assign var='accessoryLink' value=$link->getProductLink($accessory.id_product, $accessory.link_rewrite, $accessory.category)}
						<li class="ajax_block_product {if $smarty.foreach.accessories_list.first}first_item{elseif $smarty.foreach.accessories_list.last}last_item{else}item{/if} product_accessories_description">
							<h5><a href="{$accessoryLink|escape:'htmlall':'UTF-8'}">{$accessory.name|truncate:22:'...':true|escape:'htmlall':'UTF-8'}</a></h5>
							<div class="product_desc">
								<a href="{$accessoryLink|escape:'htmlall':'UTF-8'}" title="{$accessory.legend|escape:'htmlall':'UTF-8'}" class="product_image"><img src="{$link->getImageLink($accessory.link_rewrite, $accessory.id_image, 'medium')}" alt="{$accessory.legend|escape:'htmlall':'UTF-8'}" width="{$mediumSize.width}" height="{$mediumSize.height}" /></a>
								<a href="{$accessoryLink|escape:'htmlall':'UTF-8'}" title="{l s='More'}" class="product_description">{$accessory.description_short|strip_tags|truncate:70:'...'}</a>
							</div>
							<p class="product_accessories_price">
								{if $accessory.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}<span class="price">{if $priceDisplay != 1}{displayWtPrice p=$accessory.price}{else}{displayWtPrice p=$accessory.price_tax_exc}{/if}</span>{/if}
								<a class="button" href="{$accessoryLink|escape:'htmlall':'UTF-8'}" title="{l s='View'}">{l s='View'}</a>
								{if ($accessory.allow_oosp || $accessory.quantity > 0) AND $accessory.available_for_order AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
									<a class="exclusive button ajax_add_to_cart_button" href="{$link->getPageLink('cart.php')}?qty=1&amp;id_product={$accessory.id_product|intval}&amp;token={$static_token}&amp;add" rel="ajax_id_product_{$accessory.id_product|intval}" title="{l s='Add to cart'}">{l s='Add to cart'}</a>
								{else}
									<span class="exclusive">{l s='Add to cart'}</span>
									<span class="availability">{if (isset($accessory.quantity_all_versions) && $accessory.quantity_all_versions > 0)}{l s='Product available with different options'}{else}{l s='Out of stock'}{/if}</span>
								{/if}
							</p>
						</li>

					{/foreach}
					</ul>
				</div>
			</div>
		</ul>
	{/if}
	{$HOOK_PRODUCT_TAB_CONTENT}
	</div>
</div>
</div>
{/if}

<!-- Customizable products -->
{if $product->customizable}
	<ul class="idTabs">
		<li><a style="cursor: pointer">{l s='Product customization'}</a></li>
	</ul>
	<div class="customization_block">
		<form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm">
			<p>
				<img src="{$img_dir}icon/infos.gif" alt="Informations" />
				{l s='After saving your customized product, remember to add it to your cart.'}
				{if $product->uploadable_files}<br />{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
			</p>
			{if $product->uploadable_files|intval}
			<h2>{l s='Pictures'}</h2>
			<ul id="uploadable_files">
				{counter start=0 assign='customizationField'}
				{foreach from=$customizationFields item='field' name='customizationFields'}
					{if $field.type == 0}
						<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
							{if isset($pictures.$key)}<div class="customizationUploadBrowse">
									<img src="{$pic_dir}{$pictures.$key}_small" alt="" />
									<a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)}" title="{l s='Delete'}" >
										<img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" />
									</a>
								</div>{/if}
							<div class="customizationUploadBrowse"><input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="customization_block_input {if isset($pictures.$key)}filled{/if}" />{if $field.required}<sup>*</sup>{/if}
							<div class="customizationUploadBrowseDescription">{if !empty($field.name)}{$field.name}{else}{l s='Please select an image file from your hard drive'}{/if}</div></div>
						</li>
						{counter}
					{/if}
				{/foreach}
			</ul>
			{/if}
			<div class="clear"></div>
			{if $product->text_fields|intval}
			<h2>{l s='Texts'}</h2>
			<ul id="text_fields">
				{counter start=0 assign='customizationField'}
				{foreach from=$customizationFields item='field' name='customizationFields'}
					{if $field.type == 1}
						<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
							{if !empty($field.name)}{$field.name}{/if}{if $field.required}<sup>*</sup>{/if}<textarea type="text" name="textField{$field.id_customization_field}" id="textField{$customizationField}" rows="1" cols="40" class="customization_block_input" />{if isset($textFields.$key)}{$textFields.$key|stripslashes}{/if}</textarea>
						</li>
						{counter}
					{/if}
				{/foreach}
			</ul>
			{/if}
			<p style="clear: left;" id="customizedDatas">
				<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
				<input type="hidden" name="submitCustomizedDatas" value="1" />
				<input type="button" class="button" value="{l s='Save'}" onclick="javascript:saveCustomization()" />
				<span id="ajax-loader" style="display:none"><img src="{$img_ps_dir}loader.gif" alt="loader" /></span>
			</p>
		</form>
		<p class="clear required"><sup>*</sup> {l s='required fields'}</p>
	</div>
{/if}

{if $packItems|@count > 0}
	<div>
		<h2>{l s='Pack content'}</h2>
		{include file="$tpl_dir./product-list.tpl" products=$packItems}
	</div>
{/if}

{/if}

