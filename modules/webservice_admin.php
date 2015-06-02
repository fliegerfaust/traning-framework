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

function webservice_admin_get($request) {
	
	if (empty($request['get']['file'])) {
		$path = '../xml';
		$file_list = array_diff(scandir($path), array('..', '.'));
        
        return array(
        	'headers' => array('HTTP/1.1 200 OK', 'Content-type: application/xml'),
        	'entity' => theme('xml_listing', array(
  		'filelist' => $file_list )),
        );
	}
	else {
	$f = '../xml/' . $request['get']['file'];
		
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
  		$valueSuper = $array['superability1'] . " " . $array['superability2'] . " " . $array['superability3'];
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
			
			return array(
					'headers' => array('HTTP/1.1 200 OK', 'Content-type: application/xml'),
					'entity' => theme('xml_file', array(
							'file' => $values )),
			);
			
		}
		else {
			return array(
					'headers' => array('HTTP/1.1 404 Not Found', 'Content-type: application/xml'),
					'entity' => theme('xml_error', 
				     array(
					   'error_code' => '404',
					   'error_msg' => 'Ресурс не найден'			
			         )),
			);
		}	
	}
	
}


function webservice_admin_post($request) {
	
	$file = file_get_contents('php://input');
	
	if (!empty($file)) {

		$xml = simplexml_load_string($file);
  
	$array = array(
	  "superability1" => "",
	  "superability2" => "",
	  "superability3" => ""
	);
	$value = $xml->superabilities;
	foreach ($value->children() as $at => $val) {
		if ($val == 'be') {
		  $array['superability1'] = "be";
		}
		if ($val == 'wall') {
	      $array['superability2'] = "wall";
	    }
		if ($val == 'lev') {
		  $array['superability3'] = "lev";
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
  			"extremitiesnumber" => $valueExtr,
  			"sex" => $valueSex,
  			"superabilities" => $valueSuper,
  			"bio" => $valueBio
  		);
  		
  		$errors = FALSE;
  		$error_messages = array();
	
		if (empty($values['name'])) {
			$error_messages[] = 'Name is empty';
			$errors = TRUE;
		}
		if (empty($values['email'])) {
			$error_messages[] = 'Email is empty<br>';
			$errors = TRUE;
		}
		else {
 			if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
 				$error_messages[] = 'Email is invalid';
 				$errors = TRUE;
 			}
		}
		if (empty($values['birthyear'])) {
			$error_messages[] = 'Year of birth is empty<br>';
			$errors = TRUE;
		}
		if (empty($values['extremitiesnumber'])) {
			$error_messages[] = 'Extremities number is empty<br>';
			$errors = TRUE;
		}
		if (empty($values['sex'])) {
			$error_messages[] = 'Sex is empty<br>';
			$errors = TRUE;
		}
		if (empty($values['superabilities'])) {
			$error_messages[] = 'Superabilities are empty<br>';
			$errors = TRUE;
		}
		if (empty($values['bio'])) {
			$error_messages[] = 'Bio is empty<br>';
			$errors = TRUE;
		}
	
		if ($errors == FALSE) {
		
			$xml = new SimpleXMLElement('<document/>');  
  			$xml->addAttribute('type', 'documentary');
 
  			$child = strip_tags($xml->addChild('name', $values['name']));
  			$child = strip_tags($xml->addChild('email', $values['email']));
  			$child = strip_tags($xml->addChild('year_of_birth', $values['birthyear']));
  			$child = strip_tags($xml->addChild('sex', $values['sex']));
  			$child = strip_tags($xml->addChild('number_of_extremities', $values['extremitiesnumber']));
  			$superabilities = $xml->addChild('superabilities');
 			foreach ($values['superabilities'] as $selectedOption)
				$superabilities->addChild('superability', $selectedOption);
 			$child = strip_tags($xml->addChild('bio', $values['bio']));
   
  			$s = $xml->asXML();
			$f = "xmlForm" . time();
			$filepath = '../xml/' . $f . ".xml";
			$result = file_put_contents($filepath, $s);
	
			$reg_user = array(
				'login' => 'user' . uniqid(),
				'pass' => 'pass' . uniqid(),
				'filename' => $f
			);
			
			registration($reg_user);
		
			return array(
				'headers' => array('HTTP/1.1 201 Created', 'Content-type: application/xml'),
				'entity' => theme('xml_reguser', array(
						'user' => $reg_user ))
			 			);
			} else {
				return array(
					'headers' => array('HTTP/1.1 400 Bad Request', 'Content-type: application/xml'),
					'entity' => theme('xml_error',
							array(
									'error_code' => '400',
									'error_msg' => 'Неверный запрос',
									'error_messages' => $error_messages
							)),
		        	);
			}
					
	}	
}


function webservice_admin_delete($request) {
	
	$filename = end(array_values(explode("/", $request['url'])));
	
	//$filename = '../xml/' . $request['delete']['file'];
	
	if (empty($filename)) {
		return array(
					'headers' => array('HTTP/1.1 404 Not Found', 'Content-type: application/xml'),
					'entity' => theme('xml_error', 
				     array(
					   'error_code' => '404',
					   'error_msg' => 'Ресурс не найден'			
			         )),
			);
	}
	else {
		$filepath = '../xml/' . $filename . '.xml';
		if (file_exists($filepath)) {
			if (unlink($filepath)) {
				return array(
					'headers' => array('HTTP/1.1 204 No Content'),
			    );
			}
			else {
				return array(
				'headers' => array('HTTP/1.1 500 Internal Server Error', 'Content-type: application/xml'),
				'entity' => theme('xml_error',
						array(
								'error_code' => '500',
								'error_msg' => 'Внутренняя ошибка сервера'
						)),
		        );
			}
		}
		else {
			return array(
					'headers' => array('HTTP/1.1 404 Not Found', 'Content-type: application/xml'),
					'entity' => theme('xml_error',
							array(
									'error_code' => '404',
									'error_msg' => 'Ресурс не найден'
							)),
			);
		}
	}
}