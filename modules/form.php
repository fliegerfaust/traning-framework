<?php

function registration($userdata) {
	$db = mysql_connect("localhost","root","123") or die (mysql_error ());
	mysql_select_db("framework" ,$db);
	mysql_set_charset('utf8');
	
	$login = $userdata['login'];
	$pass = $userdata['pass'];
	$filename = $userdata['filename'];
	
	mysql_real_escape_string($login);
	mysql_real_escape_string($pass);
	mysql_real_escape_string($filename);
	
	$insert = mysql_query("INSERT INTO `fusers` (`login`,`password`,`filename`) 
						   VALUES('$login','$pass','$filename')");
	
	if (!$insert) {
		return FALSE;
	}
	else {
		return TRUE;
	}
		
}

function form_get($request, $param1) {

  $messages = array();
 
  if (!empty($_COOKIE['save'])) {    
    setcookie('save', '', 100000);    
    $messages[] = '<div class="alert alert-success">
  				   <b> Успешно! </b> Спасибо, ваши данные сохранены!
				   </div>';
  }
  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);   

  // Выдаем сообщения об ошибках.
  if ($errors['name']) {
    setcookie('name_error', '', 100000);    
    $messages[] = '<div class="alert alert-error">Введите имя</div>';
  }
  if ($errors['email']) {    
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="alert alert-error">Введите e-mail</div>';
  }
  if (!empty($_COOKIE['email_uncor_error'])) {    
    $errors['email'] = !empty($_COOKIE['email_uncor_error']);
    setcookie('email_uncor_error', '', 100000);	
    $messages[] = '<div class="alert alert-error">Некорректный e-mail</div>';
  }
  if ($errors['bio']) {    
    setcookie('bio_error', '', 100000);    
    $messages[] = '<div class="alert alert-error">Заполните биографию</div>';
  }
  if (!empty($_COOKIE['agree_error']) ) {        
    setcookie('agree_error', '', 100000);	
    $messages[] = '<div class="alert alert-error">Необходимо ознакомиться с контрактом</div>';
  }

  
  /* Устраняем потенциальную уязвимость
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];  
  $values['birthyear'] = empty($_COOKIE['year_of_birth_value']) ? '' : $_COOKIE['year_of_birth_value'];  
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['superabilities1'] = empty($_COOKIE['superabilities1_value']) ? '' : $_COOKIE['superabilities1_value'];
  $values['superabilities2'] = empty($_COOKIE['superabilities2_value']) ? '' : $_COOKIE['superabilities2_value'];
  $values['superabilities3'] = empty($_COOKIE['superabilities3_value']) ? '' : $_COOKIE['superabilities3_value'];  
  $values['number_of_extremities'] = empty($_COOKIE['number_of_extremities_value']) ? '' : $_COOKIE['number_of_extremities_value'];
  $values['agree'] = empty($_COOKIE['agree_value']) ? '' : $_COOKIE['agree_value'];
  */
    $values = array();
    if (empty($_COOKIE['name_value'])) {
		$values['name'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['name_value']); 
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['name'] = $specchars_cleared;
	}
	
	if (empty($_COOKIE['email_value'])) {
		$values['email'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['email_value']);
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['email'] = $specchars_cleared;
	}
	
	if (empty($_COOKIE['year_of_birth_value'])) {
		$values['birthyear'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['year_of_birth_value']);
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['birthyear'] = intval($specchars_cleared);
	}
	
	if (empty($_COOKIE['number_of_extremities_value'])) {
		$values['number_of_extremities'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['number_of_extremities_value']);
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['number_of_extremities'] = intval($specchars_cleared);
	}
	
	if (empty($_COOKIE['sex_value'])) {
		$values['sex'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['sex_value']);
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['sex'] = $specchars_cleared;
	}
	
	if (empty($_COOKIE['bio_value'])) {
		$values['bio'] = '';
	}
	else {
		$tags_cleared = strip_tags($_COOKIE['bio_value']);
		$specchars_cleared = htmlspecialchars($tags_cleared);
		$values['bio'] = $specchars_cleared;
	}
	
	$values['superabilities1'] = empty($_COOKIE['superabilities1_value']) ? '' : $_COOKIE['superabilities1_value'];
 	$values['superabilities2'] = empty($_COOKIE['superabilities2_value']) ? '' : $_COOKIE['superabilities2_value'];
  	$values['superabilities3'] = empty($_COOKIE['superabilities3_value']) ? '' : $_COOKIE['superabilities3_value'];
  

  $output = theme('form', array(    
    'request' => $request,
	'values' => $values,
	'errors' => $errors,
	'messages' => $messages));
		
  return $output;
}


