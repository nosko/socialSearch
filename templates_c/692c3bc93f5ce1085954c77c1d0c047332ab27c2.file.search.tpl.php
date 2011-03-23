<?php /* Smarty version Smarty-3.0.7, created on 2011-03-22 23:33:14
         compiled from "./templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17082451764d8923aa09e3d9-63565364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '692c3bc93f5ce1085954c77c1d0c047332ab27c2' => 
    array (
      0 => './templates/search.tpl',
      1 => 1300833176,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17082451764d8923aa09e3d9-63565364',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<form method="POST" name="search-form">
	<input type="text" name="text">
	<input type="submit" name="submit">
</form>

<?php if ($_smarty_tpl->getVariable('submit')->value){?>
	<div style='float: left; margin-right: 10px;'><h2>Your key words</h2>
	<?php echo $_smarty_tpl->getVariable('yourWords')->value;?>

	</div>
	<div style='float: left; margin-right: 10px;'><h2>Web key words</h2>
	<?php echo $_smarty_tpl->getVariable('webWords')->value;?>

	</div>
	<div style='float: left; margin-right: 10px;'><h2>Facebook search</h2>
	<?php echo $_smarty_tpl->getVariable('fbWords')->value;?>

	</div>
	<div style='float: left; margin-right: 20px;'><h2>Prienik</h2>
	<?php echo $_smarty_tpl->getVariable('intersection')->value;?>

	<h2>Sortovany prienik</h2>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sortedIntersection')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		[<?php echo $_smarty_tpl->tpl_vars['item']->value[0];?>
 : <?php echo $_smarty_tpl->tpl_vars['item']->value[1];?>
 : <?php echo $_smarty_tpl->tpl_vars['item']->value[2];?>
] <?php echo $_smarty_tpl->tpl_vars['item']->value[3];?>
<br>
	<?php }} ?>
	</div>
	<div style='float: left; margin-right: 10px;'><h2>Statistika</h2>
	Data z reference spracovane za <?php echo $_smarty_tpl->getVariable('reference')->value;?>
<br>
	Data z wikipedie spracovane za <?php echo $_smarty_tpl->getVariable('wikipedia')->value;?>
<br>
	Data z google spracovane za <?php echo $_smarty_tpl->getVariable('google')->value;?>
<br>
	Data z wordnik spracovane za <?php echo $_smarty_tpl->getVariable('wordnik')->value;?>
<br>
	Data z FB search spracovane za <?php echo $_smarty_tpl->getVariable('facebook')->value;?>
<br>
	</div>
	<br clear="both">
<?php }?>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
