<?php /* Smarty version Smarty-3.0.7, created on 2011-12-18 12:42:55
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/prestashop/./product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11292989664eee09ff4a2179-23963884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8408f5d261896a07215ef6a50a5a5e1044d4ec4' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/prestashop/./product-compare.tpl',
      1 => 1324072343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11292989664eee09ff4a2179-23963884',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if ($_smarty_tpl->getVariable('comparator_max_item')->value){?>
<script type="text/javascript">
// <![CDATA[
	var min_item = '<?php echo smartyTranslate(array('s'=>'Please select at least one product.','js'=>1),$_smarty_tpl);?>
';
	var max_item = "<?php echo smartyTranslate(array('s'=>'You cannot add more than','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->getVariable('comparator_max_item')->value;?>
 <?php echo smartyTranslate(array('s'=>'product(s) in the product comparator','js'=>1),$_smarty_tpl);?>
";
//]]>
</script>
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('products-comparison.php');?>
" onsubmit="true">
		<p>
		<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Compare'),$_smarty_tpl);?>
" style="float:right" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
		</p>
	</form>
<?php }?>

