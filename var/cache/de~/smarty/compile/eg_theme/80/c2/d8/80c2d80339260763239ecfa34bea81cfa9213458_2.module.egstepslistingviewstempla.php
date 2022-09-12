<?php
/* Smarty version 3.1.43, created on 2022-08-23 09:56:52
  from 'module:egstepslistingviewstempla' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_63048844dfe5d3_96898943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80c2d80339260763239ecfa34bea81cfa9213458' => 
    array (
      0 => 'module:egstepslistingviewstempla',
      1 => 1661213974,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63048844dfe5d3_96898943 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin D:\webbax/modules/egstepslisting/views/templates/front/hook/eg_stepslisting.tpl -->
<?php if ($_smarty_tpl->tpl_vars['elements']->value) {?>
<div id="stepslisting-block " class="stepslisting-block py-5 stepslisting-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hookName']->value, ENT_QUOTES, 'UTF-8');?>
">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="h2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comment commander ?','d'=>'Modules.Egstepslisting.stepslisting'),$_smarty_tpl ) );?>
<br><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Simple comme bonjour','d'=>'Modules.Egstepslisting.Hometestimonials'),$_smarty_tpl ) );?>
</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 style-module">
         <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elements']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
               <div class="col-md-4 col-12 text-center">
                    <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
modules/egstepslisting/views/img/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['image'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
" class="lazyloaded mb-3">
                    <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
</h3>
                    <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
</p>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
     </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('egrecipeplanning','week'), ENT_QUOTES, 'UTF-8');?>
" class="btn-bg btn btn-primary" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Let\'s go !','d'=>'Modules.Egstepslisting.stepslisting'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'C\'est parti !','d'=>'Modules.Egstepslisting.stepslisting'),$_smarty_tpl ) );?>
</a>
        </div>
    </div>
</div>
<?php }?>
<!-- end D:\webbax/modules/egstepslisting/views/templates/front/hook/eg_stepslisting.tpl --><?php }
}
