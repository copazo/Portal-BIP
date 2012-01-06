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
*  @version  Release: $Revision: 8290 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($products)}
	<!-- Products list -->
	<ul id="product_list" class="clear">
	{foreach from=$products item=product name=products}
		<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % 2}alternate_item{else}item{/if} clearfix">
			<div class="center_block">
				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}"  alt="{$product.legend|escape:'htmlall':'UTF-8'}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} /></a>
				<h3>{if isset($product.new) && $product.new == 1}<span class="new">{l s='New'}</span>{/if}<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h3>
				<p class="product_desc">
Codigo BIP : {$product["id_product"]}<BR>
P/N # {$product.reference} <BR>
</p>
				{if isset($prod_features[$product["id_product"]])}
				<ul class="lista_atributo">
				{foreach from=$prod_features[$product["id_product"]] item=feature name=i}
					{if  $smarty.foreach.i.iteration < 5}
					<li class="lista_atributo">{$feature.value|escape:'htmlall':'UTF-8'}</li>
					{/if}
				{/foreach}
                <p class="encontraste"><a class="encontraste_link" href="#">Encontraste este producto m&aacute;s barato, &iquest;D&oacute;nde?</a></p>
                </ul>
				{/if}
			</div>																				 
			<div class="right_block">
				{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="on_sale">{l s='On sale!'}</span>
				{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="discount">{l s='Reduced price!'}</span>{/if}
				{if isset($product.online_only) && $product.online_only}<span class="online_only">{l s='Online only!'}</span>{/if}
				{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
				<div>

{if $product->condition eq 'new'}
					<span class="s_precio_tiendas" style="display: inline;">Precio Tienda: {convertPrice price=round(($product.price*100)/90)}</span>
					<span class="s_precio_mall" style="display: inline;">Precio Mall: {convertPrice price=round(($product.price*100)/90)}</span>
					<span class="s_precio_internet" style="display: inline;">{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price" style="display: inline;" id="precio-lista">Precio Lista: {if !$priceDisplay}{convertPrice price=round(($product.price*100)/90)}{else}{convertPrice price=$product.price_tax_exc}{/if}</span><br /><span class="price" style="display: inline;" id="precio-internet">Precio M&iacute;nimo Internet:<br /><span class="price-internet-valor"> {if !$priceDisplay}{convertPrice price=($product.price)}{else}{convertPrice price=$product.price_tax_exc}{/if}</span></span>{/if}</span>
{/if}	
{if $product->condition eq 'used'}
                                        <span class="s_precio_tiendas" style="display: inline;">Precio Cheque 30 Días: {convertPrice price=round(($product.price*100)/90)}</span>
{/if}	
                                        {if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}<span class="availability">{if ($product.allow_oosp || $product.quantity > 0)}{l s='Available'}{else}{l s='Out of stock'}{/if} </span> {else} <span class="availability"> {l s='Out of stock'} </span>{/if}
				</div>
				<script>changeTab($.cookie('bip_tab'));</script>	
				{/if}
				{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
					{if ($product.allow_oosp || $product.quantity > 0)}
						<!-- agregado por darayaz -->
						<form id="buy_block" {if $PS_CATALOG_MODE AND !isset($groups) AND $product->quantity > 0}class="hidden"{/if} action="{$link->getPageLink('cart.php')}" method="post">
				
							<!-- hidden datas -->
							<p class="hidden">
								<input type="hidden" name="token" value="{$static_token}" />
								<input type="hidden" name="id_product" value="{$product.id_product|intval}" id="product_page_product_id" />
								<input type="hidden" name="add" value="1" />
								<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
							</p>

							<!-- quantity wanted allow_oosp {$allow_oosp} product_quantity {$product->quantity} virtual {$virtual} available {$product->available_for_order} -->
							<p id="quantity_wanted_p"{if (!$product.$allow_oosp && $product.quantity <= 0) OR !$product.available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
								<label>{l s='Cantidad :'}</label>
								<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product.minimal_quantity > 1}{$product.minimal_quantity}{else}1{/if}{/if}" size="2" maxlength="3" {if $product.minimal_quantity > 1}onkeyup="checkMinimalQuantity({$product.minimal_quantity});"{/if} />
							</p>
				
							<!-- minimal quantity wanted -->
							<p id="minimal_quantity_wanted_p"{if $product.minimal_quantity <= 1 OR !$product.available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>{l s='You must add '}<b id="minimal_quantity_label">{$product->minimal_quantity}</b>{l s=' as a minimum quantity to buy this product.'}</p>
							{if $product->minimal_quantity > 1}
							<script type="text/javascript">
								checkMinimalQuantity();
							</script>
							{/if}
							<p{if (!$product.allow_oosp && $product.quantity <= 0) OR !$product.available_for_order OR (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE} style="display: none;"{/if} id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="{l s='Add to cart'}" class="exclusive" /></p>
							<!-- 
							<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart.php')}?add&amp;id_product={$product.id_product|intval}{if isset($static_token)}&amp;token={$static_token}{/if}&amp;qty=<script>document.write($("#quantity_wanted").val());</script>" title="{l s='Add to cart'}">{l s='Add to cart'}</a>
							 -->
						 </form>
					{else}
							
					{/if}
				{/if}
{if $product.available_for_order==0}<span class="exclusive">{l s='Add to cart'}</span>{/if}

{if $product.supplier_reference != ''}
<p class="compare">
<a href="{$product.link_used|escape:'htmlall':'UTF-8'}"  target="_blank"><img src="../img/alert.png" width="32px" height="32px" ALIGN=MIDDLE />Homologo Usado </a>
</p>
{/if}

				<!-- <a class="button" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{l s='View'}">{l s='View'}</a> -->
				{if isset($comparator_max_item) && $comparator_max_item}
					<p class="compare"><input type="checkbox" class="comparator" id="comparator_item_{$product.id_product}" value="comparator_item_{$product.id_product}" {if isset($compareProducts) && in_array($product.id_product, $compareProducts)}checked{/if}/> <label for="comparator_item_{$product.id_product}">{l s='Select to compare'}</label></p>
				{/if}
			</div>
		</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
{/if}