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

include_once _PS_MODULE_DIR_ . 'blockinfo/classes/Binfo.php';

class Blockinfo extends Module implements WidgetInterface
{
    protected $config_form = false;
    public $position_identifier = 'id_blockinfo_to_move';
    protected $templateFile;

    public function __construct()
    {
        $this->name = 'blockinfo';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Ahmed Khemiri';
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

        $this->displayName = $this->l('block info');
        $this->description = $this->l('Here is my Module block info');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->templateFile = 'module:blockinfo/views/templates/front/hook/blockinfo.tpl';
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
        /**
         * If values have been submitted in the form, process.
         */
        {
            if (Tools::isSubmit('deleteblockinfo') && !empty(Tools::getValue('id_blockinfo'))) {
                $this->deleteblockinfo();
            } elseif (Tools::getValue('action') == 'statusblockinfo') {
                $this->changeStatus();
            } elseif (Tools::isSubmit('updateblockinfo') || Tools::isSubmit('addblockinfo')) {
                return $this->renderForm();
            } elseif (Tools::isSubmit('saveItemblockinfo')) {
                $this->saveContent();
            } else {
                $content = $this->getListContent();
                $helper = $this->initList();
                $helper->listTotal = count($content);
                return $helper->generateList($content, $this->fields_list);
            }
        }
    }
    
    protected function getListContent()
    {
        return Binfo::getListContent(Context::getContext()->language->id,Context::getContext()->shop->id);
    }



    protected function initList()
    {
        $this->fields_list = array(
            'id_blockinfo' => array(
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
        $helper->table = 'blockinfo';
        $helper->identifier = 'id_blockinfo';
        $helper->position_identifier = 'id_blockinfo_to_move';
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
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . 'add=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->submit_action = 'saveItemblockinfo';
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(),
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
                        'name' => 'BLOCKINFO_IMAGE_PREVIEW',
                        'label' => $this->l('Image')
                    ),
                    array(
                        'type' => 'file',
                        'prefix' => '<i class="icon icon-file"></i>',
                        'name' => 'BLOCKINFO_IMAGE',
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'BLOCKINFO_TITLE',
                        'prefix' => '<i class="icon icon-book"></i>',
                        'label' => $this->l('Titre'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'BLOCKINFO_LINK',
                        'prefix' => '<i class="icon-external-link"></i>',
                        'label' => $this->l('Lien'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'BLOCKINFO_DESCRIPTION',
                        'label' => $this->l('Description'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'switch',
                        'name' => 'BLOCKINFO_ACTIVE',
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
                        'name' => 'BLOCKINFO_ID_BLOCKINFO',
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
        $info = (new Binfo((int)Tools::getValue('id_blockinfo')));
        if ($info->id) {
            $image_preview = '<img src="' . _PS_MODULE_DIR_ . $this->name . '/views/img/' . $info->image . '" class="img_fluid" width="100">';
        } else {
            $image_preview = '';
        }
        return array(
            'BLOCKINFO_IMAGE_PREVIEW' => $image_preview,
            'BLOCKINFO_IMAGE' => '',
            'BLOCKINFO_TITLE' => $info->title,
            'BLOCKINFO_DESCRIPTION' => $info->description,
            'BLOCKINFO_LINK' => $info->link,
            'BLOCKINFO_ACTIVE' => $info->active,
            'BLOCKINFO_ID_BLOCKINFO' => $info->id,

        );
    }

    /**
     * Save form data.
     */
    public function saveContent()
    {

        if ((int)Tools::getValue('BLOCKINFO_ID_BLOCKINFO')) {
            $info = new Binfo((int)Tools::getValue('BLOCKINFO_ID_BLOCKINFO'));
        } else {
            $info = new Binfo();
            $info->position = Binfo::getMaxPosition() + 1;
        }

        if(Tools::getValue('BLOCKINFO_IMAGE'))
        {
            $customImage = $_FILES['BLOCKINFO_IMAGE'];
            $fileTmpName = $customImage['tmp_name'];
            $fileName = md5($customImage['name'] . microtime()) . '.' . pathinfo($customImage['name'], PATHINFO_EXTENSION);
            $validUpload = ImageManager::validateUpload($customImage);

            if (is_bool($validUpload) && $validUpload === false && move_uploaded_file($fileTmpName, $this->folder_file_upload . $fileName)) {
                $image = $fileName;
            }
        }else{
            $image = $info->image;
        }

        $info->id_shop = Context::getContext()->shop->id;
        $info->image = $image;
        $info->active = Tools::getValue('BLOCKINFO_ACTIVE');
        $info->title[Context::getContext()->language->id] = Tools::getValue('BLOCKINFO_TITLE_' . Context::getContext()->language->id);
        $info->link[Context::getContext()->language->id] = Tools::getValue('BLOCKINFO_LINK_' . Context::getContext()->language->id);
        $info->description[Context::getContext()->language->id] = Tools::getValue('BLOCKINFO_DESCRIPTION_' . Context::getContext()->language->id);

        $info->save();

        $token = Tools::getAdminTokenLite('AdminModules');
        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
            Tools::redirectAdmin($link);
    }

    
    public function deleteblockinfo()
    {
        $info = new Binfo(Tools::getValue('id_blockinfo'));
        unlink(_PS_MODULE_DIR_ . '/blockinfo/views/img/' . $info->image);
        $info->delete();
        $token = Tools::getAdminTokenLite('AdminModules');

        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
        Tools::redirectAdmin($link);

    }

    
    public function changeStatus()
    {
        if (!$id_blockinfo = (int)Tools::getValue('id_blockinfo')) {
            die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
        } else {
            $info = new Binfo($id_blockinfo);
            if (Validate::isLoadedObject($info)) {
                $info->active = $info->active == 1 ? 0 : 1;
                $info->save() ?
                    die(Tools::jsonEncode(array('success' => true, 'text' => $this->trans('The status has been updated successfully', array(), 'Admin.Global')))) :
                    die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
            }
        }
    }

    
    public function getWidgetVariables($hookName, array $configuration)
    {
        $infos = $this->getListContent();

        return array(
            'infolist' => $infos,
            'hookName' => $hookName
        );
    }

    public function renderWidget($hookName, array $configuration)
    {
        $key = 'ps_blockinfo|' . $hookName;
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
