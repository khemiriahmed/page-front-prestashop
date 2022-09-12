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

class Avis extends objectModel
{
   
    /**
     * @var string signature
     */
    public $signature;

    /** 
     * @var string testimonial
     */
    public $testimonial;

      /** 
     * @var integer note
     */
    public $note;
    

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
        'table' => 'avisclients',
        'primary' => 'id_avisclients',
        'multilang' => true,
        'fields' => array(
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedId'),
            'position' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'signature' => array('type' => self::TYPE_STRING, 'lang' => true,),
           'note' => array('type' => self::TYPE_INT, 'lang' => true,),
            'testimonial' => array('type' => self::TYPE_STRING, 'lang' => true,),
        
        ),
    );

    public static function getMaxPosition()
    {
        return  Db::getInstance()->getValue(
            'SELECT MAX(position) FROM `'._DB_PREFIX_.'avisclients`'
        );
    }

    public static function getListContent($id_lang, $id_shop)
    {
        return Db::getInstance()->executeS(
            'SELECT * FROM '._DB_PREFIX_.'avisclients avs
            LEFT JOIN '._DB_PREFIX_.'avisclients_lang avsl on avs.id_avisclients = avsl.id_avisclients
            AND avsl.id_lang = '.$id_lang.' WHERE avs.id_shop = '.(int) $id_shop
        );
    }

}