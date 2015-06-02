<style>
#header {
	/*background-color: 	#4E3A3A;*/
	background-color: 	#A9DBEF;
	color:				#A9DBEF;
	width:				800px;
	margin-left:	    auto;
	margin-right:	    auto;
	height:     	  	130px;
}

#footer {
	/*background-color: 	#4E3A3A;*/
	background-color: 	#A9DBEF;
	color:				#A9DBEF;
	width:				800px;
	margin-left:	    auto;
	margin-right:	    auto;
	height:     	  	300px;
}
</style>

<title>Авторизация</title>

	<head>
	<div class="navbar navbar-fixed-top">
	 		<div class="navbar-inner">
	 			<div class="container">
       				 <a class="brand">Авторизация</a>
       				 <ul class="nav">
       				 	<li><a href="/form">Заполнить анкету</a></li>
       				 </ul>
  				</div>
  			</div>
  		</div>
	</head>


	<div id="header">
	</div>
	
<div id="allcontent">
	<div id="formarea">
		<div class="well well-large">
			<?php 
  				if ($c['errors']) {
  	 				echo '<div class="alert alert-error">Неверная комбинация логин/пароль</div>';
  				}
			?>
		
			<form class="form-horizontal" action="" method="post">
  				<div class="control-group">
    				<label class="control-label">Логин</label>
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
  				<div id="submitarea" align="right">
  					<div class="control-group">
    					<div class="controls">
      						<button type="submit" class="btn btn-info">Войти</button>
    					</div>
  					</div>
  				</div>
			</form>
		</div>
	</div>
	<div id="footer">
	</div>

</div>

