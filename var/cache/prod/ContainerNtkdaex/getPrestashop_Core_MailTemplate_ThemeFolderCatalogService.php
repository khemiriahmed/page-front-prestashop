<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.core.mail_template.theme_folder_catalog' shared service.

return $this->services['prestashop.core.mail_template.theme_folder_catalog'] = new \PrestaShop\PrestaShop\Core\MailTemplate\FolderThemeCatalog('D:\\webbax/mails/themes', ${($_ = isset($this->services['prestashop.core.mail_template.theme_folder_scanner']) ? $this->services['prestashop.core.mail_template.theme_folder_scanner'] : ($this->services['prestashop.core.mail_template.theme_folder_scanner'] = new \PrestaShop\PrestaShop\Core\MailTemplate\FolderThemeScanner())) && false ?: '_'}, ${($_ = isset($this->services['prestashop.core.hook.dispatcher']) ? $this->services['prestashop.core.hook.dispatcher'] : $this->getPrestashop_Core_Hook_DispatcherService()) && false ?: '_'});
