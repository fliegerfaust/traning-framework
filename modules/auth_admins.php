<?php

// auth_basic.php - HTTP Authentication Script v 1.0 for admins
// they haven't access to framework/user_management
//#############################################################

function auth(&$request, $r) {
  $db = mysql_connect("localhost","root","123") or die (mysql_error ());
  mysql_select_db("framework" ,$db);
  $sql = mysql_query("SELECT * FROM `users`" ,$db);
  mysql_set_charset('utf8');
  
  while ($tablerows = mysql_fetch_row($sql)) {
    $users = array(
      'admin' => '123',
      $tablerows[1] => $tablerows[2],
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
}