
function checkCharacters (characters) {
	if((characters.length < 6) || (characters.length > 30)) {
		document.getElementById('submit').disabled = true;
		document.getElementById('rePasswordError').innerHTML = 'Please use between 6 and 30 characters.';
	}else {
		document.getElementById('submit').disabled = false;
		document.getElementById('rePasswordError').innerHTML = '';
	} 
}
function checkUsernameCharacters (characters) {
	if((characters.length < 6) || (characters.length > 30)) {
		document.getElementById('submit').disabled = true;
		document.getElementById('passwordMessage').innerHTML = 'Please use between 6 and 30 characters.';
	}else {
		document.getElementById('submit').disabled = false;
		document.getElementById('password').innerHTML = '';
	} 
}

function validatePassword(rePassword) {
	var rePassword = document.getElementById('repeatPassword').value;
	var password = document.getElementById('password').value;
	
	if ((rePassword !== password) && (rePassword.length == password.length)){
		document.getElementById('rePasswordError').innerHTML = 'These passwords dont match. Try again?';
		document.getElementById('submit').disabled = true;
	} else {
		document.getElementById('rePasswordError').innerHTML = "";
		document.getElementById('submit').disabled = false;
	}
}

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
	  xhttp.open("GET", "./usernames.php?username=" + username, true);
	  xhttp.send();
}
