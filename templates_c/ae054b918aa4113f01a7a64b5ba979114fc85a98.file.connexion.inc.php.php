<?php /* Smarty version Smarty-3.1.15, created on 2013-11-18 14:33:01
         compiled from "includes\connexion.inc.php" */ ?>
<?php /*%%SmartyHeaderCode:7388528a170d1b95e9-73675053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae054b918aa4113f01a7a64b5ba979114fc85a98' => 
    array (
      0 => 'includes\\connexion.inc.php',
      1 => 1384776373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7388528a170d1b95e9-73675053',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_528a170d1c8ff0_55401881',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528a170d1c8ff0_55401881')) {function content_528a170d1c8ff0_55401881($_smarty_tpl) {?><<?php ?>?php
	//connexion base de données blog
	mysql_connect('localhost', 'root' ,'');
	mysql_select_db('blog');

	//creation d'une session
	session_start();
	
	//verif utilisateur
	if(isset($_COOKIE['sid'])){
		$sid=mysql_real_escape_string($_COOKIE['sid']);
		$sql="SELECT email FROM utilisateurs WHERE sid='$sid'";
		$query=mysql_query($sql);
		echo mysql_error();
		if($infos_util=mysql_fetch_array($query)){
			
			$connecte=true;
		}
		else
		{
			$connecte=false;
		}
	}
	else{
		$connecte=false;
	}<?php }} ?>
