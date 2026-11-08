<?php
/* Smarty version 4.5.8, created on 2026-11-08 13:42:06
  from '/var/www/html/resources/templates/pages/article.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.8',
  'unifunc' => 'content_6af07c2ec1cf71_62173459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '767a051a1336f9755c00b7dfcdcb72f2ba8d5111' => 
    array (
      0 => '/var/www/html/resources/templates/pages/article.tpl',
      1 => 1794145326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6af07c2ec1cf71_62173459 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17121481126af07c2ec19a11_73074308', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/main.tpl");
}
/* {block "content"} */
class Block_17121481126af07c2ec19a11_73074308 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_17121481126af07c2ec19a11_73074308',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
</li>
        </ol>
    </nav>

    <article class="card shadow-sm mb-4">
        <?php if ($_smarty_tpl->tpl_vars['article']->value->getImagePath()) {?>
            <img src="/uploads/<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getImagePath()), ENT_QUOTES, 'UTF-8');?>
" class="card-img-top" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
">
        <?php }?>
        <div class="card-body">
            <h1 class="card-title"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
</h1>
            <p class="text-muted small"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getCreatedAt()->format('d.m.Y')), ENT_QUOTES, 'UTF-8');?>
 &middot; <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getViews()), ENT_QUOTES, 'UTF-8');?>
 views</p>
            <p class="lead"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getDescription()), ENT_QUOTES, 'UTF-8');?>
</p>
            <div><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['article']->value->getContent()), ENT_QUOTES, 'UTF-8');?>
</div>
        </div>
    </article>

    <?php if ($_smarty_tpl->tpl_vars['related']->value) {?>
        <h4 class="mb-3">Related articles</h4>
        <div class="row g-3">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['related']->value, 'rel');
$_smarty_tpl->tpl_vars['rel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->do_else = false;
?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <a class="text-decoration-none" href="/article/<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['rel']->value->getSlug()->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['rel']->value->getTitle()->value), ENT_QUOTES, 'UTF-8');?>
</a>
                        </div>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    <?php }
}
}
/* {/block "content"} */
}
