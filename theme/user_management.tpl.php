<title>Управление администраторами</title>
<BR>
<DIV class="container">
<DIV class="row">
<div class="span7">
<?php 
  $db = mysql_connect("localhost","root","123") or die (mysql_error ());
  mysql_select_db("framework" ,$db);
  $sql = mysql_query("SELECT * FROM `users`" ,$db);
  mysql_set_charset('utf8');
  
  echo ("<table class='table table-bordered'>");
  echo ("<tr><td><b>ID</b></td><td><b>Логин</b></td><td><b>Пароль</b></td><td><b>Удаление</b></td></tr>");
  
  while ($tablerows = mysql_fetch_row($sql))
  {
  	$password_rows = md5($tablerows[2]);
  	echo("<form action='' method='post'>
  		  <tr>
  		      <td>$tablerows[0]</td>
  			  <td>$tablerows[1]</td>
  			  <td>$password_rows</td>
  			  <td><input type='hidden' name='deleteID' value='$tablerows[0]'></input>
  			      <input type='submit' value='Удалить' class='btn btn-danger'>
  			  </td>
  	   	 </tr>
  	   	 </form>");
  }
  echo "</table>";
?>
</DIV>

<div class="span2">
<form class="form-horizontal" action="" method="post">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Логин</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Логин" name="login">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Пароль</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Пароль" name="password">
    </div>
  </div>
  <div class="control-group">
  	<div class="controls">
      <button type="submit" class="btn btn-success">Добавить</button>
    </div>
  </div>
</form>
</div>
</DIV>
</DIV>
<?php 
mysql_close($db);
?>  
