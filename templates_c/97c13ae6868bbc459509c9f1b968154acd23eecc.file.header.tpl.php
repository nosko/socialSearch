<?php /* Smarty version Smarty-3.0.7, created on 2011-03-19 14:59:10
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12961505034d84b6ae9124a6-19007904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1300543132,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12961505034d84b6ae9124a6-19007904',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
	
	body {
		margin: 0;
		padding: 0;
		font-family: "lucida grande", tahoma, verdana, arial, sans-serif;  
		font-size: 12px;
	}
	
	div#page-navigation {
		background-color: #3B5998;
		width:	100%;
		display: block;
		height: 19px;
		text-align: right;
		border-bottom: solid #6d84b4 5px;
	}
	
	div#page-navigation ul {
		list-style-type: none;
		margin: auto;
	}
	
	div#page-navigation li {
		float: left;
		padding-right: 10px;
		padding-left: 10px;
		text-align: center;
		display: block;
	}
	
	div#page-navigation ul li:hover {
		background-color: #6d84b4;
	}
	
	div#page-navigation ul li a {
		margin: auto;
		font-size: 14px;
		color: #FFFFFF;
		text-decoration: none;
		display: block;
		height: 100%;
	}
	
	.selected {
		background-color: #6d84b4;
	}
	
	.error {
		color: #333;
		background:#ffebe8;
		border: 1px solid #dd3c10;
		font-weight: bold;
		padding: 5px;
		width: auto;
	}
	
	.warning {
		color: #333;
		background:#fff9d7;
		border: 1px solid #e2c822;
		font-weight: bold;
		padding: 5px;
		width: auto;	
	}
	
	.results{
			color: #3B5998;
			list-style-type: circle;
	}
	
	.results li {
			list-style-type: circle;
	}
	
	</style>
	<div id="page-navigation">
	
	<ul>	
		<?php if ($_smarty_tpl->getVariable('logged')->value){?>
		    <li <?php if ($_smarty_tpl->getVariable('menu')->value=="index"){?>class="selected"<?php }?>><a href="./index.php">About</a></li>
			<li <?php if ($_smarty_tpl->getVariable('menu')->value=="profile"){?>class="selected"<?php }?>><a href="./profile.php">Profile</a></li>
			<?php if ($_smarty_tpl->getVariable('hasCreateProfile')->value){?>
				<li <?php if ($_smarty_tpl->getVariable('menu')->value=="myWords"){?>class="selected"<?php }?>><a href="./myWords.php">My Words</a></li>
			<?php }?>
			<li <?php if ($_smarty_tpl->getVariable('menu')->value=="search"){?>class="selected"<?php }?>><a href="./search.php">Search</a></li>
			<li><a href="./?logout">Logout</a></li>
		<?php }else{ ?>
	    		<li><a href="./?signin">Login</a></li>
	<?php }?>
	</ul>
	</div>
