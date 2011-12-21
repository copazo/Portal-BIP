<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 00:26:22
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/comparadordeprecios/comparadordeprecios.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1573120984ef0005e3c1938-64617550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9451d2e26f874dc697ae87746165b2b87689e9a2' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/comparadordeprecios/comparadordeprecios.tpl',
      1 => 1324074310,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1573120984ef0005e3c1938-64617550',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'Comparador de precios','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<!--<h1><?php echo smartyTranslate(array('s'=>'Si encontraste este articulo mas barato en otra tienda, dinos donde.'),$_smarty_tpl);?>
</h1>-->

<p class="bold"><?php echo smartyTranslate(array('s'=>'Si encontraste este articulo mas barato en otra tienda, dinos donde.','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
.</p>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php if (isset($_GET['submited'])){?>
	<p class="success"><?php echo smartyTranslate(array('s'=>'Los datos se han enviado correctamente','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
</p>
<?php }else{ ?>
	<form method="post" action="<?php echo $_smarty_tpl->getVariable('request_uri')->value;?>
" class="std">
		<fieldset>
			<h3><?php echo smartyTranslate(array('s'=>'Informacion del producto','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
</h3>

			<p class="align_center">
				<a href="<?php echo $_smarty_tpl->getVariable('productLink')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('cover')->value['id_image'],'small');?>
" alt="" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('cover')->value['legend'],'htmlall','UTF-8');?>
" /></a><br/>
				<a href="<?php echo $_smarty_tpl->getVariable('productLink')->value;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8');?>
</a>
			</p>

			<p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;"><?php echo smartyTranslate(array('s'=>'URL','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
</label>
				<input type="text" id="dacoURL" name="dacoURL" value="<?php if (isset($_POST['dacoURL'])){?><?php echo stripslashes(smarty_modifier_escape($_POST['dacoURL'],'htmlall','UTF-8'));?>
<?php }?>" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:400px; border:1px solid #039"  />
			</p>
            <p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
</label>
				<input type="text" id="dacoEmail" name="dacoEmail" value="<?php if (isset($_POST['dacoEmail'])){?><?php echo stripslashes(smarty_modifier_escape($_POST['dacoEmail'],'htmlall','UTF-8'));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('email')->value;?>
<?php }?>" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:150px; border:1px solid #039" />
			</p>
			<p class="submit" style="float:right;">
				<input type="submit" name="submitSendURL" value="<?php echo smartyTranslate(array('s'=>'Enviar','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
" class="button" />
			</p>
		</fieldset>
        <input type="hidden" id="dacoBip" name="dacoBip" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" />
        <input type="hidden" id="dacoUsuario" name="dacoUsuario" value="<?php if (isset($_POST['dacoUsuario'])){?><?php echo stripslashes(smarty_modifier_escape($_POST['dacoUsuario'],'htmlall','UTF-8'));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('tipoUsuario')->value;?>
<?php }?>" />
	</form>
<?php }?>

<ul class="footer_links">
	<li><a href="<?php echo $_smarty_tpl->getVariable('productLink')->value;?>
" class="button_large"><?php echo smartyTranslate(array('s'=>'Regresar','mod'=>'comparadordeprecios'),$_smarty_tpl);?>
</a></li>
</ul>