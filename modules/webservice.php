<?php

function webservice_get($request) {
	$user = $request['user'];
	$filename = $_SESSION['fname'];
	
	$f = '../xml/' . $filename . '.xml';
	
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


function webservice_post($request) {

	include 'webservice_admin.php';	
	
	return webservice_admin_post($request);
		
}
?>