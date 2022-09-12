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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class Binfo extends objectModel
{
    /** 
     * @var string image
     */
    public $image;

    /**
     * @var string title
     */
    public $title;

    /** 
     * @var string description
     */
    public $description;

    /** 
     * @var string link
     */
    public $link;

    /** 
     * @var integer active
     */
    public $active;

    /** 
     * @var integer position
     */
    public $position;

    /** 
     * @var integer id_lang
     */
    public $id_lang;

    /** 
     * @var integer id_shop
     */
    public $id_shop;



    public static $definition = array(
        'table' => 'blockinfo',
        'primary' => 'id_blockinfo',
        'multilang' => true,
        'fields' => array(
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'image' => array('type' => self::TYPE_STRING),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedId'),
            'position' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'title' => array('type' => self::TYPE_STRING, 'lang' => true,),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true,),
            'link' => array('type' => self::TYPE_STRING, 'lang' => true,'validate' => 'isUrl'),
        ),
    );

    public static function getMaxPosition()
    {
        return  Db::getInstance()->getValue(
            'SELECT MAX(position) FROM `'._DB_PREFIX_.'blockinfo`'
        );
    }

    public static function getListContent($id_lang, $id_shop)
    {
        return Db::getInstance()->executeS(
            'SELECT * FROM '._DB_PREFIX_.'blockinfo blk
            LEFT JOIN '._DB_PREFIX_.'blockinfo_lang blkl on blk.id_blockinfo = blkl.id_blockinfo
            AND blkl.id_lang = '.$id_lang.' WHERE blk.id_shop = '.(int) $id_shop
        );
    }

}