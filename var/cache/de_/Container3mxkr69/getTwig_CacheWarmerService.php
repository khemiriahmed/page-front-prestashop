<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'twig.cache_warmer' shared service.

return $this->services['twig.cache_warmer'] = new \PrestaShopBundle\Cache\ModuleTemplateCacheWarmer((new \Symfony\Component\DependencyInjection\ServiceLocator(['twig' => function () {
    $f = function (\Twig\Environment $v) { return $v; }; return $f(${($_ = isset($this->services['twig']) ? $this->services['twig'] : $this->getTwigService()) && false ?: '_'});
}]))->withContext('twig.cache_warmer', $this), ${($_ = isset($this->services['templating.finder']) ? $this->services['templating.finder'] : $this->load('getTemplating_FinderService.php')) && false ?: '_'}, ['D:\\webbax\\app/../src/PrestaShopBundle/Resources/views/Admin/Product' => 'Product', 'D:\\webbax\\app/../src/PrestaShopBundle/Resources/views/Admin/TwigTemplateForm' => 'Twig', 'D:\\webbax\\app/../src/PrestaShopBundle/Resources/views/Admin/Common' => 'Common', 'D:\\webbax\\app/../src/PrestaShopBundle/Resources/views/Admin/Configure/AdvancedParameters' => 'AdvancedParameters', 'D:\\webbax\\app/../src/PrestaShopBundle/Resources/views/Admin/Configure/ShopParameters' => 'ShopParameters', 'D:\\webbax\\app/../modules' => 'Modules', 'D:\\webbax/mails/themes' => 'MailThemes', 'D:\\webbax\\vendor\\symfony\\symfony\\src\\Symfony\\Bridge\\Twig/Resources/views/Form' => NULL]);
