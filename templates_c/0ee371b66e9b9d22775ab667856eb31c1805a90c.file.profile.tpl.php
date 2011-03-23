<?php /* Smarty version Smarty-3.0.7, created on 2011-03-19 13:51:45
         compiled from "./templates/profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10643802754d84a6e13b9810-14035378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ee371b66e9b9d22775ab667856eb31c1805a90c' => 
    array (
      0 => './templates/profile.tpl',
      1 => 1300406173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10643802754d84a6e13b9810-14035378',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<style>
	form input {
		font-weight: bold;
		background-color: #5B74A8; 
		color: white;
		border-width: 1px;
		border-bottom-color: #1A356E;
		border-left-color: #29447E;
		border-right-color: #29447E;
		border-top-color: #29447E;
		cursor: hand;
	

	}
</style>

<br><br>
<form name="profile-action" method="POST" action="profile.php">
	<?php if ($_smarty_tpl->getVariable('hasCreateProfile')->value==0){?>
		<div class="warning">
		Vyzera to, ze este nemate vygenerovany svoj profil. Vygenerujete ho stlacenim tlacidla Generate.
		</div>
		<input type="submit" name="generate" value="generate"> 
	<?php }else{ ?>
		<input type="submit" name="delete" value="delete"> Vase slova z profilu si mozete prezriet na zalozke MyWords.
	<?php }?>
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
