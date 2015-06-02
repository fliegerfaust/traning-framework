<?php 

function auth(&$request, $r) {
	session_start();
	if (empty($_SESSION['login'])) {
		$response = array(
				'headers' => array('HTTP/1.0 401 Unauthorized'),
				'entity' => theme('401', $request),
		);
		return $response;
	}
}