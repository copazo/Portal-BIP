<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 18:01:52
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/blockcms/blockcms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7747775024ef24940259824-17715148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98d6975953019b7b207634c804f69cce47878eb1' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/blockcms/blockcms.tpl',
      1 => 1324351237,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7747775024ef24940259824-17715148',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<?php if ($_smarty_tpl->getVariable('block')->value==1){?>
	<!-- Block CMS module -->
	<?php  $_smarty_tpl->tpl_vars['cms_title'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['cms_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cms_titles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cms_title']->key => $_smarty_tpl->tpl_vars['cms_title']->value){
 $_smarty_tpl->tpl_vars['cms_key']->value = $_smarty_tpl->tpl_vars['cms_title']->key;
?>
		<div id="informations_block_left_<?php echo $_smarty_tpl->tpl_vars['cms_key']->value;?>
" class="block informations_block_left">
			<h4><a href="<?php echo $_smarty_tpl->tpl_vars['cms_title']->value['category_link'];?>
"><?php if (!empty($_smarty_tpl->tpl_vars['cms_title']->value['name'])){?><?php echo $_smarty_tpl->tpl_vars['cms_title']->value['name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['cms_title']->value['category_name'];?>
<?php }?></a></h4>
			<ul class="block_content">
				<?php  $_smarty_tpl->tpl_vars['cms_page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms_title']->value['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->key => $_smarty_tpl->tpl_vars['cms_page']->value){
?>
					<?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])){?><li class="bullet"><b style="margin-left:2em;">
					<a href="<?php echo $_smarty_tpl->tpl_vars['cms_page']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cms_page']->value['name'],'html','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cms_page']->value['name'],'html','UTF-8');?>
</a>
					</b></li><?php }?>
				<?php }} ?>
				<?php  $_smarty_tpl->tpl_vars['cms_page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms_title']->value['cms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->key => $_smarty_tpl->tpl_vars['cms_page']->value){
?>
					<?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])){?><li><a href="<?php echo $_smarty_tpl->tpl_vars['cms_page']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'],'html','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'],'html','UTF-8');?>
</a></li><?php }?>
				<?php }} ?>
				<?php if ($_smarty_tpl->tpl_vars['cms_title']->value['display_store']){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('stores.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li><?php }?>
			</ul>
		</div>
	<?php }} ?>
	<!-- /Block CMS module -->
<?php }else{ ?>
	<!-- MODULE Block footer -->
<!--	<ul class="block_various_links" id="block_various_links_footer">
		<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><li class="first_item"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('prices-drop.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li><?php }?>
		<li class="<?php if ($_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>first_<?php }?>item"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('new-products.php');?>
" title="<?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li>
		<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><li class="item"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('best-sales.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if ($_smarty_tpl->getVariable('display_stores_footer')->value){?><li class="item"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('stores.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li><?php }?>
		<li class="item"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('contact-form.php',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>
</a></li>
		<?php  $_smarty_tpl->tpl_vars['cmslink'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cmslinks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cmslink']->key => $_smarty_tpl->tpl_vars['cmslink']->value){
?>
			<?php if ($_smarty_tpl->tpl_vars['cmslink']->value['meta_title']!=''){?>
				<li class="item"><a href="<?php echo addslashes($_smarty_tpl->tpl_vars['cmslink']->value['link']);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'htmlall','UTF-8');?>
</a></li>
			<?php }?>
		<?php }} ?>
		<?php if ($_smarty_tpl->getVariable('display_poweredby')->value){?><li class="last_item"><?php echo smartyTranslate(array('s'=>'Powered by','mod'=>'blockcms'),$_smarty_tpl);?>
 <a href="http://www.prestashop.com">PrestaShop</a>&trade;</li><?php }?>
	</ul>-->
	<!-- /MODULE Block footer -->
	<div class="block_various_links" id="block_various_links_footer">
        <ul class="customerService">
          <li><a href="#" target="_self">Entrega</a></li>
          <li><a href="#" target="_self">Aviso Legal</a></li>
          <li><a href="#" target="_self">Condiciones de Uso</a></li>
          <li><a href="#" target="_self">Nuestra Empresa</a></li>
          <li><a href="#" target="_self">Formas de Pago</a></li>
          <li><a href="#" target="_self">Nuestras Sucursales</a></li>
          <li><a href="#" target="_self">P&oacute;liza de Garant&iacute;a</a></li>
        </ul>
        <ul class="international">
          <li><a href="#" target="_self">Lista de Precios (PDF)</a></li>
          <li><a href="#" target="_self">Cont&aacute;ctenos</a></li>
          <li><a href="#" target="_self">Soporte</a></li>
          <li><a href="http://demo.exe.cl/exeBIPdev/modules/blockconfigurador/configuradorMain.php" target="_self">Configurador de PC</a></li>
          <li><a href="#" target="_self">Ofertas de Trabajo</a></li>
          <li><a href="#" target="_self">Revisar Pedidos</a></li>
          <li><a href="#" target="_self">Mapa del Sitio</a></li>
        </ul>
        <ul class="aboutBH">
          <li>NEWSLETTER Y PROMOCIONES</li>
          <li class="informese">Inf&oacute;rmese sobre nuestros productos y promociones. Suscr&iacute;base a nuestro bolet&iacute;n.</li>
          <li>
          
          <!-- Block Newsletter module-->
            <div class="block_content">
            
            <form action="/tienda/" method="post">
                     <input style="width:150px; float:left; margin-right:5px;" type="text" name="email" size="18" value="su email" onfocus="javascript:if(this.value=='su email')this.value='';" onblur="javascript:if(this.value=='')this.value='Email';" />
               
                        <!--<select name="action" style="width:100px; float:left;">
                           <option value="0" selected="selected">Suscribirse</option>
                           <option value="1">Borrarse</option>
                        </select>-->
                        <input type="submit" value="enviar" class="button_mini" name="submitNewsletter" />
            
                  
                  </form>

            </div>
          <!-- /Block Newsletter module-->

          </li>
             	  <li class="facebook"><a class="facebook" href="#" alt="Facebook" target="blank"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/icono_facebook_redes_sociales_footer.gif" alt="Facebook" height="21" width="133"></a></li>
    <li class="twitter"><a class="twitter" href="#" alt="Twitter" target="blank"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/icono_twitter_redes_sociales_footer.gif" alt="Twitter" height="21" width="133"></a></li>
        </ul>
        <ul class="resources">
          <li>BIP COMPUTER STORE</li>
          <li>T&eacute;lefono: [562] 570 7000</li>
          <li>Email: <a href="mailto:ventas@bip.cl">ventas@bip.cl</a></li>
          <li class="direccion">Av. Francisco Bilbao 2296, Providencia, Santiago.</li>
          <li class="problema_web">Si encontraste alg&uacute;n problema en la p&aacute;gina, por favor, avisa a <a href="mailto:webmaster@bip.cl">webmaster@bip.cl</a></li>
          <li class="formas_pago"><a href="#" target="_self"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/img_forma_pago_01.gif" alt="Formas de Pago"></a></li>
        </ul>
      </div>
<?php }?>
