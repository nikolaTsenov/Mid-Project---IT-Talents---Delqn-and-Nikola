<?php
// da ne moje da se otvori linka direktno
if(!$index) {
	header('Location:/9gag/?page=register');
	die();
}

?>


<div id="registration-form">
	<div class='fieldset'>
    <legend>Register</legend>
		<form action="?page=register" method="post" data-validate="parsley">
			<div class='row'>
				<label for='username'>Username</label>
				<input type="text" placeholder="Username" name='username' id='username' data-required="true" data-error-message="Your username is required">
			</div>
			<div class='row'>
				<label for="password">Password</label>
				<input type="password" placeholder="password"  name='password' data-required="true" data-type="password" data-error-message="Your password is required">
			</div>
			<div class='row'>
				<label for="repeatPassword">Confirm your password</label>
				<input type="password" placeholder="Confirm your password" name='repeatPassword' data-required="true" data-error-message="Your confirm password is required">
			</div>
			<div id="error">
<?php 
if(isset($_POST['submit'])){


			$username = trim(htmlentities($_POST['username']));
			$password = trim(htmlentities($_POST['password']));
			$repeatPassword = trim(htmlentities($_POST['repeatPassword']));
			$matchPassword = true;
			$characters = true;
			$used = false;

				


			if((file_exists("users/" . $username)) && (strlen($username) > 0)) {
 				echo "That username is taken. Try another.";
 				$used=true;
 			}
 			if($password !== $repeatPassword) {
 				echo "These passwords don't match. Try again?" . "<br/>";
 				$matchPassword=false;
 			} 
 			
 			if((strlen($username) < 6) || (strlen($password) < 6) || (strlen($repeatPassword) < 6))	 {
 						echo "Please use between 6 and 30 characters.";
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
 				
 			}
}
 ?>
			</div>
			<input name = "submit" type="submit" value="Register">
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
