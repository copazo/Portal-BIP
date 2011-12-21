<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 08:50:26
         compiled from "/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20266132444ef07682a7e351-72933759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46d000b3475d5b26aeceb5ccdf959ede47a7beda' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/themes/ps_bip/category.tpl',
      1 => 1324343927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20266132444ef07682a7e351-72933759',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_smarty_tpl->tpl_vars['nolist'] = new Smarty_variable(1, null, null);?>
<?php if (isset($_smarty_tpl->getVariable('category',null,true,false)->value)){?>
	<?php if ($_smarty_tpl->getVariable('category')->value->id&&$_smarty_tpl->getVariable('category')->value->active){?>

		<h1>

			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name,'htmlall','UTF-8');?>
<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('categoryNameComplement')->value,'htmlall','UTF-8');?>
<span class="category-product-count"><?php if ($_smarty_tpl->getVariable('category')->value->level_depth!=1){?><?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./category-count.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php }?></span>
		</h1>

		<?php if ($_smarty_tpl->getVariable('scenes')->value){?>
			<!-- Scenes -->
			<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./scenes.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('scenes',$_smarty_tpl->getVariable('scenes')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<?php }else{ ?>
			<!-- Category image -->
			<?php if ($_smarty_tpl->getVariable('category')->value->id_image){?>
			<div class="align_center">
				<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getCatImageLink($_smarty_tpl->getVariable('category')->value->link_rewrite,$_smarty_tpl->getVariable('category')->value->id_image,'category');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name,'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name,'htmlall','UTF-8');?>
" id="categoryImage" width="<?php echo $_smarty_tpl->getVariable('categorySize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('categorySize')->value['height'];?>
" />
			</div>
			<?php }?>
		<?php }?>

		<?php if ($_smarty_tpl->getVariable('category')->value->description){?>
			<div class="cat_desc"><?php echo $_smarty_tpl->getVariable('category')->value->description;?>
</div>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('category')->value->id_category!=1){?>
		<script>$("#left_column").show();</script>
		<!--<script>$("#categories_block_left").hide();</script>-->
		<style>
			#category #center_column {
				height: auto;
				margin: 10px;
				width: 733px;
			}
			#subcategories {
				height: auto;
				width: 733px;
			}
			#category .breadcrumb {
				display:block;
			}
			#category h1 {
				display:block;
			}
/*			#subcategories {
				display: none;
			}*/
		</style>
        <?php }else{ ?>
		<script>$("#left_column").hide();</script>
		<?php }?>		
        

		<?php if (isset($_smarty_tpl->getVariable('subcategories',null,true,false)->value)){?>
		<!-- Subcategories -->
		<div id="subcategories">

			<h3><?php echo smartyTranslate(array('s'=>'Subcategories'),$_smarty_tpl);?>
</h3>
			<ul class="inline_list">
			<?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subcategories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value){
?>
                            <?php if ($_smarty_tpl->tpl_vars['subcategory']->value['level_depth']<3){?>
				<li>
					<a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subcategory']->value['name'],'htmlall','UTF-8');?>
">
						<?php if ($_smarty_tpl->tpl_vars['subcategory']->value['id_image']){?>
							<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getCatImageLink($_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite'],$_smarty_tpl->tpl_vars['subcategory']->value['id_image'],'category');?>
" alt="" width="<?php echo $_smarty_tpl->getVariable('categorySize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('categorySize')->value['height'];?>
" />
						<?php }else{ ?>
							<img src="<?php echo $_smarty_tpl->getVariable('img_cat_dir')->value;?>
default-medium.jpg" alt="" width="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['height'];?>
" />
						<?php }?>
					</a><br />
					<?php $_smarty_tpl->tpl_vars['iter_c'] = new Smarty_variable(0, null, null);?>

					<?php  $_smarty_tpl->tpl_vars['secondLevelCat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('secondLevelCats')->value[$_smarty_tpl->tpl_vars['subcategory']->value['id_category']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['secondLevelCat']->key => $_smarty_tpl->tpl_vars['secondLevelCat']->value){
?><?php if ($_smarty_tpl->getVariable('iter_c')->value++<3){?><a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['secondLevelCat']->value['id_category'],$_smarty_tpl->tpl_vars['secondLevelCat']->value['link_rewrite']),'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['secondLevelCat']->value['name'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['secondLevelCat']->value['name'],'htmlall','UTF-8');?>
,</a><?php }?><?php }} ?>
					
                                            <?php if (empty($_smarty_tpl->getVariable('secondLevelCats',null,true,false)->value[$_smarty_tpl->tpl_vars['subcategory']->value['id_category']])){?>
                                            <a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subcategory']->value['name'],'htmlall','UTF-8');?>
</a>
                                            <?php }else{ ?>
                                            <a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'htmlall','UTF-8');?>
">Ver m&aacute;s</a>
                                            <?php }?>

				</li>
                                <?php $_smarty_tpl->tpl_vars['nolist'] = new Smarty_variable(0, null, null);?>
                            <?php }else{ ?>
                                <?php $_smarty_tpl->tpl_vars['nolist'] = new Smarty_variable(1, null, null);?>
                            <?php }?>
			<?php }} ?>
			</ul>
			<br class="clear"/>
		</div>
		<?php }?>
                <?php if ($_smarty_tpl->getVariable('nolist')->value==1){?>
		<?php if ($_smarty_tpl->getVariable('products')->value){?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./product-compare.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./product-sort.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./product-list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('products',$_smarty_tpl->getVariable('products')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./product-compare.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./pagination.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php }elseif(!isset($_smarty_tpl->getVariable('subcategories',null,true,false)->value)){?>
				<p class="warning"><?php echo smartyTranslate(array('s'=>'There are no products in this category.'),$_smarty_tpl);?>
</p>
		<?php }?>

<?php }else{ ?>
<script>$('#layered_block_left').hide();</script>

                <?php }?>
	<?php }elseif($_smarty_tpl->getVariable('category')->value->id){?>
		<p class="warning"><?php echo smartyTranslate(array('s'=>'This category is currently unavailable.'),$_smarty_tpl);?>
</p>
	<?php }?>
<?php }?>