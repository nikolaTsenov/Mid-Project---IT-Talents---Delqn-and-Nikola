<?php
if(!isset($index)) {
	header('Location:?page=login');
	die();
}

$hasFound=false;
if (isset($_POST['username']) && (isset($_POST['password']))) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$handle = fopen('./users/register.txt', 'r+');
	
	while(!feof($handle)) {
		$row = fgets($handle);
		$row = trim($row);
		if(strlen($row) > 0) {
			$user = explode('#', $row);
		}
		$user[0] = trim($user[0]);
		$user[1] = trim($user[1]);
	$count = 0;
		for($index=0;count($user)>$index;$index++) {
			if (($user[0] === $username) && ($user[1]) === md5($password)) {
	
				$_SESSION['username'] = $username;
				$hasFound = true;
				break;
			}
		}
	}
}
if ($hasFound) {
	header('Location:?page=loged');
	die();
}
	

	?>


<div id="registration-form">
	<div class='fieldset'>
    <legend>Login</legend>
		<form action="?page=login" method="post" data-validate="parsley">
			<div class='row'>
				<label for='username'>Username</label>
				<input type="text" placeholder="Username" name='username' id='username' onblur="checkUsernameCharacters(this.value)">
				<span id = "usernameError" class ="error"></span>
			</div>
			<div class='row'>
				<label for="password">Password</label>
				<input type="password" placeholder="password"  name='password'>
				<span id = "passwordMessage" class ="error"><?php if((!$hasFound) && (isset($_POST['password']))){echo "Wrong password or username. Try again.";}?></span>
			</div>
	
			<input id ="submit" name = "submit" type="submit" value="Login">
		</form>
	</div>
</div>
<script type="text/javascript">
function placeholderIsSupported() {
		test = document.createElement('input');
		return ('placeholder' in test);
	}

$(document).ready(function(){
  placeholderSupport = placeholderIsSupported() ? 'placeholder' : 'no-placeholder';
  $('html').addClass(placeholderSupport);  
});
</script>
<script type ="text/javascript" src="./assets/js/validation.js">
</script>

			