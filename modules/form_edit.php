<?php

function form_edit_get($request) {
  $fname = $_SESSION['fname'];
  
  $f = '../xml/' . $fname . '.xml';
  
  if (file_exists($f)) {
  	
  	$xml = simplexml_load_file($f);
  
  	$array = array(
	  "superability1" => 0,
	  "superability2" => 0,
	  "superability3" => 0
	);
	$value = $xml->superabilities;
	foreach ($value->children() as $at => $val) {
		if ($val == 'be') {
		  $array['superability1'] = 1;
		}
		if ($val == 'wall') {
	      $array['superability2'] = 1;
	    }
		if ($val == 'lev') {
		  $array['superability3'] = 1;
		}
  	}
  
  	/* Потенциальная уязвиомость устранена */
  	$valueName = htmlspecialchars(strip_tags($xml->name));
  	$valueEmail = htmlspecialchars(strip_tags($xml->email));
  	$valueBirthday = htmlspecialchars(strip_tags($xml->year_of_birth));
  	$valueExtr = htmlspecialchars(strip_tags($xml->number_of_extremities));
  	$valueSex = htmlspecialchars(strip_tags($xml->sex));
  	$valueSuper = $array;
  	$valueBio = htmlspecialchars(strip_tags($xml->bio));
  
  	$values = array(
  		"name" => $valueName,
  		"email" => $valueEmail,
  		"birthyear" => $valueBirthday,
  		"number_of_extremities" => $valueExtr,
  		"sex" => $valueSex,
  		"superabilities" => $valueSuper,
  		"bio" => $valueBio
  	);
  

  	$output = theme('form_edit', array(    
    	'login' => $_SESSION['login'],
		'values' => $values,
  		'fname' => $fname));
		
  	return $output;
	}
	else {
		$output = theme('report');
		return $output;
	}
	
}

function form_edit_post($request) {
	
	if ($_POST['send'] == '1') {
	
	$filename = $_SESSION['fname'];
	$file = '../xml/' . $filename . '.xml';
	
	$errors = FALSE;
	
	if (empty($_POST['name'])) {
		$report[] = 'Укажите имя';
		$errors = TRUE;
	}
	if (empty($_POST['email'])) {
		$report[] = 'Укажите email';
		$errors = TRUE;
	}
	else {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$report[] = 'Некорректный email';
			$errors = TRUE;
		}
	}
	if (empty($_POST['birthyear'])) {
		$report[] = 'Укажите дату рождения';
		$errors = TRUE;
	}
	if (empty($_POST['extremitiesnumber'])) {
		$report[] = 'Укажите количество конечностей';
		$errors = TRUE;
	}
	if (empty($_POST['sex'])) {
		$report[] = 'Укажите пол';
		$errors = TRUE;
	}
	if (empty($_POST['bio'])) {
		$report[] = 'Укажите биографию';
		$errors = TRUE;
	}
	
	if ($errors) {
		$report[] = '<font color="red"><b>Файл не был сохранен!</b></font>';
		$output = theme('report', array(
				'reports' => $report ));
		return $output;
	}
	
	unlink($file);

	$xml = new SimpleXMLElement('<document/>');  
  	$xml->addAttribute('type', 'documentary');
 
  	$child = strip_tags($xml->addChild('name', $_POST['name']));
  	$child = strip_tags($xml->addChild('email', $_POST['email']));
  	$child = strip_tags($xml->addChild('year_of_birth', $_POST['birthyear']));
  	$child = strip_tags($xml->addChild('sex', $_POST['sex']));
  	$child = strip_tags($xml->addChild('number_of_extremities', $_POST['extremitiesnumber']));
  	$child = strip_tags($xml->addChild('sex', $_POST['sex']));
  	$superabilities = $xml->addChild('superabilities');
 	foreach ($_POST['superabilities'] as $selectedOption)
		$superabilities->addChild('superability', $selectedOption);
 	$child = strip_tags($xml->addChild('bio', $_POST['bio']));
   
  	$s = $xml->asXML();
  
  	$result = file_put_contents($file, $s); 

  	$report[] = '<font color="green">Файл успешно сохранён!</font>';
	
  	$output = theme('report',array('reports' => $report));
  		
  	return $output;
	}
}	