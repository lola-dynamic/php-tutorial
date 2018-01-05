<?php
/* registration process, inserts user info into the database
and sends account confirmation email message 
*/

//set session variables to be used on profile.php page
$_session['email'] = $_POST['email'];
$_session['first_name'] = $_POST['firstname'];
$_session['last_name'] = $_POST['lastname'];

//escape all #_POSt variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
 $email = $mysqli->escape_string($_POST['email']);
 $passsword = $mysqli->escape_string(password_harsh($_POST['password'], PASSWORD_BCRYPT));
 $hash = $mysqli->escape_string( md5( rand(0,1000) ) );
 //check if user with that email already exists
 $result = mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

 //we know user email exists if the rows returned are more than 0
 if ( $result->num_rows > 0) {
 	$_SESSION['message'] = 'User with this email already exists!';
 	header("location: error.php");
 }
 else {  // email doesnt already exist in a database, proceed...

 	//active is 0 by  DEFAULT (no need to include it here)
 	$sql = "INSERT INTO users (first_name, last_name, email, password, hash)"
 		. "VALUES ('$first_name', '$last_name', '$email', '$password', 'hash') ";

 		//add user to the database
 		if ( $mysqli->query($sql)) {
 			$_SESSION['active'] = 0;  //o until user activates their account with verify.php
 			$_SESSION['loagged_in'] = true;  //so we know the user has logged in
 			$_SESSION['message'] =
 				"Confirmation link has been sent to $email, please verify your account by clicking on the link in the message";

 				//send registration confirmation link (verify.php)
 				$to     = $email;
 				$subject = 'account verification (abigailomolola1@gmail.com)';
 				$message_body = ' Hello '.$first_name.',
 				Thank you for signing up!

 				Please click this link to activate your accpunt:
 				http://localhost/php-tutorial/verify.php?email='.$email.'&hash='.$hash;
 				mail($to, $subject, $message_body);
 				header("location: profile.php");
 		}
 		else{
 			$_SESSION['message'] = 'registration failed!';
 			header("loaction: error.php");
 		}


 }
