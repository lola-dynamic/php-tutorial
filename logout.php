<?php 
/* log out process, unsets and destroys session variable*/
session_start();
session_unset();
session_destroy();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Error</title>
 	<?php include 'css/css.html'; ?>
 </head>
 <body>
 	<div class="form">
 		<h1>Thanks for stopping by</h1>
 		<p><?= 'you have been logged out!'; ?></p>
 		<a href="index.php"><button class="button button-block">Home</button></a>
 	</div>
 
 </body>
 </html>