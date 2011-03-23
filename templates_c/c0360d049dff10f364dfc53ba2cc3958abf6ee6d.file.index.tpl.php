<?php /* Smarty version Smarty-3.0.7, created on 2011-03-17 17:54:07
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5756575694d823cafc8dba1-94321722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1300380842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5756575694d823cafc8dba1-94321722',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<br>
<?php if ($_smarty_tpl->getVariable('logged')->value){?>
Verzia 0.00001 alfa RC<br><br>
Comming soon...<br><br>

Zatial velmi strucne info:<br>
V zalozke profile vygenerovat profile<br>
V zalozke My words budu nasledne dostupne slova<br>
<?php }else{ ?>
<div class="error">Prihlaste sa prosim.</div>
<?php }?>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
