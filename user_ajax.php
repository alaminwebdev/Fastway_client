<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'user_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}

if ($action == 'signup') {
	$save = $crud->signup();
	if ($save)
		echo $save;
}

if ($action == 'save_parcel') {
	$save = $crud->save_parcel();
	if ($save)
		echo $save;
}









ob_end_flush();
