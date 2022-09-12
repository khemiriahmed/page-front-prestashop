<?php
class ModelAvisclient extends objectModel
{
  public $note;  
  public $signature;
  public $testimonial;
  public $active = true;


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'avisclients',
        'primary' => 'id_avisclients',
        'multilang' => true,
        'fields' => [
            'signature' => ['type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => true, 'size' => 255],
            'note' => ['type' => self::TYPE_STRING, 'validate' => 'isUnsignedInt', 'required' => true],
            /* Lang fields */
            'testimonial' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true],

            'active' => ['type' => self::TYPE_BOOL],
 

          
           
        ],
    ];



public static function getAvisclients($limit = 12, $active = true, $id_lang = null){
    
    $id_lang = $id_lang ? $id_lang : Context::getContext()->language->id;
    $q =new DbQuery();
    $q->select('av.*,avl.testimonial')
      ->from('avisclients','av')
      ->innerJoin('avisclients_lang','avl','avl.id_avisclients=av.id_avisclients and avl.id_lang='.$id_lang)
      ->limit($limit)
      ->where('av.active='.(int)$active);
    return Db::getInstance()->executeS($q);

}

}