<?php /* Smarty version Smarty-3.0.7, created on 2011-12-18 18:24:19
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/prestashop/./category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16048872134eee5a03936fd7-88656929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '360b7aead3cfa5a977eecbc8d55dd2b73c48c93c' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/prestashop/./category-count.tpl',
      1 => 1324072343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16048872134eee5a03936fd7-88656929',
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