<?php
if (isset ( $_POST ['submit'] )) {
	$validEmail = false;
	$email = $_POST ["emailTo"];
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$validEmail = true;
	} else {
		$validEmail = false;
		echo "$email is invalid email";
	}	
	if ($validEmail) {
		
		$emailFrom = $email;
		$emailTo = $_POST ['emailTo'];
		$subject = $_POST ['subject'];
		$message = $_POST ['message'];
		$headers = "From: $emailFrom";
		
		mail ( $emailTo, $subject, $message, $headers );
	} else {
		echo "Invalid email";
	}
}

?>