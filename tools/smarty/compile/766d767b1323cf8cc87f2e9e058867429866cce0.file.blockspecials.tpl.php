<?php /* Smarty version Smarty-3.0.7, created on 2011-12-17 16:39:49
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/blockspecials/blockspecials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2484204544eecf005d124e2-72182617%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '766d767b1323cf8cc87f2e9e058867429866cce0' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/blockspecials/blockspecials.tpl',
      1 => 1324068668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2484204544eecf005d124e2-72182617',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.date_format.php';
?>

<!-- MODULE Block specials -->
<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('prices-drop.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockspecials'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockspecials'),$_smarty_tpl);?>
</a></h4>
	<div class="block_content">

<?php if ($_smarty_tpl->getVariable('special')->value){?>
		<ul class="products">
			<li class="product_image">
				<a href="<?php echo $_smarty_tpl->getVariable('special')->value['link'];?>
"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('special')->value['link_rewrite'],$_smarty_tpl->getVariable('special')->value['id_image'],'medium');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('special')->value['legend'],'html','UTF-8');?>
" height="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['height'];?>
" width="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['width'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('special')->value['name'],'html','UTF-8');?>
" /></a>
			</li>
			<li>

				<h5><a href="<?php echo $_smarty_tpl->getVariable('special')->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('special')->value['name'],'html','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('special')->value['name'],'html','UTF-8');?>
</a></h5>
				<span class="price-discount"><?php if (!$_smarty_tpl->getVariable('priceDisplay')->value){?><?php echo Product::displayWtPrice(array('p'=>$_smarty_tpl->getVariable('special')->value['price_without_reduction']),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::displayWtPrice(array('p'=>$_smarty_tpl->getVariable('priceWithoutReduction_tax_excl')->value),$_smarty_tpl);?>
<?php }?></span>
    			<?php if ($_smarty_tpl->getVariable('special')->value['specific_prices']){?>
        			<?php $_smarty_tpl->tpl_vars['specific_prices'] = new Smarty_variable($_smarty_tpl->getVariable('special')->value['specific_prices'], null, null);?>
        			<?php if ($_smarty_tpl->getVariable('specific_prices')->value['reduction_type']=='percentage'&&($_smarty_tpl->getVariable('specific_prices')->value['from']==$_smarty_tpl->getVariable('specific_prices')->value['to']||(smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')<=$_smarty_tpl->getVariable('specific_prices')->value['to']&&smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')>=$_smarty_tpl->getVariable('specific_prices')->value['from']))){?>
	        			<span class="reduction">(-<?php echo $_smarty_tpl->getVariable('specific_prices')->value['reduction']*floatval(100);?>
%)</span>
	            	<?php }?>
	            <?php }?>
				<span class="price"><?php if (!$_smarty_tpl->getVariable('priceDisplay')->value){?><?php echo Product::displayWtPrice(array('p'=>$_smarty_tpl->getVariable('special')->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::displayWtPrice(array('p'=>$_smarty_tpl->getVariable('special')->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span>
			</li>
		</ul>
		<p>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('prices-drop.php');?>
" title="<?php echo smartyTranslate(array('s'=>'All specials','mod'=>'blockspecials'),$_smarty_tpl);?>
" class="button_large"><?php echo smartyTranslate(array('s'=>'All specials','mod'=>'blockspecials'),$_smarty_tpl);?>
</a>
		</p>
<?php }else{ ?>
		<p><?php echo smartyTranslate(array('s'=>'No specials at this time','mod'=>'blockspecials'),$_smarty_tpl);?>
</p>
<?php }?>
	</div>
</div>
<!-- /MODULE Block specials -->