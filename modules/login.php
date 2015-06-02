<?php

function getFname($user) {
  $db = mysql_connect("localhost","root","123") or die (mysql_error ());
  mysql_select_db("framework" ,$db);
  $sql = mysql_query("SELECT * FROM `fusers`" ,$db);
  mysql_set_charset('utf8');
  
  while ($tablerows = mysql_fetch_row($sql)) {
  	if ($tablerows[0] == $user['login']) {
  		$currentFname = $tablerows[2];
  		return $currentFname;
  	}
  }
}


function login_get($request) {
	session_start();
	if (!empty($_SESSION['login'])) {
		return array(
			'headers' => array('Location: form_edit'),
		);
	}
	
	$error = !empty($_COOKIE['login_error']);
	
	if ($error) {
		setcookie('login_error', '', 100000);
	}
	
	$output = theme('login', array(
		'errors' => $error
	));
	return $output;
}

function login_post($request) {

	$login_value = $_POST['login'];
	$password_value = $_POST['password'];
	
	$errors = FALSE;
	
    if (empty($login_value)) {
		setcookie('login_error', '1', time() + 24 * 60 * 60);
		$errors = TRUE;
	}
	
	if (empty($password_value)) {
		setcookie('login_error', '1', time() + 24 * 60 * 60);
		$errors = TRUE;
	}
	
	$db = mysql_connect("localhost","root","123") or die (mysql_error ());
  	mysql_select_db("framework" ,$db);
  	$sql = mysql_query("SELECT * FROM `fusers`" ,$db);
  	mysql_set_charset('utf8');
	
	$correct_values = array();
	while ($tablerows = mysql_fetch_row($sql)) {
  		if ($tablerows[0] == $login_value) {
  			$correct_values['login'] = $tablerows[0];
			$correct_values['password'] = $tablerows[1];
  		}
  	}
	
	if (!empty($correct_values)) {
		if ($correct_values['login'] != $login_value || $correct_values['password'] != $password_value) {
			setcookie('login_error', '1', time() + 24 * 60 * 60);
			$errors = TRUE;
		}
	}
	else {
		setcookie('login_error', '1', time() + 24 * 60 * 60);
		$errors = TRUE;
	}
	
	if ($errors) {
		return array(
			'headers' => array('Location: login'),
		);
	}
	else {
		setcookie('login_error', '', 100000);
	}
	
	$user = array(
		'login' => $login_value,
	);
	
	session_start();
	$_SESSION['login'] = $login_value;
	$_SESSION['fname'] = getFname($user);
	
	return array(
			'headers' => array('Location: form_edit'),
		); 
}

?>