<?php

if(!class_exists('ModelAvisclient'));
require_once _PS_MODULE_DIR_.'avisclients/classes/ModelAvisclient.php';  
class AdminAvisclientsController extends ModuleAdminController{

 
    public function __construct(){
      
        $this->table ='avisclients';
        $this->className = 'ModelAvisclient';
        $this->lang = true;
        $this->bootstrap = true ;


        $this->fields_list = array(
            'id_avisclients' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'class' => 'fixed-width-xs'
            ),

            'note' => array(
                'title' => $this->l('Commentaire'),
                'width' => 'auto',
                'class' => 'fixed-width-xs'
            ),

           /* 'signature' => array(
                'title' => $this->l('Signature'),
                'width' => 'auto'
            ),*/
           'testimonial' => array(
                'title' => $this->l('Testimonial'),
                'width' => 'auto'
            ),
           
            'active' => array(
                'title' => $this->l('Enabled'),
                'active' => 'status',
                'type' => 'bool',
                'align' => 'center',
                'class' => 'fixed-width-xs',
                'orderby' => false
            )
        );
               
                $this->addRowAction('view');
                $this->addRowAction('edit');
                $this->addRowAction('delete');
                parent::__construct();
    }


    public function renderForm()
    {
        if (!($avisclients = $this->loadObject(true))) {
            return;
        }


        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('avisclients'),
                'icon' => 'icon-certificate'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Note'),
                    'name' => 'note',
                    'col' => 4,
                    'required' => true,
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Signature'),
                    'name' => 'signature',
                    'col' => 4,
                    'required' => true,
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Testimonial'),
                    'name' => 'testimonial',
                    'lang' => true,
                    'required' => true,
                    'cols' => 60,
                    'rows' => 10,
                    'col' => 6,
                   // 'autoload_rte' => 'rte', //Enable TinyMCE editor for testimonial
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
       
           
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable'),
                    'name' => 'active',
                    'required' => false,
                    'class' => 't',
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
                        )
                    )
                )
            )
        );

        if (!($avisclients = $this->loadObject(true))) {
            return;
        }

  

        $this->fields_form['submit'] = array(
            'title' => $this->l('Save')
        );

        foreach ($this->_languages as $language) {
        

            $this->fields_value['testimonial_'.$language['id_lang']] = htmlentities(stripslashes($this->getFieldValue(
                $avisclients,
                'testimonial',
                $language['id_lang']
            )), ENT_COMPAT, 'UTF-8');
        }

        return parent::renderForm();
    }

    protected function l($string, $class = null, $addslashes = false, $htmlentities = true)
    {
      if( _PS_VERSION_ >= '1.7'){
        return Context::getContext()->getTranslator()->trans($string);
       } else{
            return parent::l($string, $class, $addslashes, $htmlentities);
        }
      }
    
    }
    
 