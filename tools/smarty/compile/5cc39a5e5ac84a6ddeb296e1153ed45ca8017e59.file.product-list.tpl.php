<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 18:03:07
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/product-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12948871984ef2498b1f86a9-53221176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cc39a5e5ac84a6ddeb296e1153ed45ca8017e59' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/product-list.tpl',
      1 => 1324245809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12948871984ef2498b1f86a9-53221176',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<?php if (isset($_smarty_tpl->getVariable('products',null,true,false)->value)){?>
	<!-- Products list -->
	<ul id="product_list" class="clear">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']=-1;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
		<li class="ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['last']){?>last_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index']%2){?>alternate_item<?php }else{ ?>item<?php }?> clearfix">
			<div class="center_block">
				<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" class="product_img_link" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home');?>
"  alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['legend'],'htmlall','UTF-8');?>
" <?php if (isset($_smarty_tpl->getVariable('homeSize',null,true,false)->value)){?> width="<?php echo $_smarty_tpl->getVariable('homeSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('homeSize')->value['height'];?>
"<?php }?> /></a>
				<h3><?php if (isset($_smarty_tpl->tpl_vars['product']->value['new'])&&$_smarty_tpl->tpl_vars['product']->value['new']==1){?><span class="new"><?php echo smartyTranslate(array('s'=>'New'),$_smarty_tpl);?>
</span><?php }?><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],35,'...'),'htmlall','UTF-8');?>
</a></h3>
				<p class="product_desc">
Codigo BIP : <?php echo $_smarty_tpl->tpl_vars['product']->value["id_product"];?>
<BR>
P/N # <?php echo $_smarty_tpl->tpl_vars['product']->value['reference'];?>
 <BR>
</p>
				<?php if (isset($_smarty_tpl->getVariable('prod_features',null,true,false)->value[$_smarty_tpl->tpl_vars['product']->value["id_product"]])){?>
				<ul class="lista_atributo">
				<?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('prod_features')->value[$_smarty_tpl->tpl_vars['product']->value["id_product"]]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['iteration']++;
?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration']<5){?>
					<li class="lista_atributo"><span><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['feature']->value['name'],'htmlall','UTF-8');?>
