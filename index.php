<?php require_once('./core/init.php');

	defined('BASEPATH') OR exit('No direct script access allowed');

	if(isset($_GET['action'])) {
		$action = addslashes(trim(htmlentities($_GET['action'])));
		
		$action = ($action == '') ? 'home' : $action;
	}
	else {
		$action = 'home';
	}
	
	if($action == 'home') {
		require_once(BASEPATH.'/controllers/HomeController.php');
	}
	else if($action == 'login') {
		require_once(BASEPATH.'/controllers/LoginController.php');
	}
	else if($action == 'register') {
		require_once(BASEPATH.'/controllers/RegisterController.php');
	}
	else if($action == 'logout') {
		require_once(BASEPATH.'/controllers/LogoutController.php');
	}
	else if($action == 'process') {
		if(isset($_GET['subaction'])) {
			$subaction = addslashes(trim(htmlentities($_GET['subaction'])));
			require_once(BASEPATH.'/'.$action.'/'.$subaction.'.php');
		}
		else {
			require_once(BASEPATH.'/controllers/ErrorController.php');
		}
	}
	else {
		require_once(BASEPATH.'/controllers/ErrorController.php');
	}
?>