function form_post($request) {

  if ($_POST['send'] == '1')	   {
  
  $errors = FALSE;

  // поле name
  if (empty($_POST['name'])) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  //else {    
  setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  //}
  

  // поле email
  if (empty($_POST['email'])) {    
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {    
	  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		setcookie('email_uncor_error', '1', time() + 24 * 60 * 60);    
		$errors = TRUE;
	  }  
  }
  setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);

  // поле bio
  if (empty($_POST['bio'])) {    
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
//  else {    
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
//  }

// поле year_of_birth 
  setcookie('year_of_birth_value', $_POST['birthyear'], time() + 30 * 24 * 60 * 60);

// поле sex
  setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60);

// поле superabilities
 
	$superabilities = implode(",", $_POST['superabilities']);
 
 	$superabilities0 = substr_count($superabilities,'be') ? "1" : "" ;
 	$superabilities1 = substr_count($superabilities,'wall') ? "1" : "" ;
 	$superabilities2 = substr_count($superabilities,'lev') ? "1" : "" ;

  setcookie('superabilities1_value', $superabilities0, time() + 30 * 24 * 60 * 60);
  setcookie('superabilities2_value', $superabilities1, time() + 30 * 24 * 60 * 60);
  setcookie('superabilities3_value', $superabilities2, time() + 30 * 24 * 60 * 60);
  
// поле sex
  setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60);  

// поле number_of_extremities
  setcookie('number_of_extremities_value', $_POST['extremitiesnumber'], time() + 30 * 24 * 60 * 60);
  
  if (empty($_POST['agree'])) {
    setcookie('agree_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  setcookie('agree_value', $_POST['agree'], time() + 30 * 24 * 60 * 60);
  
  if ($errors) {
    return redirect();
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('bio_error', '', 100000);
	setcookie('email_uncor_error', '', 100000);	
	setcookie('agree_error', '', 100000);	
  }

  
  $xml = new SimpleXMLElement('<document/>');  
  $xml->addAttribute('type', 'documentary');
 
  $child = strip_tags($xml->addChild('name', $_POST['name']));
  $child = strip_tags($xml->addChild('email', $_POST['email']));
  $child = strip_tags($xml->addChild('year_of_birth', $_POST['birthyear']));
  $child = strip_tags($xml->addChild('sex', $_POST['sex']));
  $child = strip_tags($xml->addChild('number_of_extremities', $_POST['extremitiesnumber']));
  $superabilities = $xml->addChild('superabilities');
  foreach ($_POST['superabilities'] as $selectedOption)
	$superabilities->addChild('superability', $selectedOption);
  $child = strip_tags($xml->addChild('bio', $_POST['bio']));
   
  $s = $xml->asXML();
  
  $fname = 'xmlForm' . time();
  
  $f = '../xml/' . $fname . '.xml';
  
  $result = file_put_contents($f, $s);  
  
  if ($result !== FALSE) {
  	setcookie('save', '1');
  	$userdata = array(
  		'login' => 'user' . uniqid(),
  		'pass' => 'pass' . uniqid(),
   		'filename' => $fname
  	);
  	
  	if (registration($userdata)) {
  		$output = theme('regsuccess', array(
  			'userdata' => $userdata ));
 		return $output;
  	}
  	else {
		$output = theme('regerror');
 		return $output;
  	}
  }
  else {
  	$output = theme('regerror');
  	return $output;
  }
  
  }

  if ($_POST['cookies'] == '1')	   {		    
		foreach ($_COOKIE as $element => $value) {      	
			 setcookie($element, '', 100000);    
		}		
		return redirect();
	}	 
}