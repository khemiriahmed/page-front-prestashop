<?php
/* Smarty version 3.1.43, created on 2022-08-23 09:56:53
  from 'module:avisclientsviewstemplates' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_630488450f25c7_53104640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '036a08e1dce10ef84bc1910dbd9961e2ab8cbe33' => 
    array (
      0 => 'module:avisclientsviewstemplates',
      1 => 1661095594,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_630488450f25c7_53104640 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin D:\webbax/modules/avisclients/views/templates/front/hook/avis.tpl -->

<?php if ($_smarty_tpl->tpl_vars['infolist']->value) {?>
<section id="block-avis-client" class="block-avis-client py-4">
  <h1 class='text-center py-2'>Ils ont choisi simply you box</h1>
  <h3 class='text-center pb-4'>Et sont aux anges</h3>
 
  <div class="row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['infolist']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
      <div class="col-md-4">
       <div class="avis">
        <div class="bloc-note pb-3">
          <div class="star pr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
           </div>
          <div class='note'>
              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['note'], ENT_QUOTES, 'UTF-8');?>
/5
          </div>
        </div>
     
        <p class="pb-3"><?php echo $_smarty_tpl->tpl_vars['element']->value['testimonial'];?>
</p>
         <h4>Publié par <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['signature'], ENT_QUOTES, 'UTF-8');?>
</h4>
        </div>
      </div>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
   </div>
</section>
<?php }?>
<!-- end D:\webbax/modules/avisclients/views/templates/front/hook/avis.tpl --><?php }
}
