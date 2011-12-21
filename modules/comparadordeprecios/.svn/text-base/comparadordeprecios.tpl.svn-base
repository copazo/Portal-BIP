{*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 9036 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{capture name=path}{l s='Comparador de precios' mod='comparadordeprecios'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<!--<h1>{l s='Si encontraste este articulo mas barato en otra tienda, dinos donde.'}</h1>-->

<p class="bold">{l s='Si encontraste este articulo mas barato en otra tienda, dinos donde.' mod='comparadordeprecios'}.</p>
{include file="$tpl_dir./errors.tpl"}

{if isset($smarty.get.submited)}
	<p class="success">{l s='Los datos se han enviado correctamente' mod='comparadordeprecios'}</p>
{else}
	<form method="post" action="{$request_uri}" class="std">
		<fieldset>
			<h3>{l s='Informacion del producto' mod='comparadordeprecios'}</h3>

			<p class="align_center">
				<a href="{$productLink}"><img src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'small')}" alt="" title="{$cover.legend|escape:'htmlall':'UTF-8'}" /></a><br/>
				<a href="{$productLink}">{$product->name|escape:'htmlall':'UTF-8'}</a>
			</p>

			<p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;">{l s='URL' mod='comparadordeprecios'}</label>
				<input type="text" id="dacoURL" name="dacoURL" value="{if isset($smarty.post.dacoURL)}{$smarty.post.dacoURL|escape:'htmlall':'UTF-8'|stripslashes}{/if}" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:400px; border:1px solid #039"  />
			</p>
            <p>
				<label for="friend-name" style="float: left; text-align: left; width: 7%;">{l s='Email' mod='comparadordeprecios'}</label>
				<input type="text" id="dacoEmail" name="dacoEmail" value="{if isset($smarty.post.dacoEmail)}{$smarty.post.dacoEmail|escape:'htmlall':'UTF-8'|stripslashes}{else}{$email}{/if}" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; background-color:#FFFFFF; width:150px; border:1px solid #039" />
			</p>
			<p class="submit" style="float:right;">
				<input type="submit" name="submitSendURL" value="{l s='Enviar' mod='comparadordeprecios'}" class="button" />
			</p>
		</fieldset>
        <input type="hidden" id="dacoBip" name="dacoBip" value="{$product->id}" />
        <input type="hidden" id="dacoUsuario" name="dacoUsuario" value="{if isset($smarty.post.dacoUsuario)}{$smarty.post.dacoUsuario|escape:'htmlall':'UTF-8'|stripslashes}{else}{$tipoUsuario}{/if}" />
	</form>
{/if}

<ul class="footer_links">
	<li><a href="{$productLink}" class="button_large">{l s='Regresar' mod='comparadordeprecios'}</a></li>
</ul>