<?php /* Smarty version Smarty-3.0.7, created on 2011-12-07 21:00:57
         compiled from "/home/exeweb/test.exe.cl/exeBIPdev/themes/prestashop/./product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17007636594edffe3915e6d5-69449428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ba26695c270a61da2a7cd64ad77da8904f399c' => 
    array (
      0 => '/home/exeweb/test.exe.cl/exeBIPdev/themes/prestashop/./product-compare.tpl',
      1 => 1319824212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17007636594edffe3915e6d5-69449428',
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