:</span> <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['feature']->value['value'],'htmlall','UTF-8');?>
</li>
					<?php }?>
				<?php }} ?>
                <p class="encontraste"><a class="encontraste_link" href="#">Encontraste este producto m&aacute;s barato, &iquest;D&oacute;nde?</a></p>
                </ul>
				<?php }?>
			</div>																				 
			<div class="right_block">
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><span class="on_sale"><?php echo smartyTranslate(array('s'=>'On sale!'),$_smarty_tpl);?>
</span>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['product']->value['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['reduction']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><span class="discount"><?php echo smartyTranslate(array('s'=>'Reduced price!'),$_smarty_tpl);?>
</span><?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['online_only'])&&$_smarty_tpl->tpl_vars['product']->value['online_only']){?><span class="online_only"><?php echo smartyTranslate(array('s'=>'Online only!'),$_smarty_tpl);?>
</span><?php }?>
				<?php if ((!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value&&((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order'])))){?>
				<div>
					<span class="s_precio_tiendas" style="display: inline;">Precio Tienda: <?php echo Product::convertPrice(array('price'=>round(($_smarty_tpl->tpl_vars['product']->value['price']*100)/90)),$_smarty_tpl);?>
</span>
					<span class="s_precio_mall" style="display: inline;">Precio Mall: <?php echo Product::convertPrice(array('price'=>round(($_smarty_tpl->tpl_vars['product']->value['price']*100)/90)),$_smarty_tpl);?>
</span>
					<span class="s_precio_internet" style="display: inline;"><?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)){?><span class="price" style="display: inline;" id="precio-lista">Precio Lista: <?php if (!$_smarty_tpl->getVariable('priceDisplay')->value){?><?php echo Product::convertPrice(array('price'=>round(($_smarty_tpl->tpl_vars['product']->value['price']*100)/90)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span><br /><span class="price" style="display: inline;" id="precio-internet">Precio M&iacute;nimo Internet:<br /><span class="price-internet-valor"> <?php if (!$_smarty_tpl->getVariable('priceDisplay')->value){?><?php echo Product::convertPrice(array('price'=>($_smarty_tpl->tpl_vars['product']->value['price'])),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span></span><?php }?></span>
					

                                        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)){?><span class="availability"><?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?><?php echo smartyTranslate(array('s'=>'Available'),$_smarty_tpl);?>
<?php }elseif((isset($_smarty_tpl->tpl_vars['product']->value['quantity_all_versions'])&&$_smarty_tpl->tpl_vars['product']->value['quantity_all_versions']>0)){?><?php echo smartyTranslate(array('s'=>'Product available with different options'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);?>
<?php }?></span><?php }?>
				</div>
				<script>changeTab($.cookie('bip_tab'));</script>	
				<?php }?>
				<?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->getVariable('add_prod_display',null,true,false)->value)&&($_smarty_tpl->getVariable('add_prod_display')->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
					<?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?>
						<!-- agregado por darayaz -->
						<form id="buy_block" <?php if ($_smarty_tpl->getVariable('PS_CATALOG_MODE')->value&&!isset($_smarty_tpl->getVariable('groups',null,true,false)->value)&&$_smarty_tpl->getVariable('product')->value->quantity>0){?>class="hidden"<?php }?> action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php');?>
" method="post">
				
							<!-- hidden datas -->
							<p class="hidden">
								<input type="hidden" name="token" value="<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
" />
								<input type="hidden" name="id_product" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" id="product_page_product_id" />
								<input type="hidden" name="add" value="1" />
								<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
							</p>

							<!-- quantity wanted allow_oosp <?php echo $_smarty_tpl->getVariable('allow_oosp')->value;?>
 product_quantity <?php echo $_smarty_tpl->getVariable('product')->value->quantity;?>
 virtual <?php echo $_smarty_tpl->getVariable('virtual')->value;?>
 available <?php echo $_smarty_tpl->getVariable('product')->value->available_for_order;?>
 -->
							<p id="quantity_wanted_p"<?php if ((!$_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('allow_oosp')->value]&&$_smarty_tpl->tpl_vars['product']->value['quantity']<=0)||!$_smarty_tpl->tpl_vars['product']->value['available_for_order']||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?> style="display: none;"<?php }?>>
								<label><?php echo smartyTranslate(array('s'=>'Cantidad :'),$_smarty_tpl);?>
</label>
								<input type="text" name="qty" id="quantity_wanted" class="text" value="<?php if (isset($_smarty_tpl->getVariable('quantityBackup',null,true,false)->value)){?><?php echo intval($_smarty_tpl->getVariable('quantityBackup')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']>1){?><?php echo $_smarty_tpl->tpl_vars['product']->value['minimal_quantity'];?>
<?php }else{ ?>1<?php }?><?php }?>" size="2" maxlength="3" <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']>1){?>onkeyup="checkMinimalQuantity(<?php echo $_smarty_tpl->tpl_vars['product']->value['minimal_quantity'];?>
);"<?php }?> />
							</p>
				
							<!-- minimal quantity wanted -->
							<p id="minimal_quantity_wanted_p"<?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1||!$_smarty_tpl->tpl_vars['product']->value['available_for_order']||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?> style="display: none;"<?php }?>><?php echo smartyTranslate(array('s'=>'You must add '),$_smarty_tpl);?>
<b id="minimal_quantity_label"><?php echo $_smarty_tpl->getVariable('product')->value->minimal_quantity;?>
</b><?php echo smartyTranslate(array('s'=>' as a minimum quantity to buy this product.'),$_smarty_tpl);?>
</p>
							<?php if ($_smarty_tpl->getVariable('product')->value->minimal_quantity>1){?>
							<script type="text/javascript">
								checkMinimalQuantity();
							</script>
							<?php }?>
							<p<?php if ((!$_smarty_tpl->tpl_vars['product']->value['allow_oosp']&&$_smarty_tpl->tpl_vars['product']->value['quantity']<=0)||!$_smarty_tpl->tpl_vars['product']->value['available_for_order']||(isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value)||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?> style="display: none;"<?php }?> id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="<?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
" class="exclusive" /></p>
							<!-- 
							<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php');?>
?add&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php if (isset($_smarty_tpl->getVariable('static_token',null,true,false)->value)){?>&amp;token=<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
<?php }?>&amp;qty=<script>document.write($("#quantity_wanted").val());</script>" title="<?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</a>
							 -->
						 </form>
					<?php }else{ ?>
							<span class="exclusive"><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</span>
					<?php }?>
				<?php }?>
				<!-- <a class="button" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'View'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'View'),$_smarty_tpl);?>
</a> -->
				<?php if (isset($_smarty_tpl->getVariable('comparator_max_item',null,true,false)->value)&&$_smarty_tpl->getVariable('comparator_max_item')->value){?>
					<p class="compare"><input type="checkbox" class="comparator" id="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" value="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" <?php if (isset($_smarty_tpl->getVariable('compareProducts',null,true,false)->value)&&in_array($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->getVariable('compareProducts')->value)){?>checked<?php }?>/> <label for="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><?php echo smartyTranslate(array('s'=>'Select to compare'),$_smarty_tpl);?>
</label></p>
				<?php }?>
			</div>
		</li>
	<?php }} ?>
	</ul>
	<!-- /Products list -->
<?php }?>