<?php /* Smarty version Smarty-3.0.7, created on 2011-12-07 17:15:04
         compiled from "/home/exeweb/test.exe.cl/exeBIPdev/themes/prestashop/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2801763814edfc948ed1017-36861499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5820f383948c386b2e5c4f2f1092d43c2b0b9726' => 
    array (
      0 => '/home/exeweb/test.exe.cl/exeBIPdev/themes/prestashop/category-count.tpl',
      1 => 1315963348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2801763814edfc948ed1017-36861499',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php if ($_smarty_tpl->getVariable('category')->value->id==1||$_smarty_tpl->getVariable('nb_products')->value==0){?><?php echo smartyTranslate(array('s'=>'There are no products.'),$_smarty_tpl);?>

<?php }else{ ?>
	<?php if ($_smarty_tpl->getVariable('nb_products')->value==1){?><?php echo smartyTranslate(array('s'=>'There is'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'There are'),$_smarty_tpl);?>
<?php }?>
	<?php echo $_smarty_tpl->getVariable('nb_products')->value;?>

	<?php if ($_smarty_tpl->getVariable('nb_products')->value==1){?><?php echo smartyTranslate(array('s'=>'product.'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'products.'),$_smarty_tpl);?>
<?php }?>
<?php }?>