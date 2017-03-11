<?php
if(!$index) {
	header('Location:index.php?page=register');
	die();
}

if(isset($_POST['submit'])){


			$username = trim(htmlentities($_POST['username']));
			$password = trim(htmlentities($_POST['password']));
			$repeatPassword = trim(htmlentities($_POST['repeatPassword']));
			$matchPassword = true;
			$characters = true;
			$used = false;

				


			if((file_exists("users/" . $username)) && (strlen($username) > 0)) {
				setMessage("That username is taken. Try another.");
 				$used=true;
 			}
 			if($password !== $repeatPassword) {
 				setMessage("These passwords don't match. Try again?");
 				$matchPassword=false;
 			} 
 			
 			if((strlen($username) < 6) || (strlen($password) < 6) || (strlen($repeatPassword) < 6))	 {
 						setMessage("Please use between 6 and 30 characters.");
 						$characters = false;
 					}
 		
 			
 			if(($matchPassword == true) && ($characters == true) && ($used == false)){
			 
			 		$handle = fopen('users/register.txt','a+');
			 		mkdir("users/" . $username);
			 		mkdir("users/" . $username . "/upload");
			 		fwrite($handle, $username);
			 		fwrite($handle,'#');
			 		fwrite($handle,trim(md5($password)));
			 		fwrite($handle,PHP_EOL);
			 		
			 		
			 		fclose($handle);
						$_SESSION['username'] = $username;	 
						header('Location:?loged.php');
						die();
 			}
}



// make JSON
$names = file_get_contents('users/register.txt');
$names = explode(PHP_EOL,$names);
foreach ($names as $name) {
	$name = explode('#',$name);
	$jsonArray[] = array (
		'username' => $name[0],
		'password' => $name[1]
	);
}
array_pop($jsonArray);
$jsonArray = json_encode($jsonArray);


?>


<div id="registration-form">
	<div class='fieldset'>
    <legend>Register</legend>
		<form action="?page=register" method="post" data-validate="parsley">
			<div class='row'>
				<label for='username'>Username</label>
				<input type="text" placeholder="Username" name='username' id='username' data-required="true" data-error-message="Your username is required" onblur="checkCharacters(this.value),checkUsername(this.value)">
				<span id="usernameError" class ="error"></span>
			</div>
			<div class='row'>
				<label for="password">Password</label>
				<input type="password" placeholder="password"  name='password' id="password" data-required="true" data-type="password" data-error-message="Your password is required" onblur="checkCharacters(this.value)">
				<span id="passwordError" class ="error"></span>
			</div>
			<div class='row'>
				<label for="repeatPassword">Confirm your password</label>
				<input type="password" placeholder="Confirm your password" name='repeatPassword' id = "repeatPassword" data-required="true" data-error-message="Your confirm password is required" onkeyup = "validatePassword(this.value)" onblur="checkCharacters(this.value)">
				<span id="rePasswordError" class ="error"></span>
			</div>
<?php 

 ?>
			<input name = "submit" id ="submit" type="submit" value="Register">
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


<script type ="text/javascript" id="usernameValidation">
function checkUsername(username) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		if(this.responseText.length > 2) {
		  document.getElementById("rePasswordError").innerHTML = this.responseText;
		  document.getElementById("username").style.border = "1px solid red";
		  document.getElementById('submit').disabled = true;
		} else {
		  document.getElementById("username").style.border = "0px";
		  document.getElementById('submit').disabled = false;
		}
    }
  };
  xhttp.open("GET", "http://localhost/9gag/usernames.php?username=" + username, true);
  xhttp.send();
}
</script>

