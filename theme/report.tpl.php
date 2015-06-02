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
	height:     	  	400px;
}
</style>

<title>Результаты</title>
	<div id="header">
	</div>
	
<div id="allcontent">
	<div id="formarea">
		<div class="well well-large">
			<div class="alert alert-info">
				<p><b>Результаты обработки данных</b></p>
			</div>		
				<ul>
					<?php 
						foreach ($c['reports'] as $result) {
 							echo '<li>' . $result .'</li>';	
						}
					?> 
				</ul>
				<a href="/form_edit"><i>Вернуться к анкете</i></a>
		</div>
	</div>
	<div id="footer">
	</div>

</div>

