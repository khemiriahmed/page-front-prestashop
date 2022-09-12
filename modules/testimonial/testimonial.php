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
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
include_once _PS_MODULE_DIR_ . 'testimonial/classes/Test.php';
class Testimonial extends Module implements WidgetInterface
{
    protected $config_form = false;
    public $position_identifier = 'id_testimonial_to_move';
    protected $templateFile;

    public function __construct()
    {
        $this->name = 'testimonial';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Ahmed';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->explicitSelect = true;
        $this->_defaultOrderBy = 'position';
        $this->allow_export = true;
        $this->folder_file_upload = _PS_MODULE_DIR_ . $this->name . '/views/img/';

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Testimonial');
        $this->description = $this->l('my new module for prestashop');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->templateFile = 'module:testimonial/views/templates/front/hook/testimonial.tpl';
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayHome') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()
    {
        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
 
    public function getContent()
    {
        if (Tools::isSubmit('deletetestimonial') && !empty(Tools::getValue('id_testimonial'))) {
            $this->deleteTestimonial();
        } elseif (Tools::getValue('action') == 'statustestimonial') {
            $this->changeStatus();
        } elseif (Tools::isSubmit('updatetestimonial') || Tools::isSubmit('addtestimonial')) {
            return $this->renderForm();
        } elseif (Tools::isSubmit('saveItemtestimonial')) {
            $this->saveContent();
        } else {
            $content = $this->getListContent();
            $helper = $this->initList();
            $helper->listTotal = count($content);
            return $helper->generateList($content, $this->fields_list);
        }
    }

    
    protected function getListContent()
    {
        return Test::getListContent(Context::getContext()->language->id,Context::getContext()->shop->id);
    }


    protected function initList()
    {
        $this->fields_list = array(
            'id_testimonial' => array(
                'title' => $this->trans('ID', array(), 'Admin.Global'),
                'width' => 120,
                'type' => 'text',
                'search' => false,
                'orderby' => false
            ),
            'title' => array(
                'title' => $this->trans('Title', array(), 'Admin.Global'),
                'width' => 100,
                'type' => 'text',
                'search' => false,
                'orderby' => false
            ),
            'active' => array(
                'title' => $this->trans('Displayed', array(), 'Admin.Global'),
                'type' => 'bool',
                'active' => 'status', 'class' => 'fixed-width-xs',
                'align' => 'center',
                'ajax' => true,
            ),
            'position' => array(
                'title' => $this->trans('Position', array(), 'Admin.Global'),
                'align' => 'center',
                'class' => 'fixed-width-xs',
                'position' => 'position',
                'filter_key' => false
            )
        );

        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = false;
        $helper->actions = array('edit', 'delete');
        $helper->show_toolbar = true;
        $helper->title = $this->displayName;
        $helper->table = 'testimonial';
        $helper->identifier = 'id_testimonial';
        $helper->position_identifier = 'id_testimonial_to_move';
        $helper->orderBy = 'position';
        $helper->orderWay = 'ASC';

        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        $helper->imageType = 'jpg';
        $helper->toolbar_btn['new'] = array(
            'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&add' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->trans('Add new', array(), 'Admin.Actions')
        );

        return $helper;
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
        $helper->submit_action = 'saveItemtestimonial';
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
                        'type' => 'free',
                        'name' => 'TESTIMONIAL_IMAGE_PREVIEW',
                        'label' => $this->l('Image')
                    ),
                    array(
                        'type' => 'file',
                        'prefix' => '<i class="icon icon-file"></i>',
                        'name' => 'TESTIMONIAL_IMAGE',
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'TESTIMONIAL_TITLE',
                        'prefix' => '<i class="icon icon-book"></i>',
                        'label' => $this->l('Titre'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'TESTIMONIAL_NBC',
                        'label' => $this->l('Nombre commande'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'TESTIMONIAL_NOTE',
                        'label' => $this->l('Note'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'TESTIMONIAL_DESCRIPTION',
                        'label' => $this->l('Description'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'switch',
                        'name' => 'TESTIMONIAL_ACTIVE',
                        'label' => $this->l('Active'),
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ),
                        ),
                    ),
                    array(
                        'type' => 'hidden',
                        'name' => 'TESTIMONIAL_ID_TESTIMONIAL',
                        'value' => 0,
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
        $testimonial = (new Test((int)Tools::getValue('id_testimonial')));
        if ($testimonial->id) {
            $image_preview = '<img src="' . _PS_MODULE_DIR_ . $this->name . '/views/img/' . $testimonial->image . '" class="img_fluid" width="100">';
        } else {
            $image_preview = '';
        }

        return array(
            'TESTIMONIAL_IMAGE_PREVIEW' => $image_preview,
            'TESTIMONIAL_IMAGE' => '',
            'TESTIMONIAL_TITLE' => $testimonial->title,
            'TESTIMONIAL_DESCRIPTION' => $testimonial->description,
            'TESTIMONIAL_NBC' => $testimonial->nbcommande,
            'TESTIMONIAL_NOTE' => $testimonial->note,
            'TESTIMONIAL_ACTIVE' => $testimonial->active,
            'TESTIMONIAL_ID_TESTIMONIAL' => $testimonial->id,
        );
    }

    /**
     * Save form data.
     */
    public function saveContent()
    {
        if ((int)Tools::getValue('TESTIMONIAL_ID_TESTIMONIAL')) {
            $testimonial = new Test((int)Tools::getValue('TESTIMONIAL_ID_TESTIMONIAL'));
        } else {
            $testimonial = new Test();
            $testimonial->position = Test::getMaxPosition() + 1;
        }

        if(Tools::getValue('TESTIMONIAL_IMAGE'))
        {
            $customImage = $_FILES['TESTIMONIAL_IMAGE'];
            $fileTmpName = $customImage['tmp_name'];
            $fileName = md5($customImage['name'] . microtime()) . '.' . pathinfo($customImage['name'], PATHINFO_EXTENSION);
            $validUpload = ImageManager::validateUpload($customImage);

            if (is_bool($validUpload) && $validUpload === false && move_uploaded_file($fileTmpName, $this->folder_file_upload . $fileName)) {
                $image = $fileName;
            }
        }else{
            $image = $testimonial->image;
        }

        $testimonial->id_shop = Context::getContext()->shop->id;
        $testimonial->image = $image;
        $testimonial->active = Tools::getValue('TESTIMONIAL_ACTIVE');
        $testimonial->title[Context::getContext()->language->id] = Tools::getValue('TESTIMONIAL_TITLE_' . Context::getContext()->language->id);
        $testimonial->nbcommande[Context::getContext()->language->id] = Tools::getValue('TESTIMONIAL_NBC_' . Context::getContext()->language->id);
        $testimonial->note[Context::getContext()->language->id] = Tools::getValue('TESTIMONIAL_NOTE_' . Context::getContext()->language->id);
        $testimonial->description[Context::getContext()->language->id] = Tools::getValue('TESTIMONIAL_DESCRIPTION_' . Context::getContext()->language->id);

        $testimonial->save();

        $token = Tools::getAdminTokenLite('AdminModules');
        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
            Tools::redirectAdmin($link);
    }




    public function deleteTestimonial()
    {
        $testimonial = new Test(Tools::getValue('id_testimonial'));
        unlink(_PS_MODULE_DIR_ . '/testimonial/views/img/' . $testimonial->image);
        $testimonial->delete();
        $token = Tools::getAdminTokenLite('AdminModules');

        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
        Tools::redirectAdmin($link);

    }


    public function changeStatus()
    {
        if (!$id_testimonial = (int)Tools::getValue('id_testimonial')) {
            die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
        } else {
            $testimonial = new Test($id_testimonial);
            if (Validate::isLoadedObject($testimonial)) {
                $testimonial->active = $info->active == 1 ? 0 : 1;
                $testimonial->save() ?
                    die(Tools::jsonEncode(array('success' => true, 'text' => $this->trans('The status has been updated successfully', array(), 'Admin.Global')))) :
                    die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
            }
        }
    }


    public function getWidgetVariables($hookName, array $configuration)
    {
        $testimonial = $this->getListContent();
        return array(
            'data' => $testimonial,
            'hookName' => $hookName
        );
    }

    public function renderWidget($hookName, array $configuration)
    {
        $key = 'ps_testimonial|' . $hookName;
        if (!$this->isCached($this->templateFile, $this->getCacheId($key))) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }
        return $this->fetch($this->templateFile, $this->getCacheId($key));
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
    }
}
