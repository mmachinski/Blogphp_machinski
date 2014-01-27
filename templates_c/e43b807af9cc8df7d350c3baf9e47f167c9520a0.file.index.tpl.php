<?php /* Smarty version Smarty-3.1.15, created on 2014-01-22 14:23:47
         compiled from "index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21177528243cb670142-80346727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e43b807af9cc8df7d350c3baf9e47f167c9520a0' => 
    array (
      0 => 'index.tpl',
      1 => 1390400619,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21177528243cb670142-80346727',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_528243cb72b968_71568736',
  'variables' => 
  array (
    'rech' => 0,
    'nb' => 0,
    'list_news' => 0,
    'page' => 0,
    'nb_pages' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528243cb72b968_71568736')) {function content_528243cb72b968_71568736($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['rech']->value) {?>
	<h2><?php echo $_smarty_tpl->tpl_vars['nb']->value;?>
 Resultat(s) pour la recherche "<?php echo $_smarty_tpl->tpl_vars['rech']->value;?>
"</h2>
<?php } else { ?>
	<h2>Nombres d'article au total: <?php echo $_smarty_tpl->tpl_vars['nb']->value;?>
</h2>
<?php }?>
<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list_news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
<?php echo $_smarty_tpl->getSubTemplate ('partial/_article.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } ?>
<ul class='pagination'>
	<?php if ($_smarty_tpl->tpl_vars['page']->value!=1) {?>
		<a href='index.php?p=<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
'> << </a>
	<?php }?>
	<?php $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['p']->step = 1;$_smarty_tpl->tpl_vars['p']->total = (int) ceil(($_smarty_tpl->tpl_vars['p']->step > 0 ? $_smarty_tpl->tpl_vars['nb_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nb_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['p']->step));
if ($_smarty_tpl->tpl_vars['p']->total > 0) {
for ($_smarty_tpl->tpl_vars['p']->value = 1, $_smarty_tpl->tpl_vars['p']->iteration = 1;$_smarty_tpl->tpl_vars['p']->iteration <= $_smarty_tpl->tpl_vars['p']->total;$_smarty_tpl->tpl_vars['p']->value += $_smarty_tpl->tpl_vars['p']->step, $_smarty_tpl->tpl_vars['p']->iteration++) {
$_smarty_tpl->tpl_vars['p']->first = $_smarty_tpl->tpl_vars['p']->iteration == 1;$_smarty_tpl->tpl_vars['p']->last = $_smarty_tpl->tpl_vars['p']->iteration == $_smarty_tpl->tpl_vars['p']->total;?>
		
		<a href='index.php?p=<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
 </a>

	<?php }} ?>
		
		<?php if ($_smarty_tpl->tpl_vars['page']->value<$_smarty_tpl->tpl_vars['nb_pages']->value) {?>
			<a href='index.php?p=<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
'> >> </a></ul>
		<?php }?><?php }} ?>
