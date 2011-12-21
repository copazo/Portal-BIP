{include file="$tpl_dir./errors.tpl"}

{if isset($category)}
	{if $category->id AND $category->active}

		{if $products}
				

				{include file="$tpl_dir./../../modules/blockconfigurador/product-listConfigurador.tpl" products=$products}

				{include file="$tpl_dir./../../modules/blockconfigurador/paginationConfigurador.tpl"}
			{elseif !isset($subcategories)}
				<p class="warning">{l s='There are no products in this category.'}</p>
			{/if}
	{elseif $category->id}
		<p class="warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}
