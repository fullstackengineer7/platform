<?php
/* Smarty version 4.5.8, created on 2026-11-08 13:42:06
  from '/var/www/html/resources/templates/layouts/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.8',
  'unifunc' => 'content_6af07c2eb0f470_58559227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9fc21b49c9c4f829994d3cbaa8aab494de8d3c9f' => 
    array (
      0 => '/var/www/html/resources/templates/layouts/main.tpl',
      1 => 1794145326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6af07c2eb0f470_58559227 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? "Blog Platform" ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog Platform</a>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7242829116af07c2eb0f005_64240200', "content");
?>

    </main>

    <footer class="bg-dark text-white-50 text-center py-3">
        &copy; 2026 Blog Platform
    </footer>
</body>
</html>
<?php }
/* {block "content"} */
class Block_7242829116af07c2eb0f005_64240200 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_7242829116af07c2eb0f005_64240200',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "content"} */
}
