<?php
/* Smarty version 3.1.43, created on 2022-08-23 09:57:13
  from 'module:psemailsubscriptionviewst' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_63048859e656e7_20734355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '307dc6bd4724d29d1572cc301dd7148e962604ef' => 
    array (
      0 => 'module:psemailsubscriptionviewst',
      1 => 1661222027,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63048859e656e7_20734355 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!-- begin D:\webbax/themes/eg-theme/modules/ps_emailsubscription/views/templates/hook/ps_emailsubscription.tpl -->
<div class="block_newsletter col-lg-3 col-12">
  <div class="row">
   <p class="footer__title footer__title--desktop">Rejoignez nous</p>  
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129831051963048859e20766_25487522', 'hook_social');
?>

   <p id="block-newsletter-label" class="p-0 col-lg-12 col-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Découvrez nos prochaines recettes en avant première !','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</p>
    <div class="p-0 col-lg-12 col-12">
   
      <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
#footer" method="post" class="needs-validation">
        <input type="hidden" name="action" value="0">
        <div class="input-group">
          <input
                  name="email"
                  class="form-control<?php if ((isset($_smarty_tpl->tpl_vars['nw_error']->value)) && $_smarty_tpl->tpl_vars['nw_error']->value) {?> is-invalid<?php }?>"
                  type="email"
                  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8');?>
"
                  placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your email address','d'=>'Shop.Forms.Labels'),$_smarty_tpl ) );?>
"
                  aria-labelledby="block-newsletter-label"
                  autocomplete="email"
          >
          <div class="input-group-append btn-newsletter">
            <button class="btn btn-primary" type="submit" name="submitNewsletter"><span class="d-none d-sm-inline"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subscribe','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span><span class="d-inline d-sm-none"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OK','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span></button>
          </div>
        </div>

        <div class="clearfix">
            <?php if ($_smarty_tpl->tpl_vars['msg']->value) {?>
              <p class="alert mt-2 <?php if ($_smarty_tpl->tpl_vars['nw_error']->value) {?>alert-danger<?php } else { ?>alert-success<?php }?>">
                  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['msg']->value, ENT_QUOTES, 'UTF-8');?>

              </p>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['conditions']->value) {?>
              <p class="small condition-text mt-2"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['conditions']->value, ENT_QUOTES, 'UTF-8');?>
</p>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['id_module']->value))) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayGDPRConsent','id_module'=>$_smarty_tpl->tpl_vars['id_module']->value),$_smarty_tpl ) );?>

            <?php }?>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end D:\webbax/themes/eg-theme/modules/ps_emailsubscription/views/templates/hook/ps_emailsubscription.tpl --><?php }
/* {block 'hook_social'} */
class Block_129831051963048859e20766_25487522 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_social' => 
  array (
    0 => 'Block_129831051963048859e20766_25487522',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displaysocial'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'hook_social'} */
}
