<?php

# arvin castro, arvin@sudocode.net
# http://sudocode.net/article/368/how-to-get-the-access-token-for-a-facebook-application-in-php
# February 7, 2011


require("config.php");
require_once 'class.xhttp.php';




if(!isset($_SESSION['loggedin'])) {
	$smarty->assign("logged", false,true);
} else {	
	$smarty->assign("logged", true ,true);
	$smarty->assign("menu", "index", true);
}

$smarty->display('index.tpl');
?>

