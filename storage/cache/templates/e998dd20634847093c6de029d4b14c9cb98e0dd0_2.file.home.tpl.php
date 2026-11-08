<?php
/* Smarty version 4.5.8, created on 2026-11-08 13:42:06
  from '/var/www/html/resources/templates/pages/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.8',
  'unifunc' => 'content_6af07c2eafdb68_73515468',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e998dd20634847093c6de029d4b14c9cb98e0dd0' => 
    array (
      0 => '/var/www/html/resources/templates/pages/home.tpl',
      1 => 1794145326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6af07c2eafdb68_73515468 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16358184916af07c2eaf7ca1_07837702', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/main.tpl");
}
/* {block "content"} */
class Block_16358184916af07c2eaf7ca1_07837702 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_16358184916af07c2eaf7ca1_07837702',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <h1 class="mb-4">Categories</h1>
    <div class="row g-4">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-decoration-none" href="/category/<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['item']->value['category']->getSlug()->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['item']->value['category']->getName()->value), ENT_QUOTES, 'UTF-8');?>
</a>
                        </h5>
                        <p class="text-muted"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['item']->value['category']->getDescription()), ENT_QUOTES, 'UTF-8');?>
</p>
                        <h6>Latest articles</h6>
                        <ul class="list-unstyled mb-0">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['articles'], 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
                                <li class="mb-1"><a href="/article/<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getSlug()->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
</a></li>
                            <?php
}
if ($_smarty_tpl->tpl_vars['article']->do_else) {
?>
                                <li class="text-muted">No articles yet</li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
}
if ($_smarty_tpl->tpl_vars['item']->do_else) {
?>
            <p>No categories yet.</p>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php
}
}
/* {/block "content"} */
}
