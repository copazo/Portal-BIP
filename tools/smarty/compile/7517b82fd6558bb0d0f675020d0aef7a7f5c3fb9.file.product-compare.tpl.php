<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 18:01:51
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/./product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19959204094ef2493f792ed8-29939805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7517b82fd6558bb0d0f675020d0aef7a7f5c3fb9' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/./product-compare.tpl',
      1 => 1323459428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19959204094ef2493f792ed8-29939805',
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
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('products-comparison.php',true);?>
" onsubmit="true">
		<p>
		<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Compare'),$_smarty_tpl);?>
" style="float:right" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
		</p>
	</form>
<?php }?>

