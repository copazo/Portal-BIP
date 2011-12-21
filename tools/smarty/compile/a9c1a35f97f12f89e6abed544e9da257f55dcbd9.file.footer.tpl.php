<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 08:50:27
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:378055604ef076836a26b6-44286629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9c1a35f97f12f89e6abed544e9da257f55dcbd9' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/footer.tpl',
      1 => 1324321228,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '378055604ef076836a26b6-44286629',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


		<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
				</div>

<!-- Right -->
				<div id="right_column" class="column">
					<?php echo $_smarty_tpl->getVariable('HOOK_RIGHT_COLUMN')->value;?>

				</div>
			</div>
			<div id="advertising_footer_block" class="advertising_footer_block" > 
            
                <ul class="links_banner">
                  <li><a href="#" target="_self"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/banner_footer_bip_01.jpg" alt="Banner 01"></a></li>
                  <li><a href="#" target="_self"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/banner_footer_bip_02.jpg" alt="Banner 02"></a></li>
                  <li><a href="#" target="_self"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/banner_footer_bip_03.jpg" alt="Banner 03"></a></li>
                  <li class="last"><a href="#" target="_self"><img src="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
themes/ps_bip/img/banner_footer_bip_04.jpg" alt="Banner 04"></a></li>
                </ul>
            
             </div>
<!-- Footer -->
			<div id="footer"><?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>
</div>
		</div>
	<?php }?>
	</body>
</html>
