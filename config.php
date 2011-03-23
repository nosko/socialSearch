<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);


session_start();


require('./classes/classSettings.php');
require('./classes/classDictionary.php');
require('./classes/classTextPreparation.php');
require('./classes/classStopWordsDictionary.php');
require('./classes/classContext.php');
require('./classes/classFacebookDownload.php');
require('./classes/classContent.php');
require('./dibi/dibi.min.php');
require('./libs/Smarty.class.php');
require('class.xhttp.php');


$smarty 		= new Smarty;
$text 			= new TextPreparation();
$dictionary 	= new Dictionary();
$dictionaryWeb	= new Dictionary();
$fbDictionary 	= new Dictionary();
$context		= new Context();


$client_id     = Settings::$CLIENT_ID; # the application ID
if ( $_SERVER['REMOTE_ADDR'] == "127.0.0.1" ){
	$callbackURL   = 'http://localhost/DP/facebook/index.php';
} 
else 
{
	$callbackURL = Settings::$CALLBACK_URL;
}
$client_secret = Settings::$CLIENT_SECRET;
 # The URL of this script when you place it on your server, so that facebook will know where to redirect the user back
$extendedPermissions = 'publish_stream,create_event,manage_pages,offline_access'; # see http://developers.facebook.com/docs/authentication/permissions




// connects to MySQL using DSN
try {
	if ( $_SERVER['REMOTE_ADDR'] == "127.0.0.1" ){
		dibi::connect('driver=mysql&host=localhost&username='.Settings::$DB_LOCALHOST_USER.'&password='.Settings::$DB_LOCALHOST_PSSWD.'&database='.Settings::$DB_DATABASE.'&charset=utf8');
	} else {
		dibi::connect('driver=mysql&host=localhost&username='.Settings::$DB_WEB_USER.'&password='.Settings::$DB_WEB_PSSWD.'&database='.Settings::$DB_DATABASE.'&charset=utf8');
	}
} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
	exit(0);
}




/*
 * LOGOUT 
*/
if(isset($_GET['logout']) and isset($_SESSION['loggedin'])) {
	$_SESSION = array();
	session_destroy();
}

if(isset($_GET['signin'])) {

	# STEP 1: Redirect user to Facebook, to grant permission for our application
	$url = 'https://graph.facebook.com/oauth/authorize?' . xhttp::toQueryString(array(
		'client_id'    => $client_id,
		'redirect_uri' => $callbackURL,
		'scope'        => $extendedPermissions,
	));
	header("Location: $url", true, 303);
	die();
}

if(isset($_GET['code'])) {

	# STEP 2: Exchange the code that we have for an access token
	$data = array();
	$data['get'] = array(
		'client_id'     => $client_id,
		'client_secret' => $client_secret,
		'code'		=> $_GET['code'],
		'redirect_uri'  => $callbackURL,
		);

	$response = xhttp::fetch('https://graph.facebook.com/oauth/access_token', $data);

	if($response['successful']) {

		

		$data = xhttp::toQueryArray($response['body']);
		$_SESSION['access_token'] = $data['access_token'];
		$_SESSION['loggedin']     = true;

		$data = array();
		$data['get'] = array(
			'access_token'  => $_SESSION['access_token'],
			'fields' => 'id,name,accounts'
		);
		$response = xhttp::fetch('https://graph.facebook.com/me', $data);

		if($response['successful']) {
			$_SESSION['user'] = json_decode($response['body'], true);
			$_SESSION['user']['access_token'] = $_SESSION['access_token'];

		 } else {
			header('content-type: text/plain');
			print_r($response['body']);

		}

	} else {
		print_r($response['body']);
	}
}

if(isset($_GET['error']) and isset($_GET['error_reason']) and isset($_GET['error_description'])) {
	# error_reason: user_denied
	# error: access_denied
	# error_description: The user denied your request.
}

$smarty->assign("hasCreateProfile", 0, true);

if(!isset($_SESSION['loggedin'])) {
	$smarty->assign("logged", false,true);
} else {	
	$smarty->assign("logged", true ,true);
	$smarty->assign("name",	$_SESSION['user']['name'],true);
	$smarty->assign("id",	$_SESSION['user']['id'],true);
	$smarty->assign("token",$_SESSION['access_token'],true);
	$hasCreateProfile = dibi::query('SELECT count(*) FROM [user] WHERE [fb_id] = %i', $_SESSION['user']['id'])->fetchSingle();
	$smarty->assign("hasCreateProfile", $hasCreateProfile, true);
}






?>
