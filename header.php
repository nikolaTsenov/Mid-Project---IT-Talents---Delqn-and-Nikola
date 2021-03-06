<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="7cheers"/>
<meta http-equiv="author" name="Nikola Tsenov, Delqn Kolev" />
<title>7cheers</title>
<link rel="stylesheet" href="./assets/css/reset.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/post.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/videos.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/upload.css" type="text/css" />
<link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="./assets/css/gornaLenta.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/register.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/profile.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/login.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/contacts.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<style>
<?php 
if (isset ( $_SESSION ['username'] )) {
?>
@media all and (max-width:1150px) {
	#topperNav li {
		width: 13.5%;
	}
	#news {
		width:10%;
	}

	
}
@media all and (max-width:550px) {
	#topperNav li {
		width: 15%;
	}
	#registration-form {
		width:60%;
	}
}
<?php 
}
?>
</style>
<body>
	<div id="wrapper">
		<header id="header">
				<div class="dropdown">
					<!-- The inside of the button is unclickable, tried many tags, nothing worked. I liked my animation, so I just couldn't erase it...-->
					<button onclick="dropdownFunction()" class="dropbtn"><!--  <p id="doIT">-->&#9776;<!-- &nbsp;<i class="fa fa-arrow-left" aria-hidden="true"></i></p>--></button>
					<h2><a href="">Home </a></h2>
  					<div id="myDropdown" class="dropdown-content">
   						<a href="?page=videos">VIDEOS</a>
   						<a href="?page=images">IMAGES</a>
   						<a href="?page=gifs">GIFS</a>
   						<?php 
   						if (!isset ( $_SESSION ['username'] )) {
   						?>
   						<a href="?page=register">REGISTER</a>
   						<a href="?page=login">LOGIN</a>		
   						<?php 
   						}
   						?>
   						<a href="?page=contact">CONTACTS</a>
   						<a href="?page=upload"><i class="fa fa-upload"></i>UPLOAD</a>
   						<?php 
   						if (isset ( $_SESSION ['username'] )) {
   						?>
   							<a href="?page=profile"><?php echo $_SESSION ['username']; ?></a>
   						<?php 
   						}
   						?>
  					</div>
				</div>
				<form id="searchingForm">
  					<input type="text" name="search" placeholder="Search..">
				</form>
				<h1 id="heading"><a href="?page=videos"><img src="./assets/images/logo7.png" alt="logo7" />cheers</a></h1>
				<ul id="topperNav">
					<li id="videos"><a href="?page=videos">VIDEOS</a></li>
					<li id="images"><a href="?page=images">IMAGES</a></li>
					<li id="gifs"><a href="?page=gifs">GIFS</a></li>
				
					<?php 
   					if (!isset ( $_SESSION ['username'] )) {
   					?>
						<li id="register" style="width:90px;"><a href="?page=register" style="width:90px;">REGISTER</a></li>
					<?php 
   					}
					?>
					<?php 
   					if (!isset ( $_SESSION ['username'] )) {
   					?>
   						<li id="login"><a href="?page=login">LOGIN</a></li>
   					<?php 
   					}
   					?>
					<li id="contacts"><a href="?page=contact">CONTACTS</a></li>
					<li id="search" style="width:auto; margin-left:30px;"><a href=""style="width:auto;"><i class="fa fa-search"></i></a></li>
				</ul>
				<ul id="profileNav">
					<li id="upload"><a href="?page=upload"><i class="fa fa-upload"></i>Upload</a></li>
					<?php 
   					if (isset ( $_SESSION ['username'] )) {
   					?>
						<li id="images"><a href="?page=profile"><?php echo $_SESSION ['username']; ?></a></li>
					<?php 
   					}
   					?>
				</ul>
				<form id="searchingForm2">
  					<input type="text" name="search" placeholder="Search..">
				</form>
			</header>	
	</div>	

	<script type="text/javascript">
			/* When the user clicks on the button, 
			toggle between hiding and showing the dropdown content */
			function dropdownFunction() {
   				document.getElementById("myDropdown").classList.toggle("show");
			}

			// Close the dropdown if the user clicks outside of it
			window.onclick = function(event) {
  			if (!event.target.matches('.dropbtn')) {

    		var dropdowns = document.getElementsByClassName("dropdown-content");
    		var i;
   			for (i = 0; i < dropdowns.length; i++) {
      		var openDropdown = dropdowns[i];
     		if (openDropdown.classList.contains('show')) {
        	openDropdown.classList.remove('show');
      					}
    				}
  				}
			}
	</script>	
