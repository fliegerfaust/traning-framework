<?php

// Обработчик запросов методом GET.
function admin_get($request) {	
 
  $a = glob('../xml/*.xml');
  $users = array();
  foreach ($a as $a_file) {
    $xml = simplexml_load_file($a_file);
    
    $value = $xml->superabilities;
	$str = "";
	foreach ($value->children() as $at => $val) {
		$str = $str."\n<br/>".str_replace(" ","_",$val->__tostring()); 
	}
	$str = substr($str,6,strlen($str));
	
	$filename = str_replace("../xml/","",$a_file);
	$filename = str_replace(".xml","",$filename);
    
    $users[$a_file] = array(
      'name' => strip_tags($xml->name),
      'email' => strip_tags($xml->email),
      'year_of_birth' => strip_tags($xml->year_of_birth),
      'number_of_extremities' => strip_tags($xml->number_of_extremities),
      'sex' => 	strip_tags($xml->sex),
      'superabilities' => $str,
      'bio' => 	strip_tags($xml->bio),
      'filename' => $filename,
    );
 }
 $output = theme('admin', array(
 		'users' => $users,
 ));
 
  return $output;
}
	


// Обработчик запросов методом POST.
function admin_post($request) {
  $filepath = "../xml/" . $_POST['userfile'] . ".xml";
  unlink($filepath);
  return redirect();
}