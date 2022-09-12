<?php
/**
* 2007-2019 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$sql = array();

$sql[] = ' CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'stepslisting` (
            `id_stepslisting` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_shop` int(10) unsigned NOT NULL ,
            `image` VARCHAR(100) NOT NULL,
            `position` int(10) unsigned NOT NULL,
            `active` int(10) unsigned NOT NULL,
            PRIMARY KEY (`id_stepslisting`)
  ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

$sql[] = ' CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'stepslisting_lang` (
            `id_stepslisting` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_lang` int(10) unsigned NOT NULL ,
            `title` VARCHAR(100) NOT NULL,
            `link` VARCHAR(100) NOT NULL,
            `description` VARCHAR(250) NOT NULL,
            PRIMARY KEY (`id_stepslisting`, `id_lang`)
  ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}


