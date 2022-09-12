<?php
/* Smarty version 3.1.43, created on 2022-08-23 09:56:53
  from 'module:egblockreassuranceviewste' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_630488451935e0_73694772',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd4446b6fa0f18a6fd12f76aa95ce1f957441526' => 
    array (
      0 => 'module:egblockreassuranceviewste',
      1 => 1660787930,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_630488451935e0_73694772 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin D:\webbax/modules/egblockreassurance/views/templates/front/hook/eg_blockreassurance.tpl -->
<?php if ($_smarty_tpl->tpl_vars['reassuranceslist']->value) {?>
<div class="reassurance-block reassurance-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hookName']->value, ENT_QUOTES, 'UTF-8');?>
">
    <div class="<?php if ($_smarty_tpl->tpl_vars['hookName']->value == "displayNavFullWidth") {?>container<?php } else { ?>col-md-12<?php }?>">
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reassuranceslist']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
                <li>
                    <img class='pb-3' src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
modules/egblockreassurance/views/img/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['image'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
">
                    <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
</p>
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
</div>
<?php }?>
<!-- end D:\webbax/modules/egblockreassurance/views/templates/front/hook/eg_blockreassurance.tpl --><?php }
}
