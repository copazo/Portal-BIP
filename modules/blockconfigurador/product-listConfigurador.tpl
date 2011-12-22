
{if isset($products)}
	<!-- Products list -->
	<ul id="product_list" class="clear" style="width:740px">
	{foreach from=$products item=product name=products}
		<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % 2}alternate_item{else}item{/if} clearfix">
			<div class="center_block">
				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" alt="{$product.legend|escape:'htmlall':'UTF-8'}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} /></a>
				<h3>{if isset($product.new) && $product.new == 1}<span class="new">{l s='Nuevo'}</span>{/if}<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h3>
				<p class="product_desc"><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.description_short|truncate:360:'...'|strip_tags:'UTF-8'|escape:'htmlall':'UTF-8'}">{$product.description_short|truncate:360:'...'|strip_tags:'UTF-8'}</a></p>
				{if isset($prod_features[$product["id_product"]])}
				<ul class="lista_atributo">
				{foreach from=$prod_features[$product["id_product"]] item=feature name=i}
					{if  $smarty.foreach.i.iteration < 5}
					<li class="lista_atributo"><span>{$feature.name|escape:'htmlall':'UTF-8'}:</span> {$feature.value|escape:'htmlall':'UTF-8'}</li>
					{/if}
				{/foreach}
				<li class="lista_atributo">P/N # {$product["reference"]} <span style="color:#D0D3D8;">|</span> C&oacute;digo Bip: {$product["id_product"]}</li>

                </ul>
				{/if}
			</div>																				 
			<div class="right_block">
				{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="on_sale">{l s='On sale!'}</span>
				{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="discount">{l s='Reduced price!'}</span>{/if}
				{if isset($product.online_only) && $product.online_only}<span class="online_only">{l s='Online only!'}</span>{/if}
				{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
				<div>
					{if isset($prod_combinations[$product["id_product"]]["Tiendas"]["price"])}<span class="s_precio_tiendas" style="display: inline;">Precio Tienda: {convertPrice price=$prod_combinations[$product["id_product"]]["Tiendas"]["price"]}</span><br />{/if}
					{if isset($prod_combinations[$product["id_product"]]["Mall"]["price"])}<span class="s_precio_mall" style="display: inline;">Precio Mall: {convertPrice price=$prod_combinations[$product["id_product"]]["Mall"]["price"]}</span><br />{/if}
					{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price" style="display: inline;" id="precio-lista">Precio de Lista: {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span><br /><span class="price" style="display: inline;" id="precio-internet">Precio M&iacute;nimo Internet:<br /><span class="price-internet-valor"> {if !$priceDisplay}{convertPrice price=($product.price*0.9)}{else}{convertPrice price=$product.price_tax_exc}{/if}</span></span>{/if}
				<!--	{if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}<span class="availability">{if ($product.allow_oosp || $product.quantity > 0)}{l s='Available'}{elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}{l s='Product available with different options'}{else}{l s='Out of stock'}{/if}</span>{/if} -->
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

							
				
							<!-- minimal quantity wanted -->
							<p id="minimal_quantity_wanted_p"{if $product.minimal_quantity <= 1 OR !$product.available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>{l s='You must add '}<b id="minimal_quantity_label">{$product->minimal_quantity}</b>{l s=' as a minimum quantity to buy this product.'}</p>
							{if $product->minimal_quantity > 1}
							<script type="text/javascript">
								checkMinimalQuantity();
							</script>
							{/if}
                            <p{if (!$product.allow_oosp && $product.quantity <= 0) OR !$product.available_for_order OR (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE} style="display: none;"{/if} id="add_to_cart" class="buttons_bottom_block"><input type="button" name="Submit" value="Seleccionar" class="exclusive" onclick="window.parent.document.getElementById('iframeConfigurador').contentWindow.seteandoValores('{addslashes($product.description_short)}', '{$product["id_product"]}', '{if !$priceDisplay}{($product.price*0.9)}{else}{$product.price_tax_exc}{/if}','{if !$priceDisplay}{$product.price}{else}{$product.price_tax_exc}{/if}');" /></p> 
						 </form>
					{else}
							<span class="exclusive">{l s='Add to cart'}</span>
					{/if}
				{/if}
								
			</div>
			</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
{/if}
