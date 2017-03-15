<?php
if(!$index) {
	header('Location:index.php?page=profile');
	die();
}
if (!isset($_SESSION['username'])) {
	header('Location:?page=login');
	die();
}else {
	$username = $_SESSION['username'];
}

if(isset($_POST['submit'])){
			$username = $_SESSION['username'];
			$password = trim(htmlentities($_POST['password']));
			$repeatPassword = trim(htmlentities($_POST['repeatPassword']));
			$matchPassword = true;
			$characters = true;
	if($password !== $repeatPassword) {
 				setMessage("These passwords don't match. Try again?");
 				$matchPassword=false;
 	} 
	if((strlen($password) < 6) || (strlen($repeatPassword) < 6))	 {
 					setMessage("Please use between 6 and 30 characters.");
 					$characters = false;
 	}
	
	if(($matchPassword == true) && ($characters == true)){
			 
			 		$file_path= "users/register.txt";
					$current = file_get_contents($file_path);
				
					$current = explode(PHP_EOL,$current);
					for($index=0;count($current)>$index;$index++) {
						$user = explode('#',$current[$index]);
						if ($user[0] == $username) {
							$current[$index] = $user[0] . "#" . md5($password);
							break;
						}
					}
					$current = implode(PHP_EOL,$current);
				file_put_contents($file_path,$current);
 			}
}




?>

<link rel="stylesheet" href="./assets/css/profile.css" type="text/css" />
<div id = "profileInformation">
</div>

<div id="registration-form">
	<div class='fieldset'>
    <legend><?= $username ?></legend>
	<a href="?page=logout"><input type="submit" value="Logout" /> </a>
		<form action="?page=profile" method="post">
			<div class='row'>
				<label for="password">New Password</label>
				<input type="password" placeholder="password"  name='password' id="password">
				<span id="passwordError" class ="error"></span>
			</div>
			<div class='row'>
				<label for="repeatPassword">Repeat your new password</label>
				<input type="password" placeholder="Confirm your password" name='repeatPassword' id = "repeatPassword">
				<span id="rePasswordError" class ="error"></span>
			</div>
			<input name = "submit" id ="submit" type="submit" value="Update">
		</form>
	</div>
</div>

