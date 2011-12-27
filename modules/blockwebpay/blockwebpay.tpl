<div id="categories_block_left" class="block">
	<h4><a href="{$blockCategTree.link}">{l s='Categories' mod='blockcategories'}</a></h4>
	<div class="block_content">
		<ul class="tree {if $isDhtml}dhtml{/if}">
		{* Javascript moved here to fix bug #PSCFI-151 *}
		<script type="text/javascript">
		// <![CDATA[
			// we hide the tree only if JavaScript is activated
			$('div#categories_block_left ul.dhtml').hide();
		// ]]>
		</script>
		{foreach from=$blockCategTree.children item=child name=blockCategTree}
			{if $smarty.foreach.blockCategTree.last}
				{include file="$branche_tpl_path" node=$child last='true'}
			{else}
				{include file="$branche_tpl_path" node=$child}
			{/if}
		{/foreach}
		</ul>
	</div>
</div>
<!-- /Block categories module -->
