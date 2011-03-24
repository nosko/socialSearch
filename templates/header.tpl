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
		margin: 5px;	
	}
	
	.warning {
		color: #333;
		background:#fff9d7;
		border: 1px solid #e2c822;
		font-weight: bold;
		padding: 5px;
		width: auto;
		margin: 5px;	
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
		{if $logged}
		    <li {if $menu eq "index"}class="selected"{/if}><a href="./index.php">About</a></li>
			<li {if $menu eq "profile"}class="selected"{/if}><a href="./profile.php">Profile</a></li>
			{if $hasCreateProfile}
				<li {if $menu eq "myWords"}class="selected"{/if}><a href="./myWords.php">My Words</a></li>
			{/if}
			<li {if $menu eq "search"}class="selected"{/if}><a href="./search.php">Search</a></li>
			<li><a href="./?logout">Logout</a></li>
		{else}
	    		<li><a href="./?signin">Login</a></li>
		{/if}
	</ul>
	</div>
