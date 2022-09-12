<?php
/* Smarty version 3.1.43, created on 2022-08-23 09:56:53
  from 'module:testimonialviewstemplates' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.43',
  'unifunc' => 'content_63048845017d23_30749504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2fccf79cc1665fa5f30753edfed09d53244023c5' => 
    array (
      0 => 'module:testimonialviewstemplates',
      1 => 1661209482,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63048845017d23_30749504 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin D:\webbax/modules/testimonial/views/templates/front/hook/testimonial.tpl -->
<?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
<section id="block-testimonial" class="block-testimonial py-3">
  <h1 class='text-center'>Ils dévorent déjà nos recettes</h1>
  <h3 class='text-center pb-5'>(Et ils les recommandent ! )</h3>
 
  <div class="row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
      <div class="col-md-4 mb-2">
       <div class="testimonial">
       <div class="contenu d-flex justify-content-between align-items-center">
       <div class='d-flex align-items-center'>
            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
modules/testimonial/views/img/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['image'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
" class="img-fluid pr-4">
         <div class='bloc-text'>
          <span class="titre d-block"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
          <span class='nbcommande'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['nbcommande'], ENT_QUOTES, 'UTF-8');?>
 Commandes</span>
         </div>
       </div> 
    
        
        <div class='rating'>
        <img src='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
modules/testimonial/views/img/star.svg' class='text-right img-fluid'>
         <span class='note d-block text-center'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['note'], ENT_QUOTES, 'UTF-8');?>
<span>/5</span></span>

        </div>
    
      
       </div>
        <div class="description pt-3"><p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
</p></div>
        </div>
      </div>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
   </div>
</section>
<?php }?>
<!-- end D:\webbax/modules/testimonial/views/templates/front/hook/testimonial.tpl --><?php }
}
