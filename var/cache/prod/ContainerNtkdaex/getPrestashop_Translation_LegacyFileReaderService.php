<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.translation.legacy_file_reader' shared service.

return $this->services['prestashop.translation.legacy_file_reader'] = new \PrestaShopBundle\Translation\Loader\LegacyFileReader(${($_ = isset($this->services['prestashop.core.translation.locale.converter']) ? $this->services['prestashop.core.translation.locale.converter'] : ($this->services['prestashop.core.translation.locale.converter'] = new \PrestaShop\PrestaShop\Core\Translation\Locale\Converter('D:\\webbax\\app/Resources/translations/../legacy-to-standard-locales.json'))) && false ?: '_'});
