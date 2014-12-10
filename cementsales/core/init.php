<?php ob_start(); session_start();

$locallist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $locallist)){
    $session_local = false;
}else{
    $session_local = true;	
	
}

if(!$session_local){
	
	//error_reporting(0);
	require_once('recaptchalib.php');
	
}	

date_default_timezone_set('America/New_York');

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);

require('database/connect.php');
require("PasswordHash.php");

if ($current_file == 'ajax.php'){
	
	require '../../../core/functions/general.php';
	require '../../../core/functions/users.php';
	require '../../../core/functions/posts.php';
	require '../../../core/functions/messages.php';
	require '../../../core/functions/communities.php';
	require '../../../core/functions/points.php';
	require '../../../core/functions/notifications.php';
	
	
}else{

	require '../core/functions/general.php';
	require '../core/functions/users.php';
	require '../core/functions/posts.php';
	require '../core/functions/messages.php';
	require '../core/functions/communities.php';
	require '../core/functions/points.php';
	require '../core/functions/notifications.php';
	
	

}
require 'functions/general.php';
require 'functions/admin.php';
require 'functions/communities.php';
require 'functions/messages.php';
require 'functions/posts.php';
require 'functions/points.php';
require 'functions/services.php';


//user initialization
if (admin_access() === true) {
	$session_admin_id = $_SESSION['admin_id'];
	$admin_data = admin_data($session_admin_id, 'id', 'profile', 'initials', 'codename', 'email', 'type', 'status', 'community');
	
	if($admin_data['status'] > 1){
	
		logout();
	
	}
}

$errors = array();

if(isset($_GET['c'])){

	$community_in = $_GET['c'];

}

?>