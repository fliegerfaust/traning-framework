<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
 <style>
.error {
  border: 2px solid red;
}
</style>

<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- Here JavaScript code if needed for Task 14 -->
		

		
		<!-- /Here JavaScript code if needed for Task 14 -->
				
		<title>Ввод персональных данных</title>
	 	<div class="navbar navbar-fixed-top">
	 		<div class="navbar-inner">
	 			<div class="container">
       				 <a class="brand">Регистрация</a>
       				 <ul class="nav">
       				 	<li><a href="/login">Войти</a></li>
       				 </ul>
  				</div>
  			</div>
  		</div>
	</head>
	
	<body>
	
	<div id="header">
	</div>
	
	<div id="allcontent">
		<div id="formarea">
			<div class="well well-large">
		
		<?php
			if (!empty($c['messages'])) {
				echo '<table align="center">';
  				foreach ($c['messages'] as $message) {
    				echo '<tr><td width = "400">'.$message.'</td></tr>';
  				}
  				echo '</table>';
			}
		?>  
		
		
		<form action="" method="post">
			<div id="fio">
				Имя: <br />
				<input type="text" name="name" size="32" 
					<?php if ($c['errors']['name']) {print 'class="error"';} ?> 
					value="<?php print $c['values']['name']; ?>"/> <br />
				E-mail: <br />
				<input type="text" name="email" size="32" 
					<?php if ($c['errors']['email']) {print 'class="error"';} ?> 
					value="<?php print $c['values']['email']; ?>" /> <br />
				
				Год рождения:         
					<select name="birthyear" id="yearofbirth">
						<option <?php print $c['values']['birthyear'] == "1812" ? "selected" : ""; ?> value="1812">1812</option>
						<option <?php print $c['values']['birthyear'] == "1912" ? "selected" : ""; ?> value="1912">1912</option>
						<option <?php print $c['values']['birthyear'] == "1939" ? "selected" : ""; ?> value="1939">1939</option>
						<option <?php print $c['values']['birthyear'] == "1945" ? "selected" : ""; ?> value="1945">1945</option>
						<option <?php print $c['values']['birthyear'] == "2015" ? "selected" : ""; ?> value="2015">2015</option>
					</select> <br />
				
			</div>
			<div id="limb">	
				Количество конечностей: <br />
				<input type="radio" <?php if ($c['values']['number_of_extremities'] == '' || $c['values']['number_of_extremities'] == "1") {print 'checked="checked"';} ?>
					name="extremitiesnumber" value="1" /> 1
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "2" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="2" /> 2
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "3" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="3" /> 3
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "4" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="4" /> 4 <br />
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "5" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="5" /> 5
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "6" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="6" /> 6
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "7" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="7" /> 7
				<input type="radio" <?php print $c['values']['number_of_extremities'] == "8" ? 'checked="checked"' : ""; ?>
					name="extremitiesnumber" value="8" /> 8 <br />
			</div>	
			<div id="sex">
				Пол: <input type="radio" 
						<?php if ($c['values']['sex'] == '' || $c['values']['sex'] == "sexman") 
						{ print 'checked="checked"'; } ?> name="sex" value="sexman" id="sexman" />
					 Мужской
					 <input type="radio" 
					 	<?php print $c['values']['sex'] == "sexwoman" ? 'checked="checked"' : ""; ?>
					 	name="sex" value="sexwoman" id="sexwoman" />
					 Женский
			</div>	 
				
			<div id="superpowers">
				Сверхспособности: <br />
					<select name="superabilities[]" multiple="multiple">
						<option <?php print $c['values']['superabilities1'] == "1" ? "selected" : ""; ?> 
							value="be">Бессмертие</option>
						<option <?php print $c['values']['superabilities2'] == "1" ? "selected" : ""; ?>
							value="wall">Прохождение сквозь стены</option>
						<option <?php print $c['values']['superabilities3'] == "1" ? "selected" : ""; ?>
							value="lev">Левитация</option>
					</select> <br />
			</div>
			<div id="shortbio">
			
				Краткая биография: <br />
				<textarea name="bio" rows="10" cols="34"><?php print trim($c['values']['bio']); ?></textarea> <br />
			
			</div>
			<div id="submitarea" align="right">
				С контрактом ознакомлен <input type="checkbox" name="agree" 
					<?php print $c['values']['agree'] ? 'checked="checked"' : ""; ?>/>
					<br /><br />
					<!--  <input type="submit" class="btn"/>  -->
					<!-- <button type="submit" class="btn btn-info">Отправить</button> -->
						<button formmethod="post" class="btn" name="cookies" value="1">Очистить</button>
						<button formmethod="post" id='submit' class="btn btn-info" name="send" value="1">Отправить</button>
			</div>
			
		</form>
		</div>
		</div>
	<div id="footer">
	
	</div>
	</div>

	</body>
</html>