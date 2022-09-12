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

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

include_once _PS_MODULE_DIR_ . 'egstepslisting/classes/Egstepslisting.php';

class Egstepslisting extends Module implements WidgetInterface
{
    protected $config_form = false;
    public $position_identifier = 'id_egstepslisting_to_move';
    protected $templateFile;

    public function __construct()
    {
        $this->name = 'egstepslisting';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Evolutive Group';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->explicitSelect = true;
        $this->_defaultOrderBy = 'position';
        $this->allow_export = true;
        $this->folder_file_upload = _PS_MODULE_DIR_ . $this->name . '/views/img/';

        parent::__construct();

        $this->displayName = $this->l('EG Egstepslisting');
        $this->description = $this->l('Keep in touch with your customers by adding a block to reassure your customers about the services you offer: secure payment, free shipping, return policy, etc.');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->templateFile = 'module:' . $this->name . '/views/templates/front/hook/eg_stepslisting.tpl';
    }

    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');
        return parent::install() &&
            $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        if (Tools::isSubmit('deleteegstepslisting') && !empty(Tools::getValue('id_egstepslisting'))) {
            $this->deleteReassurance();
        } elseif (Tools::getValue('action') == 'statusegstepslisting') {
            $this->changeStatus();
        } elseif (Tools::isSubmit('updateegstepslisting') || Tools::isSubmit('addegstepslisting')) {
            return $this->renderForm();
        } elseif (Tools::isSubmit('saveItemegstepslisting')) {
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
        return EgSteps::getListContent(Context::getContext()->language->id,Context::getContext()->shop->id);
    }

    protected function initList()
    {
        $this->fields_list = array(
            'id_stepslisting' => array(
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
        $helper->table = 'egstepslisting';
        $helper->identifier = 'id_stepslisting';
        $helper->position_identifier = 'id_egstepslisting_to_move';
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
        $helper->submit_action = 'saveItemegstepslisting';
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );
        return $helper->generateForm(array($this->getConfigForm()));
    }

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
                        'name' => 'EG_STEPSLISTING_IMAGE_PREVIEW',
                        'label' => $this->l('Image')
                    ),
                    array(
                        'type' => 'file',
                        'prefix' => '<i class="icon icon-file"></i>',
                        'name' => 'EG_STEPSLISTING_IMAGE',
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'EG_STEPSLISTING_TITLE',
                        'prefix' => '<i class="icon icon-book"></i>',
                        'label' => $this->l('Titre'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'EG_STEPSLISTING_LINK',
                        'prefix' => '<i class="icon-external-link"></i>',
                        'label' => $this->l('Lien'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'EG_STEPSLISTING_DESCRIPTION',
                        'label' => $this->l('Description'),
                        'lang' => true
                    ),
                    array(
                        'type' => 'switch',
                        'name' => 'EG_STEPSLISTING_ACTIVE',
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
                        'name' => 'EG_STEPSLISTING_ID_STEPSLISTING',
                        'value' => 0,
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    protected function getConfigFormValues()
    {
        $step = (new EgSteps((int)Tools::getValue('id_stepslisting')));
        if ($step->id) {
            $image_preview = '<img src="' . _PS_MODULE_DIR_ . $this->name . '/views/img/' . $step->image . '" class="img_fluid" width="100">';
        } else {
            $image_preview = '';
        }

        return array(
            'EG_STEPSLISTING_IMAGE_PREVIEW' => $image_preview,
            'EG_STEPSLISTING_IMAGE' => '',
            'EG_STEPSLISTING_TITLE' => $step->title,
            'EG_STEPSLISTING_DESCRIPTION' => $step->description,
            'EG_STEPSLISTING_LINK' => $step->link,
            'EG_STEPSLISTING_ACTIVE' => $step->active,
            'EG_STEPSLISTING_ID_STEPSLISTING' => $step->id,
        );
    }

    public function saveContent()
    {
        if ((int)Tools::getValue('EG_STEPSLISTING_ID_STEPSLISTING')) {
            $step = new EgSteps((int)Tools::getValue('EG_STEPSLISTING_ID_STEPSLISTING'));
        } else {
            $step = new EgSteps();
            $step->position = EgSteps::getMaxPosition() + 1;
        }

        if(Tools::getValue('EG_STEPSLISTING_IMAGE'))
        {
            $customImage = $_FILES['EG_STEPSLISTING_IMAGE'];
            $fileTmpName = $customImage['tmp_name'];
            $fileName = md5($customImage['name'] . microtime()) . '.' . pathinfo($customImage['name'], PATHINFO_EXTENSION);
            $validUpload = ImageManager::validateUpload($customImage);

            if (is_bool($validUpload) && $validUpload === false && move_uploaded_file($fileTmpName, $this->folder_file_upload . $fileName)) {
                $image = $fileName;
            }
        }else{
            $image = $step->image;
        }

        $step->id_shop = Context::getContext()->shop->id;
        $step->image = $image;
        $step->active = Tools::getValue('EG_STEPSLISTING_ACTIVE');
        $step->title[Context::getContext()->language->id] = Tools::getValue('EG_STEPSLISTING_TITLE_' . Context::getContext()->language->id);
        $step->link[Context::getContext()->language->id] = Tools::getValue('EG_STEPSLISTING_LINK_' . Context::getContext()->language->id);
        $step->description[Context::getContext()->language->id] = Tools::getValue('EG_STEPSLISTING_DESCRIPTION_' . Context::getContext()->language->id);

        $step->save();

        $token = Tools::getAdminTokenLite('AdminModules');
        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
            Tools::redirectAdmin($link);
    }

    public function deleteReassurance()
    {
        $step = new EgSteps(Tools::getValue('id_stepslisting'));
        unlink(_PS_MODULE_DIR_ . $this->name . '/views/img/' . $step->image);
        $step->delete();
        $token = Tools::getAdminTokenLite('AdminModules');

        $link = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
        Tools::redirectAdmin($link);
    }

    public function changeStatus()
    {
        if (!$id_stepslisting = (int)Tools::getValue('id_stepslisting')) {
            die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
        } else {
            $step = new EgSteps($id_stepslisting);
            if (Validate::isLoadedObject($step)) {
                $step->active = $step->active == 1 ? 0 : 1;
                $step->save() ?
                    die(Tools::jsonEncode(array('success' => true, 'text' => $this->trans('The status has been updated successfully', array(), 'Admin.Global')))) :
                    die(Tools::jsonEncode(array('success' => false, 'error' => true, 'text' => $this->trans('Failed to update the status', array(), 'Admin.Global'))));
            }
        }
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        $stepslisting = $this->getListContent();
        return array(
            'elements' => $stepslisting,
            'hookName' => $hookName
        );
    }

    public function renderWidget($hookName, array $configuration)
    {
        $key = 'ps_Egstepslisting|' . $hookName;
        if (!$this->isCached($this->templateFile, $this->getCacheId($key))) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }
        return $this->fetch($this->templateFile, $this->getCacheId($key));
    }
}
