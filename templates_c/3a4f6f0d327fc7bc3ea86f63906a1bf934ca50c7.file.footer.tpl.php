<?php /* Smarty version Smarty-3.0.7, created on 2011-03-17 11:16:12
         compiled from "./templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17442322614d81df6c556635-06518775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1300322350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17442322614d81df6c556635-06518775',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('logged')->value){?>
<hr>
<font style='font-align: right;' size='-70%'>Vitaj <?php echo $_smarty_tpl->getVariable('name')->value;?>
 [<?php echo $_smarty_tpl->getVariable('id')->value;?>
 - <?php echo $_smarty_tpl->getVariable('token')->value;?>
]</font>
<?php }?>
</body>
</html>
