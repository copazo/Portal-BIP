<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 08:50:26
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/./category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9329024194ef07682e6e101-43597977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd211ed0472b5080be48a02016778e82b95d78be7' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/./category-count.tpl',
      1 => 1323459428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9329024194ef07682e6e101-43597977',
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