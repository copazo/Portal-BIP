<?php /* Smarty version Smarty-3.0.7, created on 2011-12-18 18:24:20
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/prestashop/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11492070774eee5a04397284-96588372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e535efd0d392446ea1bc9745f58ce2ecebf94e2' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/prestashop/footer.tpl',
      1 => 1324072343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11492070774eee5a04397284-96588372',
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

<!-- Footer -->
			<div id="footer"><?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>
</div>
		</div>
	<?php }?>
	</body>
</html>
