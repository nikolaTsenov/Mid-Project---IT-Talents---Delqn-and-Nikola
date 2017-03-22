<?php
if (isset ( $_POST ['submit'] )) {
	$validEmail = false;
	$email = $_POST ["emailFrom"];
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$validEmail = true;
	} else {
		$validEmail = false;
		echo "$email is invalid email";
	}	
	if ($validEmail) {
		
		$emailFrom = $email;
		$emailTo = 'delqnkolevv@gmail.com ';
		$subject = $_POST ['subject'];
		$message = $_POST ['message'];
		$headers = "From: $emailFrom" . "\r\n" .
				"CC: hyperniki@abv.bg"; /*extra header*/
		
		
		if (mail ( $emailTo, $subject, $message, $headers )) {
			echo "mail send successfully";
		}
		
	} else {
		echo "Invalid email";
	}
}

?>