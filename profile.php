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
$succsess = false;
if(isset($_POST['submit'])){
			$username = $_SESSION['username'];
			$password = trim(htmlentities($_POST['password']));
			$repeatPassword = trim(htmlentities($_POST['repeatPassword']));
			$matchPassword = true;
			$characters = true;
			
			// change profile picture
			require 'uploadProfilePicture.php';
			
			
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
				$succsess = true;
 			}
}
//profile picture path
$file = "users/" . $username . "/upload/profilePicture/profilePath.txt";
$path = false;
if(is_file($file)) {
	$picturePath = file_get_contents("users/" . $username . "/upload/profilePicture/profilePath.txt");
}
$profilePicture = is_file($picturePath) ? "block" : "none";



//last profile activity
if($succsess) {
	$path = "users/$username/activity.txt";
	$handle = fopen("users/".$username . '/activity.txt' ,'a+');
	fwrite($handle, 'You changed your password at ' . date("d/m/Y") . " " . date("h:i:sa"));
	fwrite($handle, PHP_EOL);
	fclose($handle);
}

?>

<div id = "profileInformation">
</div>

<div id="registration-form">
	<div class='fieldset'>

    <legend>
	    <div style="display:<?= $profilePicture?>">
	    <img id = "profilePicture" src='<?= $picturePath ?>' />
	    </div>
    <?= $username ?></legend>

	<a  href="?page=logout"><input id="logoutButton" type="submit" value="Logout"  style='color:#E95757'> </a>
		<form action="?page=profile" method="post" enctype="multipart/form-data">
		
			<div class='row'>
				<label for="password">New Password</label>
				<input type="password" placeholder="password"  name='password' id="password">
				<span id="passwordError" class ="error"></span>
			</div>
			<div class='row'>
				<label for="repeatPassword">Repeat your new password</label>
				<input type="password" placeholder="Confirm your password" name='repeatPassword' id = "repeatPassword">
				<span id="rePasswordError" class ="error">
					<?php 
							$messages = getMessages();
							foreach ($messages as $msg) {
								echo $msg;
								echo "<br/>";
							}
					?>
				</span>
				<span id="succsess">
					<?php 
						if($succsess) {
							echo 'Your password has been changed successfully!';
						}
					?>
				</span>
				
			</div>
		   	<div>
		   	<span>Select Image: </span>
		   	</div>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input name = "submit" id ="submit" type="submit" value="Update">
		</form>
		<div>
			<span>User activity: </span>
			<div id="activityLog">
				<?php 
				$activities = file_get_contents("users/" . $username . "/activity.txt");
				$act = explode(PHP_EOL,$activities);
				foreach ($act as $activtiy) {
					echo $activtiy . "<br/>";
				}
				?>
			</div>
		</div>
	</div>
</div>

