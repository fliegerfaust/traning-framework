<?php 

	$db = mysql_connect("localhost","root","123") or die (mysql_error ());
	mysql_select_db("framework" ,$db);
	mysql_set_charset('utf8');

function user_management_get($request) {
		
	$output = theme('user_management');
 
	return $output;
}


function user_management_post($request) {
	
	/* 
	 * Самый простой  способ — это экранирование параметра SQL-запроса 
	 * одиночными кавычками (‘), поскольку через GET- и POST-запрос 
	 * невозможно передать символ одиночной кавычки 
	 * (они будут автоматически заменены сочетанием символов - \’).  
	 * 
	 * Второй способ - mysql_real_escape_string — Экранирует специальные 
	 * символы в строках для использования в выражениях SQL.
	 * 
	 * Нужно хранить пароли в БД в зашифрованном виде, предпочтительнее использовать SHA1, 
	 * но можно и MD5. В своём фреймворке я вывожу лишь значения полей пароля в MD5, но не
	 * шифрую их в целях удобства разработки.
	 * 
	 * Также существует ряд других функций: strip_tags, htmlspecialchars, 
	 * stripslashes, addslashes.
	 * 
	 * intval() - возвращает целое значение переменной, применимо к полям, тип которых является
	 * целочисленным.
	 * 
	 * */
	
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	mysql_real_escape_string($login);
	mysql_real_escape_string($password);
		if (($login <> "") and ($password <> "")) { 
			$insert = mysql_query("INSERT INTO `users` (`login`,`password`) VALUES('$login','$password')");
		}
		
	$deleteID = intval($_POST['deleteID']);
	$delete = mysql_query("DELETE FROM `users` WHERE `ID` = '$deleteID'");
		
	
	return redirect();
}

?>