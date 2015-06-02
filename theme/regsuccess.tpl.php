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

<title>Данные сохранены</title>

	<head>
	<div class="navbar navbar-fixed-top">
	 		<div class="navbar-inner">
	 			<div class="container">
       				 <a class="brand">Добро пожаловать!</a>
  				</div>
  			</div>
  		</div>
	</head>

	<div id="header">
	</div>
	
<div id="allcontent">
	<div id="formarea">
		<div class="well well-large">
			<div class="alert alert-success">
				Данные успешно сохранены!
			</div>		
			<p><b>Ваш логин:</b> <?php echo $c['userdata']['login'] ?></p>
			<p><b>Ваш пароль:</b> <?php echo $c['userdata']['pass'] ?></p>
			<a href="/login">Войдите</a>, используя логин и пароль, для изменения данных.
		</div>
	</div>
	<div id="footer">
	</div>

</div>

