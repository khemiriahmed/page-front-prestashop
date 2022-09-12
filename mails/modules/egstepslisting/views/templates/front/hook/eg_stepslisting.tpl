{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

{if $elements}
<div id="stepslisting-block " class="stepslisting-block py-5 stepslisting-{$hookName}">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="h2">{l s='Comment commander ?' d='Modules.Egstepslisting.stepslisting'}<br><span>{l s='Simple comme bonjour' d='Modules.Egstepslisting.Hometestimonials'}</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 style-module">
         <div class="row">
            {foreach from=$elements item=element}
               <div class="col-md-4 col-12 text-center">
                    <img src="{$urls.base_url}modules/egstepslisting/views/img/{$element.image}" alt="{$element.title}" class="lazyloaded">
                    <h3>{$element.title}</h3>
                    <p>{$element.description}</p>
                </div>
            {/foreach}
        </div>
     </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a href="{$link->getModuleLink('egrecipeplanning', 'week')}" class="btn-bg btn btn-primary" alt="{l s='Let\'s go !' d='Modules.Egstepslisting.stepslisting'}">{l s='C\est parti !' d='Modules.Egstepslisting.stepslisting'}</a>
        </div>
    </div>
</div>
{/if}
