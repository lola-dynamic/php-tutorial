<?php 
/* the password reset form, the link to thgis page is included 
from the forgot.php email message
*/
require 'db.php';
session_start();

//make sure email and hash variable aren;t empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
	$email = $mysqli->escape_string($_GET['email']);
	$hash = $mysqli->escape_string($_GET['hash']);

	//make sure user email with matching hash exist
	$result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");
	if ($result->num_rows == 0) {
		$_SESSION['mesaage'] = "you have invalid URL for password reset!";
		header("location: error.php");
	}
}
else{
	$_SESSION['message'] = "sorry, verification failed, try again!";
	header("location: error.php");
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reset Your Password</title>
	<?php include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Choose your password</h1>
		<form action="reset_password.php" method="post">
			<div class="field-wrap">
				<label>
					New Password <span class="req">*</span>
				</label>
				<input type="password" required  name="newpassword" autocomplete="off"/>
			</div>
			<div class="fiel-wrap">
				<label>
					Confirm New Password <span class="req">*</span>
				</label>
				<input type="password" required name="confirmpassword" autocomplete="off"/>
			</div>
			<!-- this input field is needed to get the email of the user -->
			<input type="hidden" name="email" value="<?= $hash ?>">

			<button class="button button-block">Apply</button>

		</form>
	</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>