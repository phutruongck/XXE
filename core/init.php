<?php

	define('BASEPATH', realpath($_SERVER["DOCUMENT_ROOT"]));

	require_once(BASEPATH.'/models/Database.php');
	require_once(BASEPATH.'/models/Session.php');

	$db = new Database();
	$db->set_char('UTF8');

	$session = new Session();
	$session->start();
	$session_userdata = $session->get();

	$id_user = ($session_userdata) ? $session_userdata : '';

	date_default_timezone_set('Asia/Ho_Chi_Minh'); 
	$date_current = '';
	$date_current = date("Y-m-d H:i:s");

	if($id_user) {
   		$data_user 	= $db->fetch_assoc("SELECT * FROM `tb_users` WHERE `ID_USER` = '$id_user'", 1);
   		$permission = $data_user['PERMISSION'];
	}
	else {
		$id_user = '';
	}

	$DOMAIN_HOME = 'http://localhost';