<?php 

function logout_get($request) {
	session_start();
	unset($_SESSION["login"]);
	unset($_SESSION["fname"]);
	session_destroy();
	return array(
		'headers' => array('Location: login'),
	);
}