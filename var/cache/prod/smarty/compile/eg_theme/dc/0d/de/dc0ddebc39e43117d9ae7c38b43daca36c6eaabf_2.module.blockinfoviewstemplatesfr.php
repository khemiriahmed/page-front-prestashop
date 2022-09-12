<?php
/* Smarty version 3.1.43, created on 2022-08-22 18:11:57
  from 'module:blockinfoviewstemplatesfr' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_6303aacd344415_95461592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc0ddebc39e43117d9ae7c38b43daca36c6eaabf' => 
    array (
      0 => 'module:blockinfoviewstemplatesfr',
      1 => 1661045940,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6303aacd344415_95461592 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['infolist']->value) {?>
<div class="blockinfo-block blkinfo-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hookName']->value, ENT_QUOTES, 'UTF-8');?>
">
    <div class="row">
        <div class="col-12">
         <div class="row bg-color p-4">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['infolist']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
                <div class="col-md-4 col-12 text-center">
                    <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
modules/blockinfo/views/img/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['image'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
" class="lazyloaded">
                    <h3 class='pt-2'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
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
</div>
<?php }
}
}
