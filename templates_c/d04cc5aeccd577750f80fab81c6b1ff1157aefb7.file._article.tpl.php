<?php /* Smarty version Smarty-3.1.15, created on 2014-01-22 15:29:02
         compiled from "partial\_article.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1976528a3f4594abb7-71395627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd04cc5aeccd577750f80fab81c6b1ff1157aefb7' => 
    array (
      0 => 'partial\\_article.tpl',
      1 => 1390404537,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1976528a3f4594abb7-71395627',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_528a3f45a44be5_02636624',
  'variables' => 
  array (
    'article' => 0,
    'connecte' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a3f45a44be5_02636624')) {function content_528a3f45a44be5_02636624($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wampserver\\www\\Blogphp\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_escape')) include 'C:\\wampserver\\www\\Blogphp\\libs\\plugins\\modifier.escape.php';
?>			<h3><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['article']->value['titre'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h3>
			<h5>Créé le <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['date'],"%d %B %Y");?>
</h5>
			<p><?php echo nl2br(smarty_modifier_escape($_smarty_tpl->tpl_vars['article']->value['texte'], 'htmlalt'));?>
</p>
			<?php if ($_smarty_tpl->tpl_vars['article']->value['image']) {?>
				<img src="<?php echo $_smarty_tpl->tpl_vars['article']->value['image'];?>
" width="200">
                                
			<?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['connecte']->value) {?>
			<a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-primary">Modifier</a>
			<a href="supprimer_article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
" class="btn btn-primary">Supprimer</a>
			<?php }?>
			
<?php }} ?>
