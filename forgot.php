<?php
/* reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

	$email = $mysqli->escape_string($_POST['email']);
	$result = $mysqli->query("SELECT * FROM users WHERE email='$email' ");

	if ( $result->num_rows == 0)  //user doesnt exist 
	{
		$_SESSION['message'] = "user with that email doen't exist!";
		header("location: error.php");
	}
	else {  // user exists (num_rows !=0)
		$user = $result->fetch_assoc();  // $user becomes array with user date

		$email = $user['email'];
		$hash = $user['hash'];
		$first_name = $user['first_name'];

		// session messageto display on success.php
		$_SESSION['message'] = "<p>please check your email <span>$email</span>"
		. "for a confirmation link to complete your password reset!</p>";

		//send registration confirmation link (reset.php)
		$to		= $email;
		$subject = 'password reset link (abigailomolola1@gmail.com)';
		$message_body = '
		Hello '.$first_name.' ,

		you have requested password reset!
		please click this to reset your password:
		http://localhost/php-tutorial/reset.php?email='.$email.'&hash=' .$hash;
		mail($to, $subject, $message_body);
		header("location: success.php");

	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset Your Password</title>
	<?php include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Reset Your Password</h1>
		<form action="forgot.php" method="post">
			<div class="field-wrap">
				<label>
					email address<span class="req">*</span>
				</label>
				<input type="email"required autocomplete="off" name="eamil"/>
			</div>
			<button class="button button-block">Reset</button>
		</form>
	</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
