<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	if($id_user) {
		$session->destroy();
		header('Location: '.$DOMAIN_HOME.'/login');
	}
	else {
		header('Location: '.$DOMAIN_HOME.'/login');
	}