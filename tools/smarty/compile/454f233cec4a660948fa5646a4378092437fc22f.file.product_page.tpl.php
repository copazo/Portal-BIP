<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 17:21:01
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/sendtoafriend/product_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19789437094ef23fade052d4-07521511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '454f233cec4a660948fa5646a4378092437fc22f' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/sendtoafriend/product_page.tpl',
      1 => 1324068662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19789437094ef23fade052d4-07521511',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<li><a href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
sendtoafriend-form.php?id_product=<?php echo intval($_GET['id_product']);?>
"><?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</a></li>
