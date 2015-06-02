<?php

// auth_webservice.php - HTTP Authentication Script v 1.0 for users and superadmin
//################################################################################

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

function auth(&$request, $r) {
  $db = mysql_connect("localhost","root","123") or die (mysql_error ());
  mysql_select_db("framework" ,$db);
  $sql = mysql_query("SELECT * FROM `fusers`" ,$db);
  mysql_set_charset('utf8');
  
  while ($tablerows = mysql_fetch_row($sql)) {
    $users = array(
      $tablerows[0] => $tablerows[1]
    );
  }
  
  if (empty($user) && !empty($_SERVER['PHP_AUTH_USER'])) {
    $user = array(
      'login' => $_SERVER['PHP_AUTH_USER'], 	
      'pass' => $users[$_SERVER['PHP_AUTH_USER']]
    );
    $request['user'] = $user;
  }
  if (!isset($_SERVER['PHP_AUTH_USER']) || empty($user) || $_SERVER['PHP_AUTH_USER'] != $user['login'] || $_SERVER['PHP_AUTH_PW'] != $user['pass']) {
    unset($user);
    $response = array(
      'headers' => array(sprintf('WWW-Authenticate: Basic realm="%s"', conf('sitename')), 'HTTP/1.0 401 Unauthorized'),
      'entity' => theme('401', $request),
    );
    return $response;
  }
  
 session_start();
  if (!isset($_SESSION['fname'])) {
  	$_SESSION['fname'] = getFname($user);
  } 
  else {
  	unset($_SESSION['fname']);
  	$_SESSION['fname'] = getFname($user);
  }
  
}