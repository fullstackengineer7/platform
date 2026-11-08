<?php
/* Smarty version 4.5.8, created on 2026-11-08 13:42:06
  from '/var/www/html/resources/templates/pages/category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.8',
  'unifunc' => 'content_6af07c2eb78b83_49451571',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e07b50718d879fc62c230b30a6fd5f49340c1118' => 
    array (
      0 => '/var/www/html/resources/templates/pages/category.tpl',
      1 => 1794145326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6af07c2eb78b83_49451571 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19835116866af07c2eb63435_99022617', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/main.tpl");
}
/* {block "content"} */
class Block_19835116866af07c2eb63435_99022617 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19835116866af07c2eb63435_99022617',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['category']->value->getName()->value), ENT_QUOTES, 'UTF-8');?>
</li>
        </ol>
    </nav>

    <h1><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['category']->value->getName()->value), ENT_QUOTES, 'UTF-8');?>
</h1>
    <p class="text-muted mb-4"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['category']->value->getDescription()), ENT_QUOTES, 'UTF-8');?>
</p>

    <div class="row g-4">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articles']->value, 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-decoration-none" href="/article/<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getSlug()->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
</a>
                        </h5>
                        <p class="card-text"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getDescription()), ENT_QUOTES, 'UTF-8');?>
</p>
                    </div>
                    <div class="card-footer text-muted small">
                        <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getCreatedAt()->format('d.m.Y')), ENT_QUOTES, 'UTF-8');?>
 &middot; <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getViews()), ENT_QUOTES, 'UTF-8');?>
 views
                    </div>
                </div>
            </div>
        <?php
}
if ($_smarty_tpl->tpl_vars['article']->do_else) {
?>
            <p>No articles in this category.</p>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['pagination']->value['total'] > 1) {?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($_smarty_tpl->tpl_vars['pagination']->value['current'] <= 1) {?>disabled<?php }?>">
                    <a class="page-link" href="?page=<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['pagination']->value['current']-1), ENT_QUOTES, 'UTF-8');?>
">Previous</a>
                </li>
                <?php
$__section_p_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['pagination']->value['total']) ? count($_loop) : max(0, (int) $_loop));
$__section_p_0_total = $__section_p_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_p'] = new Smarty_Variable(array());
if ($__section_p_0_total !== 0) {
for ($_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_p']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration'] <= $__section_p_0_total; $_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_p']->value['index']++){
?>
                    <li class="page-item <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration'] : null) == $_smarty_tpl->tpl_vars['pagination']->value['current']) {?>active<?php }?>">
                        <a class="page-link" href="?page=<?php echo htmlspecialchars((string) ((isset($_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration'] : null)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ((isset($_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_p']->value['iteration'] : null)), ENT_QUOTES, 'UTF-8');?>
</a>
                    </li>
                <?php
}
}
?>
                <li class="page-item <?php if ($_smarty_tpl->tpl_vars['pagination']->value['current'] >= $_smarty_tpl->tpl_vars['pagination']->value['total']) {?>disabled<?php }?>">
                    <a class="page-link" href="?page=<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['pagination']->value['current']+1), ENT_QUOTES, 'UTF-8');?>
">Next</a>
                </li>
            </ul>
        </nav>
    <?php }
}
}
/* {/block "content"} */
}
