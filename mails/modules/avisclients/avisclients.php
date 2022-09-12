<?php
/**
* 2007-2022 PrestaShop
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
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

if(!class_exists('ModelAvisclient'));
 require_once _PS_MODULE_DIR_.'avisclients/classes/ModelAvisclient.php';  

class Avisclients extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'avisclients';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'AhmedKhemiri';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;
        parent::__construct();
        $this->tabs = array(
            array('name'=> 'AvisClient','class_name'=>'ParentAvis', 'parent'=>''),
            array('name'=>'AvisClient','class_name'=>'AdminAvisclients','parent'=>'ParentAvis')
        );
        $this->displayName = $this->l('Avis Clients');
        $this->description = $this->l('Module d\'avis clients');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {   
        require _PS_MODULE_DIR_.'avisclients/sql/install.php';
        
        return parent::install() &&
            $this->installTab() &&
            $this->registerHook('header') &&
            $this->registerHook('displayHome') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()
    {
        require _PS_MODULE_DIR_.'avisclients/sql/uninstall.php';
        return  $this->installTab(false) && parent::uninstall();
    }

    public function installTab($install = true ){
      if($install){
        $languages = Language::getLanguages();
        foreach($this->tabs as $t)
        {
            $tab = new Tab();
            $tab->module = $this->name;
            $tab->class_name = $t['class_name'];
            $tab->id_parent = Tab::getIdFromClassName($t['parent']);
            foreach($languages as $language){
             $tab->name[$language['id_lang']] = $t['name'];
        }
           $tab->save();
      }
       return true;
      }
      else{
       
         foreach($this->tabs as $t){
            $id = Tab::getIdFromClassName($t['class_name']);
            if($id){
                $tab = new Tab($id);
                $tab->delete();
             }
         }
       
         return true;
      }
    }




    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitAvisclientsModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitAvisclientsModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                  
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'desc' => $this->l('Nombre d\'avis sur la home page'),
                        'name' => 'NBM_AVIS_FRONT',
                        'label' => $this->l('Nombre d\'avis sur la home page'),
                    ),
              
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        ); 
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
       return array(
        'NBM_AVIS_FRONT'=>Configuration::get('NBM_AVIS_FRONT'),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        $this->context->controller->addCSS($this->_path.'/views/css/all.min.css');
    }

     public function hookDisplayHome () {
        $avisclient = ModelAvisclient::getAvisclients(Configuration::get('NBM_AVIS_FRONT'),true);
        $this->context->smarty->assign(array(
            'avisclient' =>$avisclient,
        ));
        return $this->display(__FILE__,'/hook/avisclients_home.tpl');  
     }
}
