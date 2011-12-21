<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 18:01:52
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/blocksearch/blocksearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12516134504ef2494011dd39-01307536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd80632cd4ac64d63e8d4c03b4c2aa5cdc15e8c9d' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/blocksearch/blocksearch.tpl',
      1 => 1324068646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12516134504ef2494011dd39-01307536',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block search module -->
<div id="search_block_left" class="block exclusive">
	<h4><?php echo smartyTranslate(array('s'=>'Search','mod'=>'blocksearch'),$_smarty_tpl);?>
</h4>
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
" id="searchbox">
		<p class="block_content">
			<label for="search_query_block"><?php echo smartyTranslate(array('s'=>'Enter a product name','mod'=>'blocksearch'),$_smarty_tpl);?>
</label>
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query" type="text" id="search_query_block" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->getVariable('ENT_QUOTES')->value,'utf-8'));?>
<?php }?>" />
			<input type="submit" id="search_button" class="button_mini" value="<?php echo smartyTranslate(array('s'=>'go','mod'=>'blocksearch'),$_smarty_tpl);?>
" />
		</p>
	</form>
</div>
<?php if ($_smarty_tpl->getVariable('instantsearch')->value){?>
	<script type="text/javascript">
	// <![CDATA[
		
		function tryToCloseInstantSearch() {
			if ($('#old_center_column').length > 0)
			{
				$('#center_column').remove();
				$('#old_center_column').attr('id', 'center_column');
				$('#center_column').show();
				return false;
			}
		}
		
		instantSearchQueries = new Array();
		function stopInstantSearchQueries(){
			for(i=0;i<instantSearchQueries.length;i++) {
				instantSearchQueries[i].abort();
			}
			instantSearchQueries = new Array();
		}
		
		$("#search_query_block").keyup(function(){
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
				url: '<?php if ($_smarty_tpl->getVariable('search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
<?php }?>',
				data: 'instantSearch=1&id_lang=<?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>
&q='+$(this).val(),
				dataType: 'html',
				success: function(data){
					if($("#search_query_block").val().length > 0)
					{
						tryToCloseInstantSearch();
						$('#center_column').attr('id', 'old_center_column');
						$('#old_center_column').after('<div id="center_column">'+data+'</div>');
						$('#old_center_column').hide();
						$("#instant_search_results a.close").click(function() {
							$("#search_query_block").val('');
							return tryToCloseInstantSearch();
						});
						return false;
					}
					else
						tryToCloseInstantSearch();
					}
				});
				instantSearchQueries.push(instantSearchQuery);
			}
			else
				tryToCloseInstantSearch();
		});
	// ]]>
	
	</script>
<?php }?>

<?php if ($_smarty_tpl->getVariable('ajaxsearch')->value){?>
	<script type="text/javascript">
	// <![CDATA[
	
		$('document').ready( function() {
			$("#search_query_block")
				.autocomplete(
					'<?php if ($_smarty_tpl->getVariable('search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
<?php }?>', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: <?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>

						}
					}
				)
				.result(function(event, data, formatted) {
					$('#search_query_block').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	
	// ]]>
	</script>
<?php }?>
<!-- /Block search module -->
